<?php

namespace GitHubRepoComparator\Comparision\ComparisionBuilder;

use GitHubRepoComparator\Comparision\BasicGitRepositoryComparision;
use GitHubRepoComparator\Comparision\ComparisionDataSource;
use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

class BasicGitRepositoryComparisionBuilder extends AbstractComparisionBuilder
{
    /**
     * @return GitRepositoryComparision
     */
    public function build()
    {
        return new BasicGitRepositoryComparision(
            $this->firstComparedRepository,
            $this->secondComparedRepository,
            $this->starsComparision,
            $this->forksComparision,
            $this->watchersComparision,
            $this->lastReleaseDateComparision);
    }
}