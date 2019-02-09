<?php

namespace GitHubRepoComparator\Comparision;

interface GitRepositoryComparision extends GitRepositoryComparisionBase
{
    const FIRST_REPO_COMPARISION_KEY = 'first';
    const SECOND_REPO_COMPARISION_KEY = 'second';

    const QUANTITY_COMPARISION_KEY = 'quantity';
    const PERCENTAGE_COMPARISION_KEY = 'percentage';

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