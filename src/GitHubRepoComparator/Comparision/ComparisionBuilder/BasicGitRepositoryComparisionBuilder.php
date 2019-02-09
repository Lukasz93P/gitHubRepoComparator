<?php

namespace GitHubRepoComparator\Comparision\ComparisionBuilder;

use GitHubRepoComparator\Comparision\BasicGitRepositoryComparision;
use GitHubRepoComparator\Comparision\ComparisionDataSource;
use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

final class BasicGitRepositoryComparisionBuilder extends ComparisionDataSource implements ComparisionBuilder
{
    /**
     * @return GitRepositoryComparision
     */
    public function build()
    {
        return new BasicGitRepositoryComparision($this->firstComparedRepository,
            $this->secondComparedRepository,
            $this->starsComparision,
            $this->forksComparision,
            $this->watchersComparision,
            $this->lastReleaseDateComparision);
    }

    /**
     * @param ComparableGitRepository $firstComparedRepository
     * @return $this
     */
    public function setFirstComparedRepository(ComparableGitRepository $firstComparedRepository)
    {
        $this->firstComparedRepository = $firstComparedRepository;

        return $this;
    }

    /**
     * @param ComparableGitRepository $secondComparedRepository
     * @return $this
     */
    public function setSecondComparedRepository(ComparableGitRepository $secondComparedRepository)
    {
        $this->secondComparedRepository = $secondComparedRepository;

        return $this;
    }

    /**
     * @param array $starsComparision
     * @return $this
     */
    public function setStarsComparision(array $starsComparision)
    {
        $this->starsComparision = $starsComparision;

        return $this;
    }

    /**
     * @param array $forksComparision
     * @return $this
     */
    public function setForksComparision(array $forksComparision)
    {
        $this->forksComparision = $forksComparision;

        return $this;
    }

    /**
     * @param array $watchersComparision
     * @return $this
     */
    public function setWatchersComparision(array $watchersComparision)
    {
        $this->watchersComparision = $watchersComparision;

        return $this;
    }

    /**
     * @param array $lastReleaseDateComparision
     * @return $this
     */
    public function setLastReleaseDateComparision(array $lastReleaseDateComparision)
    {
        $this->lastReleaseDateComparision = $lastReleaseDateComparision;

        return $this;
    }
}