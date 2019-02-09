<?php

namespace GitHubRepoComparator\Comparision\Comparator\SelfComparator;

use GitHubRepoComparator\Comparision\SelfComparision\GitRepositorySelfComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface GitRepositorySelfComparator
{
    /**
     * @param ComparableGitRepository $firstRepositoryVersion
     * @param ComparableGitRepository $secondRepositoryVersion
     * @return GitRepositorySelfComparision
     * @throws \RuntimeException
     */
    public function compare(ComparableGitRepository $firstRepositoryVersion, ComparableGitRepository $secondRepositoryVersion);
}