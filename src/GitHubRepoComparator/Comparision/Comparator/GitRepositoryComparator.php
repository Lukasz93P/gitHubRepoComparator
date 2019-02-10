<?php

namespace GitHubRepoComparator\Comparision\Comparator;

use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface GitRepositoryComparator
{
    const FIRST_REPOSITORY_COMPARISION_KEY = 'first';
    const SECOND_REPOSITORY_COMPARISION_KEY = 'second';

    /**
     * @param ComparableGitRepository $firstRepository
     * @param ComparableGitRepository $secondRepository
     * @return GitRepositoryComparision
     */
    public function compare(ComparableGitRepository $firstRepository, ComparableGitRepository $secondRepository);
}