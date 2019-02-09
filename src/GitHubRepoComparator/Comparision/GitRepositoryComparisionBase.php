<?php

namespace GitHubRepoComparator\Comparision;

use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface GitRepositoryComparisionBase
{
    /**
     * @return ComparableGitRepository
     */
    public function getFirstComparedRepository();

    /**
     * @return ComparableGitRepository
     */
    public function getSecondComparedRepository();
}