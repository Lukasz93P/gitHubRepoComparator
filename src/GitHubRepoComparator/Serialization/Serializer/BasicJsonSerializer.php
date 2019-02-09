<?php

namespace GitHubRepoComparator\Serialization\Serializer;

use GitHubRepoComparator\Serialization\Serializable\Serializable;

/**
 * Class BasicJsonSerializer
 * @package Stereotypes\ApiStereotypes\Serializer
 */
class BasicJsonSerializer implements Serializer
{
    /**
     * @param Serializable $serializable
     * @return string
     */
    public function serialize(Serializable $serializable)
    {
        $serializableProperties = $serializable->getSerializableProperties();
        if (empty($serializableProperties)) {
            throw new \RuntimeException(get_class($serializable) . ' has no serializable fields.');
        }

        return json_encode($this->getSerializableData($serializable));
    }

    /**
     * @param Serializable $serializable
     * @return array
     */
    private function getSerializableData(Serializable $serializable)
    {
        $serializableFieldsName = $serializable->getSerializableProperties();

        $serializableDataArray = array();
        foreach ($serializableFieldsName as $name) {
            $getterName = 'get' . $name;
            $serializableValue = $this->getSerializableValueData($serializable->$getterName());
            $serializableDataArray[$name] = $serializableValue;
        }

        return $serializableDataArray;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    private function getSerializableValueData($value)
    {
        if (is_array($value)) {
            $serializableValueData = array();
            foreach ($value as $key => $data) {
                $serializableValueData[$key] = $this->checkIfSerializableAndMakeRecursiveCallIfIs($data);
            }
        } else {
            $serializableValueData = $this->checkIfSerializableAndMakeRecursiveCallIfIs($value);
        }

        return $serializableValueData;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    private function checkIfSerializableAndMakeRecursiveCallIfIs($value)
    {
        return $value instanceof Serializable ? $this->getSerializableData($value) : $value;
    }
}