<?php

namespace GitHubRepoComparator\Serialization\Serializer;

use GitHubRepoComparator\Serialization\Serializable\Serializable;

/**
 * Class BasicJsonSerializer
 * @package Stereotypes\ApiStereotypes\Serializer
 */
final class BasicJsonSerializer implements Serializer
{
    /**
     * @param Serializable $serializable
     * @return string
     */
    public function serialize(Serializable $serializable)
    {
        $serializableFieldsName = $serializable->getSerializableProperties();

        if (empty($serializableFieldsName)) {
            throw new \RuntimeException(get_class($serializable) . ' has no serializable fields.');
        }

        $serializableDataArray = array();
        foreach ($serializableFieldsName as $name) {
            $getterName = 'get' . $name;
            $serializableDataArray[$name] = $serializable->$getterName();
        }

        return json_encode($serializableDataArray);
    }
}