<?php

namespace GitHubRepoComparator\ComparableGitRepositoryDataAmplifier;

use GitHubRepoComparator\Exception\DataNotFound\RepositoryNotFoundException;
use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;
use GitHubRepoComparator\Http\Client\RepositoryDataApiClient\RepositoryDataApiClient;
use GitHubRepoComparator\Utils\DateUtils\DateHelper;

class BasicComparableGitRepositoryDataAmplifier implements ComparableGitRepositoryDataAmplifier
{
    /**
     * @var RepositoryDataApiClient
     */
    private $repositoryDataApiClient;

    /**
     * BasicComparableGitRepositoryDataAmplifier constructor.
     * @param RepositoryDataApiClient $repositoryDataApiClient
     */
    public function __construct(RepositoryDataApiClient $repositoryDataApiClient)
    {
        $this->repositoryDataApiClient = $repositoryDataApiClient;
    }

    /**
     * @param ComparableGitRepository $gitRepository
     * @return ComparableGitRepository
     * @throws HttpClientException|RepositoryNotFoundException
     */
    public function amplifyRepository(ComparableGitRepository $gitRepository)
    {
        $repositoryStatisticsData = $this->repositoryDataApiClient->getRepositoryStatisticsData($gitRepository);
        $repositoryReleasesData = $this->repositoryDataApiClient->getRepositoryReleasesData($gitRepository);

        return $this->fillInRepositoryWithData($gitRepository, $repositoryStatisticsData, $repositoryReleasesData);
    }

    /**
     * @param ComparableGitRepository $repository
     * @param array $statisticsData
     * @param array $releasesData
     * @return ComparableGitRepository
     */
    private function fillInRepositoryWithData(ComparableGitRepository $repository, array $statisticsData, array $releasesData)
    {
        $repository->setStarsQuantity($statisticsData[RepositoryDataApiClient::STARS_QUANTITY_GITHUB_RESPONSE_KEY]);
        $repository->setForksQuantity($statisticsData[RepositoryDataApiClient::FORKS_QUANTITY_GITHUB_RESPONSE_KEY]);
        $repository->setWatchersQuantity($statisticsData[RepositoryDataApiClient::WATCHERS_QUANTITY_GITHUB_RESPONSE_KEY]);
        $repository->setUrl($statisticsData[RepositoryDataApiClient::REPOSITORY_URL_GIT_HUB_RESPONSE_KEY]);

        $repository->setAvatarUrl(
            $statisticsData[RepositoryDataApiClient::OWNER_DATA_GITHUB_RESPONSE_KEY][RepositoryDataApiClient::AVATAR_URL_GITHUB_RESPONSE_KEY]);

        $repository->setLastReleaseDate(empty($releasesData) ? ''
            : DateHelper::trimDateString($releasesData[0][RepositoryDataApiClient::PUBLISHED_AT_RELEASE_GITHUB_RESPONSE_KEY]));

        return $repository;
    }
}