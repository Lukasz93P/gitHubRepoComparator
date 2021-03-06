<?php

namespace GitHubRepoComparator\GitRepository\ComparableRepository;

use GitHubRepoComparator\GitRepository\GitRepository;
use GitHubRepoComparator\Serialization\Serializable\Serializable;

interface ComparableGitRepository extends GitRepository, Serializable
{
    /**
     * @param int $starsQuantity
     * @return $this
     */
    public function setStarsQuantity($starsQuantity);

    /**
     * @return int
     */
    public function getStarsQuantity();

    /**
     * @param int $forksQuantity
     * @return $this
     */
    public function setForksQuantity($forksQuantity);

    /**
     * @return int
     */
    public function getForksQuantity();

    /**
     * @param int $watchersQuantity
     * @return $this
     */
    public function setWatchersQuantity($watchersQuantity);

    /**
     * @return int
     */
    public function getWatchersQuantity();

    /**
     * @param string $lastReleaseDate
     * @return $this
     */
    public function setLastReleaseDate($lastReleaseDate);

    /**
     * @return string
     */
    public function getLastReleaseDate();

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url);

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param string $avatarUrl
     * @return $this
     */
    public function setAvatarUrl($avatarUrl);

    /**
     * @return string
     */
    public function getAvatarUrl();
}