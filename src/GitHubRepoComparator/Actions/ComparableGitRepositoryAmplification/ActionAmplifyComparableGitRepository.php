<?php

namespace GitHubRepoComparator\Actions\ComparableGitRepositoryAmplification;

use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface ActionAmplifyComparableGitRepository
{
    /**
     * @param ComparableGitRepository $repository
     * @return ComparableGitRepository
     * @throws \RuntimeException
     */
    public function execute(ComparableGitRepository $repository);
}