<?php

namespace GitHubRepoComparator\Actions\RepositoryDataValidation;

use GitHubRepoComparator\Exception\Validation\ValidationException;

interface ActionValidateRepositoryData
{
    /**
     * @param array $data
     * @return void
     * @throws ValidationException
     */
    public function execute(array $data);
}