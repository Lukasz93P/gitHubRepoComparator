<?php

namespace GitHubRepoComparator\Exception\Validation;

use GitHubRepoComparator\Exception\ApiException;
use GitHubRepoComparator\Http\Status\HttpStatus;

class ValidationException extends ApiException
{
    /**
     * @var
     */
    private $validationErrors;

    /**
     * ValidationException constructor.
     * @param string $message
     * @param array $validationErrors
     */
    public function __construct($message, array $validationErrors)
    {
        parent::__construct($message, HttpStatus::HTTP_STATUS_UNPROCESSABLE_ENTITY);
        $this->validationErrors = $validationErrors;
    }

    /**
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
}