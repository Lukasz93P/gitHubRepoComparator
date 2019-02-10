<?php

namespace GitHubRepoComparator\Validation;

use GitHubRepoComparator\Exception\Validation\ValidationException;

class BasicValidator implements Validator
{
    /**
     * @var array
     */
    private $validationErrors;

    /**
     * @param array $rules
     * @param array $data
     * @throws ValidationException
     */
    public function validate(array $rules, array $data)
    {
        foreach ($rules as $validatedPropertyName => $validationRule) {
            $validationMethodCalls = $this->getValidationMethodsCallsForRule($validationRule);
            foreach ($validationMethodCalls as $methodName => $methodArgs) {
                $dataValueForPropertyName = empty($data[$validatedPropertyName]) ? null : $data[$validatedPropertyName];
                call_user_func_array(array($this, $methodName),
                    array_merge(array($validatedPropertyName, $dataValueForPropertyName), $methodArgs));
            }
        }

        if (!empty($this->validationErrors)) {
            throw new ValidationException('Validation failed', $this->validationErrors);
        }
    }

    /**
     * @param string $rule
     * @return array
     */
    private function getValidationMethodsCallsForRule($rule)
    {
        $validationMethodsCalls = array();
        $ruleValidationConstraints = explode('|', $rule);

        foreach ($ruleValidationConstraints as $validationConstraint) {
            $constraintData = explode(':', $validationConstraint);
            $validationMethodsCalls[$constraintData[0]] = array_splice($constraintData, 1);
        }

        return $validationMethodsCalls;
    }

    /**
     * @param string $key
     * @param mixed|null $value
     */
    private function notEmpty($key, $value = null)
    {
        if (empty($value)) {
            $this->validationErrors[$key][] = 'Cannot be empty';
        }
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param int $max
     */
    private function max($key, $value, $max)
    {
        if (empty($value)) {
            return;
        }

        $failed = false;

        if (is_numeric($value)) {
            if ($value > $max) {

                $failed = true;
            }
        } elseif (strlen($value) > $max) {
            $failed = true;
        }

        if ($failed) {
            $this->validationErrors[$key][] = 'Cannot be greater than ' . $max;
        }
    }


    /**
     * @param string $key
     * @param mixed $value
     * @param int $min
     */
    private function min($key, $value, $min)
    {
        $failed = false;

        if (empty($value)) {
            $failed = true;
        } elseif (is_numeric($value)) {
            if ($value < $min) {

                $failed = true;
            }
        } elseif (strlen($value) < $min) {
            $failed = true;
        }

        if ($failed) {
            $this->validationErrors[$key][] = 'Cannot be lower/shorter than ' . $min;
        }
    }
}