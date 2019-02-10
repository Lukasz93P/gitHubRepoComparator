<?php

namespace GitHubRepoComparator\Actions\RepositoryDataValidation;

use GitHubRepoComparator\Exception\Validation\ValidationException;
use GitHubRepoComparator\Validation\Validator;

class BasicValidateRepositoryAction implements ActionValidateRepositoryData
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * BasicValidateRepositoryAction constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return void
     * @throws ValidationException
     */
    public function execute(array $data)
    {
        $this->validator
            ->validate(array('authorName' => Validator::NOT_EMPTY_VALIDATION_RULE,
                'name' => Validator::NOT_EMPTY_VALIDATION_RULE), $data);
    }
}