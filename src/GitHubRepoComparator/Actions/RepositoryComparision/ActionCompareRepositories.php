<?php

namespace GitHubRepoComparator\Actions\RepositoryComparision;

use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface ActionCompareRepositories
{
    /**
     * @param ComparableGitRepository $firstRepository
     * @param ComparableGitRepository $secondRepository
     * @return GitRepositoryComparision
     */
    public function execute(ComparableGitRepository $firstRepository, ComparableGitRepository $secondRepository);
}