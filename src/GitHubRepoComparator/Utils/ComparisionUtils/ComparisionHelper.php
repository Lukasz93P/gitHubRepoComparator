<?php

namespace GitHubRepoComparator\Utils\ComparisionUtils;

use Carbon\Carbon;

final class ComparisionHelper
{
    const FIRST_PERCENTAGE_COMPARISION_VALUE = 'firstPercentage';
    const SECOND_PERCENTAGE_COMPARISION_VALUE = 'secondPercentage';

    const NEWER_DATE_COMPARISION_VALUE = 'newer';
    const DIFF_DATE_COMPARISION_VALUE = 'diff';
    const NEWER_DATE_COMPARISION_TIE = 'tie';

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
        $firstValuePercentage = floor($firstValue / ($firstValue + $secondValue) * 100);
        $secondValuePercentage = 100 - $firstValuePercentage;

        return array(self::FIRST_PERCENTAGE_COMPARISION_VALUE => $firstValuePercentage,
            self::SECOND_PERCENTAGE_COMPARISION_VALUE => $secondValuePercentage);
    }

    /**
     * @param string $firstDate
     * @param string $secondDate
     * @return array
     */
    public static function compareDates($firstDate, $secondDate)
    {
        $firstCarbon = Carbon::parse($firstDate);
        $secondCarbon = Carbon::parse($secondDate);

        $daysDiff = $firstCarbon->diffInDays($secondCarbon, false);
        $newerDate = $daysDiff === 0 ? self::NEWER_DATE_COMPARISION_TIE : $daysDiff ? $secondDate : $firstDate;

        return array(self::NEWER_DATE_COMPARISION_VALUE => $newerDate, self::DIFF_DATE_COMPARISION_VALUE => $daysDiff);
    }
}