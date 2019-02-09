<?php

namespace GitHubRepoComparator\ComparableGitRepositoryDataAmplifier;

use GitHubRepoComparator\Exception\DataNotFound\RepositoryNotFoundException;
use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

interface ComparableGitRepositoryDataAmplifier
{
    const STARS_QUANTITY_GITHUB_RESPONSE_KEY = 'stargazers_count';
    const WATCHERS_QUANTITY_GITHUB_RESPONSE_KEY = 'watchers_count';
    const FORKS_QUANTITY_GITHUB_RESPONSE_KEY = 'forks_count';
    const GITHUB_API_RELEASES_INFO_LINK_APPENDIX = '/releases';
    const PUBLISHED_AT_RELEASE_GITHUB_RESPONSE_KEY = 'published_at';

    /**
     * @param ComparableGitRepository $gitRepository
     * @return ComparableGitRepository
     * @throws HttpClientException|RepositoryNotFoundException
     */
    public function amplifyRepository(ComparableGitRepository $gitRepository);
}