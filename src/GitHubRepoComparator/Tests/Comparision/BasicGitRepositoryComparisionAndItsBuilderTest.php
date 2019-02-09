<?php

namespace GitHubRepoComparator\Tests\Comparision;

use GitHubRepoComparator\Comparision\ComparisionBuilder\BasicGitRepositoryComparisionBuilder;
use GitHubRepoComparator\Comparision\ComparisionBuilder\ComparisionBuilder;

class BasicGitRepositoryComparisionAndItsBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ComparisionBuilder
     */
    private $gitRepositoryComparisionBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->gitRepositoryComparisionBuilder = new BasicGitRepositoryComparisionBuilder();
    }

    public function testShouldBuildComparisionProperly()
    {
        $firstComparedRepository = $this
            ->getMock('GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository');
        $secondComparedRepository =
            $this->getMock('GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository');

        $starsComparision = array('first' => array('percentage' => 60, 'quantity' => 120),
            'second' => array('percentage' => 40, 'quantity' => 80));

        $forksComparision = array('first' => array('percentage' => 20, 'quantity' => 20),
            'second' => array('percentage' => 90, 'quantity' => 180));

        $watchersComparision = array('first' => array('percentage' => 50, 'quantity' => 20),
            'second' => array('percentage' => 50, 'quantity' => 20));

        $lastReleaseComparision = array('first' => array('newer' => 'second', 'diff' => 20));

        $gitRepositoryComparision = $this->gitRepositoryComparisionBuilder
            ->setFirstComparedRepository($firstComparedRepository)
            ->setSecondComparedRepository($secondComparedRepository)
            ->setForksComparision($forksComparision)
            ->setWatchersComparision($watchersComparision)
            ->setStarsComparision($starsComparision)
            ->setLastReleaseDateComparision($lastReleaseComparision)
            ->build();

        $this->assertEquals($firstComparedRepository, $gitRepositoryComparision->getFirstComparedRepository());
        $this->assertEquals($secondComparedRepository, $gitRepositoryComparision->getSecondComparedRepository());
        $this->assertEquals($starsComparision, $gitRepositoryComparision->getStarsComparision());
        $this->assertEquals($forksComparision, $gitRepositoryComparision->getForksComparision());
        $this->assertEquals($watchersComparision, $gitRepositoryComparision->getWatchersComparision());
        $this->assertEquals($lastReleaseComparision, $gitRepositoryComparision->getLastReleaseDateComparision());
    }
}