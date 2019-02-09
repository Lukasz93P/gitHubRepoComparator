<?php

namespace GitHubRepoComparator\Comparision;

interface GitRepositoryComparision extends GitRepositoryComparisionBase
{
    /**
     * @return array
     */
    public function getStarsComparision();

    /**
     * @return array
     */
    public function getForksComparision();

    /**
     * @return mixed
     */
    public function getWatchersComparision();

    /**
     * @return array
     */
    public function getLastReleaseDateComparision();
}