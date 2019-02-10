<?php

namespace GitHubRepoComparator\Exception\DataNotFound;

use GitHubRepoComparator\Exception\ApiException;
use GitHubRepoComparator\Http\Status\HttpStatus;
use Throwable;

class RepositoryNotFoundException extends ApiException
{
    /**
     * RepositoryNotFoundException constructor.
     * @param string $repositoryAuthorName
     * @param string $repositoryName
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($repositoryAuthorName, $repositoryName, $code = HttpStatus::HTTP_STATUS_NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct('Repository ' . $repositoryName . ' by '
            . $repositoryAuthorName . ' not found', $code, $previous);
    }
}