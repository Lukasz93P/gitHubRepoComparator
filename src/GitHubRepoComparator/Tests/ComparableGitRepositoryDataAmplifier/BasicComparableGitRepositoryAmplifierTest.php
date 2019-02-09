<?php

namespace GitHubRepoComparator\Tests\ComparableGitRepositoryDataAmplifier;

use GitHubRepoComparator\ComparableGitRepositoryDataAmplifier\BasicComparableGitRepositoryDataAmplifier;
use GitHubRepoComparator\ComparableGitRepositoryDataAmplifier\ComparableGitRepositoryDataAmplifier;
use GitHubRepoComparator\Exception\DataNotFound\RepositoryNotFoundException;
use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;
use GitHubRepoComparator\Http\Client\HttpClient;
use GitHubRepoComparator\Http\Status\HttpStatus;

class BasicComparableGitRepositoryAmplifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $httpClientMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $comparableRepositoryMock;

    /**
     * @var BasicComparableGitRepositoryDataAmplifier;
     */
    private $repoAmplifier;

    /**
     * @var string
     */
    private $link = 'https://api.github.com/repos';

    protected function setUp()
    {
        parent::setUp();
        $this->httpClientMock = $this->getMock('GitHubRepoComparator\Http\Client\CurlHttpClient');
        $this->comparableRepositoryMock
            = $this->getMockBuilder('GitHubRepoComparator\GitRepository\ComparableRepository\BasicComparableGitRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $this->repoAmplifier = new BasicComparableGitRepositoryDataAmplifier($this->httpClientMock, $this->link);
    }

    public function testShouldAmplifyRepository()
    {
        $testDate = '2018-07-22T14:57:18Z';
        $repoFullName = 'testAuthor/testRepo';
        $this->comparableRepositoryMock->expects($this->once())
            ->method('getFullName')
            ->willReturn('testAuthor/testRepo');

        $this->httpClientMock->expects($this->exactly(2))
            ->method('sendRequest')
            ->withConsecutive(
                array($this->link . '/' . $repoFullName, HttpClient::METHOD_GET),
                array($this->link . '/' . $repoFullName . ComparableGitRepositoryDataAmplifier::GITHUB_API_RELEASES_INFO_LINK_APPENDIX, HttpClient::METHOD_GET)
            )
            ->willReturn($this->httpClientMock);

        $this->httpClientMock->expects($this->exactly(2))
            ->method('getResponseData')
            ->willReturnOnConsecutiveCalls(
                array(ComparableGitRepositoryDataAmplifier::STARS_QUANTITY_GITHUB_RESPONSE_KEY => 10,
                    ComparableGitRepositoryDataAmplifier::FORKS_QUANTITY_GITHUB_RESPONSE_KEY => 2,
                    ComparableGitRepositoryDataAmplifier::WATCHERS_QUANTITY_GITHUB_RESPONSE_KEY => 5),
                array(array(ComparableGitRepositoryDataAmplifier::PUBLISHED_AT_RELEASE_GITHUB_RESPONSE_KEY => $testDate))
            );

        $this->comparableRepositoryMock->expects($this->once())
            ->method('setStarsQuantity')
            ->with(10)
            ->willReturn($this->comparableRepositoryMock);

        $this->comparableRepositoryMock->expects($this->once())
            ->method('setForksQuantity')
            ->with(2)
            ->willReturn($this->comparableRepositoryMock);

        $this->comparableRepositoryMock->expects($this->once())
            ->method('setWatchersQuantity')
            ->with(5)
            ->willReturn($this->comparableRepositoryMock);

        $this->comparableRepositoryMock->expects($this->once())
            ->method('setLastReleaseDate')
            ->with($testDate);

        $this->repoAmplifier->amplifyRepository($this->comparableRepositoryMock);
    }

    public function testShouldThrowRepositoryNotFoundException()
    {
        $this->httpClientMock->expects($this->once())
            ->method('sendRequest')
            ->willThrowException(new HttpClientException('', HttpStatus::HTTP_STATUS_NOT_FOUND));

        $this->comparableRepositoryMock->expects($this->once())
            ->method('getFullName')
            ->willReturn('testAuthor/testRepo');

        $this->comparableRepositoryMock->expects($this->once())
            ->method('getAuthorName')
            ->willReturn('testAuthor');

        $testException = false;
        try {
            $this->repoAmplifier->amplifyRepository($this->comparableRepositoryMock);
        } catch (RepositoryNotFoundException $exception) {
            $testException = $exception;
        }

        $this->assertNotEmpty($testException);
    }

    public function testShouldThrowHttpClientException()
    {
        $this->httpClientMock->expects($this->once())
            ->method('sendRequest')
            ->willThrowException(new HttpClientException('', 500));

        $this->comparableRepositoryMock->expects($this->once())
            ->method('getFullName')
            ->willReturn('testAuthor/testRepo');

        $testException = false;
        try {
            $this->repoAmplifier->amplifyRepository($this->comparableRepositoryMock);
        } catch (HttpClientException $exception) {
            $testException = $exception;
        }

        $this->assertNotEmpty($testException);
        $this->assertTrue($testException instanceof HttpClientException);
    }
}