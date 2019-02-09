<?php

namespace GitHubRepoComparator\GitRepository;

interface GitRepository
{
    /**
     * @param string $authorName
     * @return $this
     */
    public function setAuthorName($authorName);

    /**
     * @return string
     */
    public function getAuthorName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();
}