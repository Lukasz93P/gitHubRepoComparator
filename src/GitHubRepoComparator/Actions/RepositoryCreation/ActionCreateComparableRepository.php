<?php

namespace GitHubRepoComparator\Actions\RepositoryCreation;

use GitHubRepoComparator\Exception\Validation\ValidationException;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface ActionCreateComparableRepository
{
    /**
     * @param array $data
     * @return ComparableGitRepository
     * @throws ValidationException
     */
    public function execute(array $data);
}