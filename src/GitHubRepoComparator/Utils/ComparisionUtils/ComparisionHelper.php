<?php

namespace GitHubRepoComparator\Utils\ComparisionUtils;

final class ComparisionHelper
{
    const FIRST_PERCENTAGE_COMPARISION_VALUE = 'firstPercentage';
    const SECOND_PERCENTAGE_COMPARISION_VALUE = 'secondPercentage';

    const NEWER_DATE_COMPARISION_VALUE = 'newer';

    private function __construct()
    {
    }

    /**
     * @param int $firstValue
     * @param int $secondValue
     * @return array
     */
    public static function comparePercentageShares($firstValue, $secondValue)
    {
        if (($firstValue + $secondValue) == 0) {
            $firstValuePercentage = 0;
            $secondValuePercentage = 0;
        } else {
            $firstValuePercentage = (int)floor($firstValue / ($firstValue + $secondValue) * 100);
            $secondValuePercentage = 100 - $firstValuePercentage;
        }

        return array(self::FIRST_PERCENTAGE_COMPARISION_VALUE => $firstValuePercentage,
            self::SECOND_PERCENTAGE_COMPARISION_VALUE => $secondValuePercentage);
    }
}