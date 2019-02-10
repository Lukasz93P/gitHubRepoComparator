<?php

namespace GitHubRepoComparator\Exception\Validation;

use GitHubRepoComparator\Exception\ApiException;
use GitHubRepoComparator\Http\Status\HttpStatus;

class ValidationException extends ApiException
{
    const VALIDATION_FAILURE_MESSAGE = 'Validation failed';
    /**
     * @var
     */
    private $validationErrors;

    /**
     * ValidationException constructor.
     * @param array $validationErrors
     */
    public function __construct(array $validationErrors)
    {
        parent::__construct(self::VALIDATION_FAILURE_MESSAGE, HttpStatus::HTTP_STATUS_UNPROCESSABLE_ENTITY);
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