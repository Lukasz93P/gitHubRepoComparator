<?php

namespace GitHubRepoComparator\Exception\DataNotFound;

use GitHubRepoComparator\Exception\ApiException;
use GitHubRepoComparator\Http\Status\HttpStatus;
use Throwable;

class RepositoryNotFoundException extends ApiException
{
    /**
     * RepositoryNotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = HttpStatus::HTTP_STATUS_NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}