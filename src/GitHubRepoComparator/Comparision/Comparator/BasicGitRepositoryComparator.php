<?php

namespace GitHubRepoComparator\Comparision\Comparator;

use Carbon\Carbon;
use GitHubRepoComparator\Comparision\ComparisionBuilder\ComparisionBuilder;
use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;
use GitHubRepoComparator\Utils\ComparisionUtils\ComparisionHelper;

class BasicGitRepositoryComparator implements GitRepositoryComparator
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
     * @param ComparableGitRepository $firstRepository
     * @param ComparableGitRepository $secondRepository
     * @return GitRepositoryComparision
     */
    public function compare(ComparableGitRepository $firstRepository, ComparableGitRepository $secondRepository)
    {
        $starsComparision = $this->compareNumericValues($firstRepository, $secondRepository, 'starsQuantity');
        $forksComparision = $this->compareNumericValues($firstRepository, $secondRepository, 'forksQuantity');
        $watchersComparision = $this->compareNumericValues($firstRepository, $secondRepository, 'watchersQuantity');
        $lastReleaseDateComparision = $this->compareReleaseDates($firstRepository, $secondRepository);

        return $this->comparisionBuilder
            ->setFirstComparedRepository($firstRepository)
            ->setSecondComparedRepository($secondRepository)
            ->setStarsComparision($starsComparision)
            ->setForksComparision($forksComparision)
            ->setWatchersComparision($watchersComparision)
            ->setLastReleaseDateComparision($lastReleaseDateComparision)
            ->build();
    }

    /**
     * @param ComparableGitRepository $firstRepository
     * @param ComparableGitRepository $secondRepository
     * @param string $valueToCompare
     * @return array
     */
    private function compareNumericValues(ComparableGitRepository $firstRepository,
                                          ComparableGitRepository $secondRepository,
                                          $valueToCompare)
    {
        $getterMethodName = 'get' . $valueToCompare;
        $firstQuantity = $firstRepository->$getterMethodName();
        $secondQuantity = $secondRepository->$getterMethodName();

        $percentageCalculationValues = ComparisionHelper::comparePercentageShares($firstQuantity, $secondQuantity);
        $firstRepositoryPercentageScore = $percentageCalculationValues[ComparisionHelper::FIRST_PERCENTAGE_COMPARISION_VALUE];
        $secondRepositoryPercentageScore = $percentageCalculationValues[ComparisionHelper::SECOND_PERCENTAGE_COMPARISION_VALUE];

        if ($firstQuantity == $secondQuantity) {
            $repositoryWithHigherScore = GitRepositoryComparision::TIE_COMPARISION_KEY;
        } else {
            $repositoryWithHigherScore = $firstRepositoryPercentageScore > $secondRepositoryPercentageScore
                ? self::FIRST_REPOSITORY_COMPARISION_KEY
                : self::SECOND_REPOSITORY_COMPARISION_KEY;
        }

        return array(
            self::FIRST_REPOSITORY_COMPARISION_KEY =>
                array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => $firstQuantity,
                    GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY =>
                        $firstRepositoryPercentageScore),
            self::SECOND_REPOSITORY_COMPARISION_KEY =>
                array(GitRepositoryComparision::QUANTITY_COMPARISION_KEY => $secondQuantity,
                    GitRepositoryComparision::PERCENTAGE_COMPARISION_KEY =>
                        $secondRepositoryPercentageScore),
            GitRepositoryComparision::MORE_SCORE_COMPARISION_KEY => $repositoryWithHigherScore,
        );
    }

    /**
     * @param ComparableGitRepository $firstRepo
     * @param ComparableGitRepository $secondRepo
     * @return array
     */
    private function compareReleaseDates(ComparableGitRepository $firstRepo, ComparableGitRepository $secondRepo)
    {
        $firstRepoLastReleaseDate = $firstRepo->getLastReleaseDate();
        $secondRepoLastReleaseDate = $secondRepo->getLastReleaseDate();

        if (!$firstRepoLastReleaseDate && !$secondRepoLastReleaseDate) {
            return array();
        }

        $noDateDiff = !$firstRepoLastReleaseDate || !$secondRepoLastReleaseDate;

        $releaseDateComparision = array();
        if ($noDateDiff) {
            if (strtotime($firstRepoLastReleaseDate)) {
                $releaseDateComparision[$firstRepo->getFullName()] =
                    Carbon::createFromFormat(GitRepositoryComparision::RELEASE_DATE_COMPARISION_FORMAT,
                        $firstRepoLastReleaseDate)
                        ->toDateString();

                $releaseDateComparision[GitRepositoryComparision::RELEASE_DATE_COMPARISION_NEWER_KEY] = $firstRepo->getFullName();
            } else {
                $releaseDateComparision[$secondRepo->getFullName()] =
                    Carbon::createFromFormat(GitRepositoryComparision::RELEASE_DATE_COMPARISION_FORMAT,
                        $secondRepoLastReleaseDate)
                        ->toDateString();

                $releaseDateComparision[GitRepositoryComparision::RELEASE_DATE_COMPARISION_NEWER_KEY] = $secondRepo->getFullName();
            }

            return $releaseDateComparision;
        }

        $firstRepoLastReleaseDate = Carbon::createFromFormat(GitRepositoryComparision::RELEASE_DATE_COMPARISION_FORMAT,
            $firstRepoLastReleaseDate);
        $secondRepoLastReleaseDate = Carbon::createFromFormat(GitRepositoryComparision::RELEASE_DATE_COMPARISION_FORMAT,
            $secondRepoLastReleaseDate);


        $daysDiff = $firstRepoLastReleaseDate->diffInDays($secondRepoLastReleaseDate, false);
        if ($daysDiff === 0) {
            $newer = GitRepositoryComparision::TIE_COMPARISION_KEY;
        } else {
            $newer = $firstRepoLastReleaseDate > $secondRepoLastReleaseDate
                ? self::FIRST_REPOSITORY_COMPARISION_KEY
                : self::SECOND_REPOSITORY_COMPARISION_KEY;
        }

        $releaseDateComparision[GitRepositoryComparision::RELEASE_DATE_COMPARISION_NEWER_KEY] = $newer;
        $releaseDateComparision[GitRepositoryComparision::RELEASE_DATE_COMPARISION_DIFF_KEY] = abs($daysDiff);
        $releaseDateComparision[self::FIRST_REPOSITORY_COMPARISION_KEY] = $firstRepoLastReleaseDate->toDateString();
        $releaseDateComparision[self::SECOND_REPOSITORY_COMPARISION_KEY] = $secondRepoLastReleaseDate->toDateString();

        return $releaseDateComparision;
    }
}