<?php

namespace GitHubRepoComparator\Comparision\SelfComparision;

use GitHubRepoComparator\Comparision\GitRepositoryComparisionBase;

interface GitRepositorySelfComparision extends GitRepositoryComparisionBase
{
    /**
     * @param $starsQuantityChange
     * @return $this
     */
    public function setStarsQuantityChange($starsQuantityChange);

    /**
     * @return int
     */
    public function getStarsQuantityChange();

    /**
     * @param int $forksQuantityChange
     * @return $this
     */
    public function setForksQuantityChange($forksQuantityChange);

    /**
     * @return int
     */
    public function getForksQuantityChange();

    /**
     * @param int $watchersQuantityChange
     * @return $this
     */
    public function setWatchersQuantityChange($watchersQuantityChange);

    /**
     * @return int
     */
    public function getWatchersQuantityChange();
}