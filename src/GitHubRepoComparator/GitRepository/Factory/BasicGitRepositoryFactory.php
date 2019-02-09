<?php

namespace GitHubRepoComparator\GitRepository\Factory;

use GitHubRepoComparator\GitRepository\BasicGitRepository;
use GitHubRepoComparator\GitRepository\ComparableRepository\BasicComparableGitRepository;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;
use GitHubRepoComparator\GitRepository\GitRepository;

class BasicGitRepositoryFactory implements GitRepositoryFactory
{
    /**
     * @param string $authorName
     * @param string $repositoryName
     * @return BasicGitRepository|GitRepository
     */
    public function makeGitRepository($authorName, $repositoryName)
    {
        return new BasicGitRepository($authorName, $repositoryName);
    }

    /**
     * @param string $authorName
     * @param string $repositoryName
     * @return BasicComparableGitRepository|ComparableGitRepository
     */
    public function makeComparableGitRepository($authorName, $repositoryName)
    {
        return new BasicComparableGitRepository(new BasicGitRepository($authorName, $repositoryName));
    }
}