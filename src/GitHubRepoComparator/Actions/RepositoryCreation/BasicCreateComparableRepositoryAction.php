<?php

namespace GitHubRepoComparator\Actions\RepositoryCreation;

use GitHubRepoComparator\Actions\RepositoryDataValidation\ActionValidateRepositoryData;
use GitHubRepoComparator\Exception\Validation\ValidationException;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;
use GitHubRepoComparator\GitRepository\Factory\GitRepositoryFactory;

class BasicCreateComparableRepositoryAction implements ActionCreateComparableRepository
{
    /**
     * @var GitRepositoryFactory
     */
    private $repositoryFactory;

    /**
     * @var ActionValidateRepositoryData
     */
    private $actionValidateRepositoryData;

    /**
     * BasicCreateComparableRepositoryAction constructor.
     * @param GitRepositoryFactory $repositoryFactory
     * @param ActionValidateRepositoryData $actionValidateRepositoryData
     */
    public function __construct(GitRepositoryFactory $repositoryFactory, ActionValidateRepositoryData $actionValidateRepositoryData)
    {
        $this->repositoryFactory = $repositoryFactory;
        $this->actionValidateRepositoryData = $actionValidateRepositoryData;
    }

    /**
     * @param array $data
     * @return ComparableGitRepository
     * @throws ValidationException
     */
    public function execute(array $data)
    {
        $this->actionValidateRepositoryData->execute($data);
        return $this->repositoryFactory->makeComparableGitRepository($data['authorName'], $data['name']);
    }
}