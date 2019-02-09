<?php

namespace GitHubRepoComparator\GitRepository\Factory;

use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;
use GitHubRepoComparator\GitRepository\GitRepository;

interface GitRepositoryFactory
{
    /**
     * @param string $authorName
     * @param string $repositoryName
     * @return GitRepository
     */
    public function makeGitRepository($authorName, $repositoryName);

    /**
     * @param string $authorName
     * @param string $repositoryName
     * @return ComparableGitRepository
     */
    public function makeComparableGitRepository($authorName, $repositoryName);
}