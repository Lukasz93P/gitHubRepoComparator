<?php

namespace GitHubRepoComparator\Validation;

use GitHubRepoComparator\Exception\Validation\ValidationException;

interface Validator
{
    /**
     * @param array $rules
     * @param array $data
     * @return void
     * @throws ValidationException
     */
    public function validate(array $rules, array $data);
}