<?php

namespace GitHubRepoComparator\ComparableGitRepositoryDataAmplifier;

use GitHubRepoComparator\Exception\DataNotFound\RepositoryNotFoundException;
use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface ComparableGitRepositoryDataAmplifier
{
    /**
     * @param ComparableGitRepository $gitRepository
     * @return ComparableGitRepository
     * @throws HttpClientException|RepositoryNotFoundException
     */
    public function amplifyRepository(ComparableGitRepository $gitRepository);
}