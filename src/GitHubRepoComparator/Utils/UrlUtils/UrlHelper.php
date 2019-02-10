<?php

namespace GitHubRepoComparator\Utils\UrlUtils;

final class UrlHelper
{
    private function __construct()
    {
    }

    /**
     * @param string $url
     * @return string
     */
    public static function encodeUrl($url)
    {
        return str_replace(array('%2F', '%3A'), array('/', ':'), rawurlencode($url));
    }
}