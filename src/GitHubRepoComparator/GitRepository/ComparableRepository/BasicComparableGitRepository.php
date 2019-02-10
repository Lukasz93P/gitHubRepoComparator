<?php

namespace GitHubRepoComparator\GitRepository\ComparableRepository;

use GitHubRepoComparator\GitRepository\GitRepository;

class BasicComparableGitRepository implements ComparableGitRepository
{
    /**
     * @var GitRepository
     */
    private $gitRepository;

    /**
     * @var int
     */
    private $starsQuantity;

    /**
     * @var int
     */
    private $forksQuantity;

    /**
     * @var int
     */
    private $watchersQuantity;

    /**
     * @var int
     */
    private $lastReleaseDate;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $avatarUrl;

    /**
     * BasicComparableGitRepository constructor.
     * @param GitRepository $gitRepository
     */
    public function __construct(GitRepository $gitRepository)
    {
        $this->gitRepository = $gitRepository;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->gitRepository->getAuthorName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->gitRepository->getName();
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->gitRepository->getFullName();
    }

    /**
     * @return int
     */
    public function getStarsQuantity()
    {
        return $this->starsQuantity;
    }

    /**
     * @param int $starsQuantity
     * @return BasicComparableGitRepository
     */
    public function setStarsQuantity($starsQuantity)
    {
        $this->starsQuantity = $starsQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getForksQuantity()
    {
        return $this->forksQuantity;
    }

    /**
     * @param int $forksQuantity
     * @return BasicComparableGitRepository
     */
    public function setForksQuantity($forksQuantity)
    {
        $this->forksQuantity = $forksQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getWatchersQuantity()
    {
        return $this->watchersQuantity;
    }

    /**
     * @param int $watchersQuantity
     * @return BasicComparableGitRepository
     */
    public function setWatchersQuantity($watchersQuantity)
    {
        $this->watchersQuantity = $watchersQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getLastReleaseDate()
    {
        return $this->lastReleaseDate;
    }

    /**
     * @param int $lastReleaseDate
     * @return BasicComparableGitRepository
     */
    public function setLastReleaseDate($lastReleaseDate)
    {
        $this->lastReleaseDate = $lastReleaseDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return BasicComparableGitRepository
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @param string $avatarUrl
     * @return BasicComparableGitRepository
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;
        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->gitRepository, $name)) {
            return call_user_func_array(array($this->gitRepository, $name), $arguments);
        }
    }

    /**
     * @return array
     */
    public function getSerializableProperties()
    {
        return array('authorName', 'name', 'fullName', 'url', 'avatarUrl');
    }
}