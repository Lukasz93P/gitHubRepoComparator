<?php

namespace GitHubRepoComparator\Tests\Comparision\Comparator;

use GitHubRepoComparator\Comparision\Comparator\BasicGitRepositoryComparator;
use GitHubRepoComparator\Comparision\Comparator\GitRepositoryComparator;
use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\Utils\ComparisionUtils\ComparisionHelper;

class BasicGitRepositoryComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GitRepositoryComparator
     */
    private $gitRepositoryComparator;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $gitRepositoryComparisionBuilderMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $firstRepoMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $secondRepoMock;

    protected function setUp()
    {
        parent::setUp();

        $this->gitRepositoryComparisionBuilderMock =
            $this->getMock('GitHubRepoComparator\Comparision\ComparisionBuilder\ComparisionBuilder');

        $this->firstRepoMock =
            $this->getMock('GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository');
        $this->firstRepoMock
            ->method('getStarsQuantity')
            ->willReturn(10);
        $this->firstRepoMock
            ->method('getForksQuantity')
            ->willReturn(20);
        $this->firstRepoMock
            ->method('getWatchersQuantity')
            ->willReturn(50);
        $this->firstRepoMock
            ->method('getLastReleaseDate')
            ->willReturn('2019-01-20');
        $this->firstRepoMock
            ->method('getFullName')
            ->willReturn('author1/repo1');

        $this->secondRepoMock =
            $this->getMock('GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository');
        $this->secondRepoMock
            ->method('getStarsQuantity')
            ->willReturn(20);
        $this->secondRepoMock
            ->method('getForksQuantity')
            ->willReturn(20);
        $this->secondRepoMock
            ->method('getWatchersQuantity')
            ->willReturn(75);
        $this->secondRepoMock
            ->method('getLastReleaseDate')
            ->willReturn('2019-01-25');
        $this->secondRepoMock
            ->method('getFullName')
            ->willReturn('author2/repo2');

        $this->gitRepositoryComparator = new BasicGitRepositoryComparator($this->gitRepositoryComparisionBuilderMock);
    }

    public function testShouldSetProperStarsComparision()
    {

        $this->gitRepositoryComparisionBuilderMock->expects($this->once())
            ->method('setStarsComparision')
            ->with(array(
                    'author1/repo1' =>
                        array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => 10,
                            GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY => 33),
                    'author2/repo2' =>
                        array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => 20,
                            GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY => 67),
                    GitRepositoryComparision::BETTER_SCORE_COMPARISION_KEY => 'author2/repo2')
            )
            ->willReturn($this->gitRepositoryComparisionBuilderMock);

        $this->gitRepositoryComparisionBuilderMock->expects($this->once())
            ->method('setForksComparision')
            ->with(array(
                    'author1/repo1' =>
                        array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => 20,
                            GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY => 50),
                    'author2/repo2' =>
                        array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => 20,
                            GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY => 50),
                    GitRepositoryComparision::BETTER_SCORE_COMPARISION_KEY => GitRepositoryComparision::TIE_COMPARISION_KEY)
            )
            ->willReturn($this->gitRepositoryComparisionBuilderMock);

        $this->gitRepositoryComparisionBuilderMock->expects($this->once())
            ->method('setWatchersComparision')
            ->with(array(
                'author1/repo1' =>
                    array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => 50,
                        GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY => 40),
                'author2/repo2' =>
                    array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => 75,
                        GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY => 60),
                GitRepositoryComparision::BETTER_SCORE_COMPARISION_KEY => 'author2/repo2'))
            ->willReturn($this->gitRepositoryComparisionBuilderMock);

        $this->gitRepositoryComparisionBuilderMock->expects($this->once())
            ->method('setLastReleaseDateComparision')
            ->with(array(ComparisionHelper::NEWER_DATE_COMPARISION_VALUE => 'author2/repo2',
                'author2/repo2' => '2019-01-25',
                'author1/repo1' => '2019-01-20',
                'diff' => 5))
            ->willReturn($this->gitRepositoryComparisionBuilderMock);

        $this->gitRepositoryComparator->compare($this->firstRepoMock, $this->secondRepoMock);
    }
}