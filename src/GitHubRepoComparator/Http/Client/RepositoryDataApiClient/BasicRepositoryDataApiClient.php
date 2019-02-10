<?php

namespace GitHubRepoComparator\Http\Client\RepositoryDataApiClient;

use GitHubRepoComparator\Exception\DataNotFound\RepositoryNotFoundException;
use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;
use GitHubRepoComparator\GitRepository\GitRepository;
use GitHubRepoComparator\Http\Client\HttpClient;
use GitHubRepoComparator\Http\Status\HttpStatus;
use GitHubRepoComparator\Utils\UrlUtils\UrlHelper;

class BasicRepositoryDataApiClient implements RepositoryDataApiClient
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var string
     */
    private $gitHubApiUrl;

    /**
     * @var string
     */
    private $githubReleasesApiUrlAppendix;

    /**
     * BasicRepositoryDataApiClient constructor.
     * @param HttpClient $httpClient
     * @param string $gitHubApiUrl
     * @param string $githubReleasesApiUrlAppendix
     */
    public function __construct(HttpClient $httpClient,
                                $gitHubApiUrl = self::GITHUB_API_URL,
                                $githubReleasesApiUrlAppendix = self::GITHUB_API_RELEASES_INFO_LINK_APPENDIX)
    {
        $this->httpClient = $httpClient;
        $this->gitHubApiUrl = $gitHubApiUrl;
        $this->githubReleasesApiUrlAppendix = $githubReleasesApiUrlAppendix;
    }

    /**
     * @param GitRepository $repository
     * @return array
     * @throws \Exception
     */
    public function getRepositoryStatisticsData(GitRepository $repository)
    {
        return $this->getApiData($repository, $this->generateLinkToRepoStatistics($repository));
    }

    /**
     * @param GitRepository $repository
     * @return array
     * @throws \Exception
     */
    public function getRepositoryReleasesData(GitRepository $repository)
    {
        return $this->getApiData($repository, $this->generateLinkToRepoReleases($repository));
    }

    /**
     * @param GitRepository $repository
     * @param $link
     * @return array
     * @throws \Exception
     */
    private function getApiData(GitRepository $repository, $link)
    {
        try {
            return $this->httpClient->sendRequest($link, HttpClient::METHOD_GET)
                ->getResponseData();

        } catch (HttpClientException $exception) {
            $this->checkException($exception, $repository);
        }
    }

    /**
     * @param \Exception $exception
     * @param GitRepository $repository
     * @throws \Exception
     */
    private function checkException(\Exception $exception, GitRepository $repository)
    {
        if ($exception->getCode() == HttpStatus::HTTP_STATUS_NOT_FOUND) {
            throw new RepositoryNotFoundException($repository->getName(), $repository->getAuthorName());
        }
        throw $exception;
    }

    /**
     * @param GitRepository $gitRepository
     * @return string
     */
    private function generateLinkToRepoStatistics(GitRepository $gitRepository)
    {
        return UrlHelper::encodeUrl($this->gitHubApiUrl . '/' . $gitRepository->getFullName());
    }

    /**
     * @param GitRepository $gitRepository
     * @return string
     */
    private function generateLinkToRepoReleases(GitRepository $gitRepository)
    {
        return $this->generateLinkToRepoStatistics($gitRepository) . $this->githubReleasesApiUrlAppendix;
    }
}