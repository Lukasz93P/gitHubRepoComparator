<?php

namespace GitHubRepoComparator\Utils\DateUtils;

final class DateHelper
{
    private function __construct()
    {
    }

    /**
     * @param string $dateString
     * @return string
     */
    public static function trimDateString($dateString)
    {
        return substr($dateString, 0, 10);
    }
}