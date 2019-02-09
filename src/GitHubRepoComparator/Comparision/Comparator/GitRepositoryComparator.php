<?php

namespace GitHubRepoComparator\Comparision\Comparator;

use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface GitRepositoryComparator
{
    /**
     * @param ComparableGitRepository $firstRepo
     * @param ComparableGitRepository $secondRepo
     * @return GitRepositoryComparision
     */
    public function compare(ComparableGitRepository $firstRepo, ComparableGitRepository $secondRepo);
}