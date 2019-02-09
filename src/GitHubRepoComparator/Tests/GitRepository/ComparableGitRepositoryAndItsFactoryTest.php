<?php

namespace GitHubRepoComparator\Tests\GitRepository;

use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;
use GitHubRepoComparator\GitRepository\Factory\BasicGitRepositoryFactory;
use GitHubRepoComparator\GitRepository\Factory\GitRepositoryFactory;
use GitHubRepoComparator\GitRepository\GitRepository;

class ComparableGitRepositoryAndItsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GitRepositoryFactory
     */
    private $gitRepositoryFactory;

    /**
     * @var string
     */
    private $authorName = 'testAuthor';

    /**
     * @var string
     */
    private $repoName = 'testRepo';

    protected function setUp()
    {
        parent::setUp();
        $this->gitRepositoryFactory = new BasicGitRepositoryFactory();
    }

    public function testShouldBuildGitRepository()
    {
        $repository = $this->gitRepositoryFactory->makeGitRepository($this->authorName, $this->repoName);
        $this->assertEquals('GitHubRepoComparator\GitRepository\BasicGitRepository', get_class($repository));
        $this->assertTrue($repository instanceof GitRepository);
        $this->assertEquals($repository->getAuthorName(), $this->authorName);
        $this->assertEquals($repository->getName(), $this->repoName);
    }

    public function testShouldBuildComparableGitRepository()
    {
        $comparableGitRepository = $this->gitRepositoryFactory->makeComparableGitRepository($this->authorName, $this->repoName);
        $this->assertEquals('GitHubRepoComparator\GitRepository\ComparableRepository\BasicComparableGitRepository',
            get_class($comparableGitRepository));
        $this->assertEquals($comparableGitRepository->getAuthorName(), $this->authorName);
        $this->assertEquals($comparableGitRepository->getName(), $this->repoName);
        $this->assertTrue($comparableGitRepository instanceof ComparableGitRepository);
        $this->assertTrue($comparableGitRepository instanceof GitRepository);
    }
}