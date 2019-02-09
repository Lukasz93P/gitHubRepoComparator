<?php

namespace GitHubRepoComparator\ComparableGitRepositoryDataAmplifier;

use GitHubRepoComparator\Exception\DataNotFound\RepositoryNotFoundException;
use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;
use GitHubRepoComparator\Http\Client\HttpClient;
use GitHubRepoComparator\Http\Status\HttpStatus;

class BasicComparableGitRepositoryDataAmplifier implements ComparableGitRepositoryDataAmplifier
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var string
     */
    private $gitHubApiLinkToFetchRepoData;

    static $counter = 0;
    /**
     * BasicComparableGitRepositoryDataAmplifier constructor.
     * @param HttpClient $httpClient
     * @param $gitHubApiLinkToFetchRepoData
     */
    public function __construct(HttpClient $httpClient, $gitHubApiLinkToFetchRepoData)
    {
        $this->httpClient = $httpClient;
        $this->gitHubApiLinkToFetchRepoData = $gitHubApiLinkToFetchRepoData;
    }

    /**
     * @param ComparableGitRepository $gitRepository
     * @return ComparableGitRepository
     * @throws HttpClientException|RepositoryNotFoundException
     */
    public function amplifyRepository(ComparableGitRepository $gitRepository)
    {
        $linkToGetRepositoryData = str_replace(array('%2F', '%3A'), array('/', ':'), rawurlencode($this->gitHubApiLinkToFetchRepoData . '/'
            . $gitRepository->getFullName()));

        try {
            $repositoryStatisticsData = $this->httpClient->sendRequest($linkToGetRepositoryData, HttpClient::METHOD_GET)
                ->getResponseData();
            $repositoryReleasesData = $this->httpClient->sendRequest($linkToGetRepositoryData . self::GITHUB_API_RELEASES_INFO_LINK_APPENDIX,
                HttpClient::METHOD_GET)
                ->getResponseData();

        } catch (HttpClientException $exception) {
            if ($exception->getCode() == HttpStatus::HTTP_STATUS_NOT_FOUND) {
                throw new RepositoryNotFoundException('Repository ' . $gitRepository->getName() . ' by '
                    . $gitRepository->getAuthorName() . ' not found');
            }
            throw $exception;
        }

        $gitRepository->setStarsQuantity($repositoryStatisticsData[self::STARS_QUANTITY_GITHUB_RESPONSE_KEY]);
        $gitRepository->setForksQuantity($repositoryStatisticsData[self::FORKS_QUANTITY_GITHUB_RESPONSE_KEY]);
        $gitRepository->setWatchersQuantity($repositoryStatisticsData[self::WATCHERS_QUANTITY_GITHUB_RESPONSE_KEY]);
        $gitRepository->setLastReleaseDate(empty($repositoryReleasesData) ? ''
            : $repositoryReleasesData[0][self::PUBLISHED_AT_RELEASE_GITHUB_RESPONSE_KEY]);
//
//
//        $gitRepository->setStarsQuantity(static::$counter ? 100 : 20);
//        $gitRepository->setForksQuantity(static::$counter ? 10 : 20);
//        $gitRepository->setWatchersQuantity(static::$counter ? 5 : 2);
//        $gitRepository->setLastReleaseDate(static::$counter ? '2019-02-01' : '2019-01-02');
//        static::$counter=true;
        return $gitRepository;
    }
}