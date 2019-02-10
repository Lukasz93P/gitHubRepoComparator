<?php

namespace GitHubRepoComparator\Http\Client\RepositoryDataApiClient;

use GitHubRepoComparator\Exception\DataNotFound\RepositoryNotFoundException;
use GitHubRepoComparator\GitRepository\GitRepository;

interface RepositoryDataApiClient
{
    const GITHUB_API_URL = 'https://api.github.com/repos';
    const GITHUB_API_RELEASES_INFO_LINK_APPENDIX = '/releases';

    const STARS_QUANTITY_GITHUB_RESPONSE_KEY = 'stargazers_count';
    const WATCHERS_QUANTITY_GITHUB_RESPONSE_KEY = 'watchers_count';
    const FORKS_QUANTITY_GITHUB_RESPONSE_KEY = 'forks_count';
    const OWNER_DATA_GITHUB_RESPONSE_KEY = 'owner';
    const AVATAR_URL_GITHUB_RESPONSE_KEY = 'avatar_url';
    const REPOSITORY_URL_GIT_HUB_RESPONSE_KEY = 'svn_url';

    const PUBLISHED_AT_RELEASE_GITHUB_RESPONSE_KEY = 'published_at';

    /**
     * @param GitRepository $repository
     * @return array
     * @throws RepositoryNotFoundException
     */
    public function getRepositoryStatisticsData(GitRepository $repository);

    /**
     * @param GitRepository $repository
     * @return array
     */
    public function getRepositoryReleasesData(GitRepository $repository);
}