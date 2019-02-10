<?php

namespace GitHubRepoComparator\ComparableGitRepositoryDataAmplifier;

use GitHubRepoComparator\Exception\DataNotFound\RepositoryNotFoundException;
use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;
use GitHubRepoComparator\Http\Client\HttpClient;
use GitHubRepoComparator\Http\Status\HttpStatus;
use GitHubRepoComparator\Utils\UrlUtils\UrlHelper;

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
        $linkToRepositoryStatisticsData = $this->generateLinkToRepoStatistics($gitRepository);
        $linkToRepositoryReleasesData = $this->generateLinkToRepoReleases($gitRepository);

        try {
            $repositoryStatisticsData = $this->httpClient->sendRequest($linkToRepositoryStatisticsData, HttpClient::METHOD_GET)
                ->getResponseData();
            $repositoryReleasesData = $this->httpClient->sendRequest($linkToRepositoryReleasesData, HttpClient::METHOD_GET)
                ->getResponseData();

        } catch (HttpClientException $exception) {
            if ($exception->getCode() == HttpStatus::HTTP_STATUS_NOT_FOUND) {
                throw new RepositoryNotFoundException($gitRepository->getName(), $gitRepository->getAuthorName());
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

    /**
     * @param ComparableGitRepository $gitRepository
     * @return string
     */
    private function generateLinkToRepoStatistics(ComparableGitRepository $gitRepository)
    {
        return UrlHelper::encodeUrl($this->gitHubApiLinkToFetchRepoData . '/' . $gitRepository->getFullName());
    }

    /**
     * @param ComparableGitRepository $gitRepository
     * @return string
     */
    private function generateLinkToRepoReleases(ComparableGitRepository $gitRepository)
    {
        return $this->generateLinkToRepoStatistics($gitRepository) . self::GITHUB_API_RELEASES_INFO_LINK_APPENDIX;
    }
}