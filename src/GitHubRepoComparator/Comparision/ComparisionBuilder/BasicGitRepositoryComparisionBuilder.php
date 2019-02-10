<?php

namespace GitHubRepoComparator\Comparision\ComparisionBuilder;

use GitHubRepoComparator\Comparision\BasicGitRepositoryComparision;
use GitHubRepoComparator\Comparision\GitRepositoryComparision;

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