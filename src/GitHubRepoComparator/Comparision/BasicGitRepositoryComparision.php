<?php

namespace GitHubRepoComparator\Comparision;

use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

class BasicGitRepositoryComparision extends ComparisionDataSource implements GitRepositoryComparision
{
    /**
     * BasicGitRepositoryComparision constructor.
     * @param ComparableGitRepository $firstComparedRepository
     * @param ComparableGitRepository $secondComparedRepository
     * @param array $starsComparision
     * @param array $forksComparision
     * @param array $watchersComparision
     * @param $lastReleaseDateComparision
     */
    public function __construct(ComparableGitRepository $firstComparedRepository,
                                ComparableGitRepository $secondComparedRepository,
                                array $starsComparision,
                                array $forksComparision,
                                array $watchersComparision,
                                array $lastReleaseDateComparision)
    {
        $this->firstComparedRepository = $firstComparedRepository;
        $this->secondComparedRepository = $secondComparedRepository;
        $this->starsComparision = $starsComparision;
        $this->forksComparision = $forksComparision;
        $this->watchersComparision = $watchersComparision;
        $this->lastReleaseDateComparision = $lastReleaseDateComparision;
    }

    /**
     * @return ComparableGitRepository
     */
    public function getFirstComparedRepository()
    {
        return $this->firstComparedRepository;
    }

    /**
     * @return ComparableGitRepository
     */
    public function getSecondComparedRepository()
    {
        return $this->secondComparedRepository;
    }

    /**
     * @return array
     */
    public function getStarsComparision()
    {
        return $this->starsComparision;
    }

    /**
     * @return array
     */
    public function getForksComparision()
    {
        return $this->forksComparision;
    }

    /**
     * @return array
     */
    public function getWatchersComparision()
    {
        return $this->watchersComparision;
    }

    /**
     * @return mixed
     */
    public function getLastReleaseDateComparision()
    {
        return $this->lastReleaseDateComparision;
    }

    /**
     * @return array
     */
    public function getComparedRepositories()
    {
        return array($this->firstComparedRepository, $this->secondComparedRepository);
    }


    public function getSerializableProperties()
    {
        return array('comparedRepositories', 'forksComparision', 'starsComparision',
            'forksComparision', 'watchersComparision', 'lastReleaseDateComparision');
    }
}