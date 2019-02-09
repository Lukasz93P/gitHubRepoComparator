<?php

namespace GitHubRepoComparator\Comparision;

use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

abstract class ComparisionDataSource
{
    /**
     * @var ComparableGitRepository
     */
    protected $firstComparedRepository;

    /**
     * @var ComparableGitRepository
     */
    protected $secondComparedRepository;

    /**
     * @var array
     */
    protected $starsComparision;

    /**
     * @var array
     */
    protected $forksComparision;

    /**
     * @var array
     */
    protected $watchersComparision;

    /**
     * @var array
     */
    protected $lastReleaseDateComparision;
}