<?php

namespace GitHubRepoComparator\Validation;

use GitHubRepoComparator\Exception\Validation\ValidationException;

interface Validator
{
    const NOT_EMPTY_VALIDATION_RULE = 'notempty';
    const MAX_VALIDATION_RULE = 'max';
    const MIN_VALIDATION_RULE = 'mix';

    /**
     * @param array $rules
     * @param array $data
     * @return void
     * @throws ValidationException
     */
    public function validate(array $rules, array $data);
}