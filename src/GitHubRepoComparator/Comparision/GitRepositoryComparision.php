<?php

namespace GitHubRepoComparator\Comparision;

interface GitRepositoryComparision extends GitRepositoryComparisionBase
{
    /**
     * @param array $starsComparision
     * @return $this
     */
    public function setStarsComparision(array $starsComparision);

    /**
     * @return array
     */
    public function getStarsComparision();

    /**
     * @param array $forksComparison
     * @return $this
     */
    public function setForksComparision(array $forksComparison);

    /**
     * @return array
     */
    public function getForksComparision();

    /**
     * @param array $watchersComparision
     * @return $this
     */
    public function setWatchersComparision(array $watchersComparision);

    /**
     * @param array $lastReleaseDateComparision
     * @return $this
     */
    public function setLastReleaseDateComparision(array $lastReleaseDateComparision);

    /**
     * @return array
     */
    public function getLastReleaseDateComparision();
}