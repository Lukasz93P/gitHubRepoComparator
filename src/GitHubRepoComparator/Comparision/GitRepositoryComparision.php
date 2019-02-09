<?php

namespace GitHubRepoComparator\Comparision;

use GitHubRepoComparator\Serialization\Serializable\Serializable;

interface GitRepositoryComparision extends GitRepositoryComparisionBase, Serializable
{
    const QUANTITY_COMPARISION_KEY = 'quantity';
    const PERCENTAGE_COMPARISION_KEY = 'percentage';
    const BETTER_SCORE_COMPARISION_KEY = 'better';
    const TIE_COMPARISION_KEY = 'tie';

    const RELEASE_DATE_COMPARISION_FORMAT = 'Y-m-d';
    const RELEASE_DATE_COMPARISION_NEWER_KEY = 'newer';
    const RELEASE_DATE_COMPARISION_DIFF_KEY = 'diff';

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