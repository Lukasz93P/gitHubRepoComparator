<?php

namespace GitHubRepoComparator\Actions\ComparableGitRepositoryAmplification;

use GitHubRepoComparator\ComparableGitRepositoryDataAmplifier\ComparableGitRepositoryDataAmplifier;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

class BasicAmplifyComparableGitRepositoryAction implements ActionAmplifyComparableGitRepository
{
    /**
     * @var ComparableGitRepositoryDataAmplifier
     */
    private $comparableGitRepositoryAmplifier;

    /**
     * BasicAmplifyComparableGitRepositoryAction constructor.
     * @param ComparableGitRepositoryDataAmplifier $comparableGitRepositoryAmplifier
     */
    public function __construct(ComparableGitRepositoryDataAmplifier $comparableGitRepositoryAmplifier)
    {
        $this->comparableGitRepositoryAmplifier = $comparableGitRepositoryAmplifier;
    }

    /**
     * @param ComparableGitRepository $repository
     * @return ComparableGitRepository
     * @throws \RuntimeException
     */
    public function execute(ComparableGitRepository $repository)
    {
        return $this->comparableGitRepositoryAmplifier->amplifyRepository($repository);
    }
}