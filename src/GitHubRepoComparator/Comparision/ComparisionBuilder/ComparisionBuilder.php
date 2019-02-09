<?php

namespace GitHubRepoComparator\Comparision\ComparisionBuilder;

use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface ComparisionBuilder
{
    /**
     * @return GitRepositoryComparision
     */
    public function build();

    /**
     * @param ComparableGitRepository $comparableGitRepository
     * @return $this
     */
    public function setFirstComparedRepository(ComparableGitRepository $comparableGitRepository);

    /**
     * @param ComparableGitRepository $comparableGitRepository
     * @return $this
     */
    public function setSecondComparedRepository(ComparableGitRepository $comparableGitRepository);

    /**
     * @param array $starsComparision
     * @return $this
     */
    public function setStarsComparision(array $starsComparision);

    /**
     * @param array $forksComparison
     * @return $this
     */
    public function setForksComparision(array $forksComparison);

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
}