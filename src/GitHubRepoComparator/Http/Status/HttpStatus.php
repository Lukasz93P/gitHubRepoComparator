<?php

namespace GitHubRepoComparator\Http\Status;

final class HttpStatus
{
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_UNPROCESSABLE_ENTITY = 422;
    const HTTP_STATUS_NOT_FOUND = 404;
    const HTTP_STATUS_INTERNAL_SERVER_ERROR = 500;

    private function __construct()
    {
    }
}