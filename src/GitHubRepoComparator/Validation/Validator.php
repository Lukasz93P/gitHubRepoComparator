<?php

namespace GitHubRepoComparator\Validation;

interface Validator
{
    /**
     * @param array $rules
     * @param array $data
     * @return void
     * @throws \RuntimeException
     */
    public function validate(array $rules, array $data);
}