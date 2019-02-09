<?php

namespace GitHubRepoComparator\GitRepository;

interface GitRepository
{
    /**
     * @return string
     */
    public function getAuthorName();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getFullName();
}