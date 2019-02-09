<?php

namespace GitHubRepoComparator\GitRepository;

final class BasicGitRepository implements GitRepository
{
    /**
     * @var string
     */
    private $authorName;

    /**
     * @var string
     */
    private $name;

    /**
     * BasicGitRepository constructor.
     * @param string $authorName
     * @param string $name
     */
    public function __construct($authorName, $name)
    {
        $this->authorName = $authorName;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}