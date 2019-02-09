<?php

namespace GitHubRepoComparator\Comparision\Comparator;

use GitHubRepoComparator\Comparision\ComparisionBuilder\ComparisionBuilder;
use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;
use GitHubRepoComparator\Utils\ComparisionUtils\ComparisionHelper;

final class BasicGitRepositoryComparator implements GitRepositoryComparator
{
    /**
     * @var ComparisionBuilder
     */
    private $comparisionBuilder;

    /**
     * BasicGitRepositoryComparator constructor.
     * @param ComparisionBuilder $comparisionBuilder
     */
    public function __construct(ComparisionBuilder $comparisionBuilder)
    {
        $this->comparisionBuilder = $comparisionBuilder;
    }


    /**
     * @param ComparableGitRepository $firstRepo
     * @param ComparableGitRepository $secondRepo
     * @return GitRepositoryComparision
     */
    public function compare(ComparableGitRepository $firstRepo, ComparableGitRepository $secondRepo)
    {
        $starsComparision = $this->compareNumericValues($firstRepo->getStarsQuantity(), $secondRepo->getStarsQuantity());
        $forksComparision = $this->compareNumericValues($firstRepo->getForksQuantity(), $secondRepo->getForksQuantity());
        $watchersComparision = $this->compareNumericValues($firstRepo->getWatchersQuantity(), $secondRepo->getWatchersQuantity());
        $lastReleaseDateComparision = ComparisionHelper::compareDates($firstRepo->getLastReleaseDate(), $secondRepo->getLastReleaseDate());

        return $this->comparisionBuilder
            ->setStarsComparision($starsComparision)
            ->setForksComparision($forksComparision)
            ->setWatchersComparision($watchersComparision)
            ->setLastReleaseDateComparision($lastReleaseDateComparision)
            ->build();
    }

    /**
     * @param int $firstQuantity
     * @param int $secondQuantity
     * @return array
     */
    private function compareNumericValues($firstQuantity, $secondQuantity)
    {
        $percentageCalculationValues = ComparisionHelper::comparePercentageShares($firstQuantity, $secondQuantity);

        return array(
            GitRepositoryComparision::FIRST_REPO_COMPARISION_KEY =>
                array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => $firstQuantity,
                    GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY =>
                        $percentageCalculationValues[ComparisionHelper::FIRST_PERCENTAGE_COMPARISION_VALUE]),
            GitRepositoryComparision::SECOND_REPO_COMPARISION_KEY =>
                array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => $secondQuantity,
                    GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY =>
                        $percentageCalculationValues[ComparisionHelper::SECOND_PERCENTAGE_COMPARISION_VALUE])
        );
    }
}