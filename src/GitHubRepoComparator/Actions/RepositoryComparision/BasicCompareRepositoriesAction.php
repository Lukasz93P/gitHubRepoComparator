<?php

namespace GitHubRepoComparator\Actions\RepositoryComparision;

use GitHubRepoComparator\Comparision\Comparator\GitRepositoryComparator;
use GitHubRepoComparator\Comparision\GitRepositoryComparision;
use GitHubRepoComparator\GitRepository\ComparableRepository\ComparableGitRepository;

class BasicCompareRepositoriesAction implements ActionCompareRepositories
{
    /**
     * @var GitRepositoryComparator
     */
    private $comparator;

    /**
     * BasicCompareRepositoriesAction constructor.
     * @param GitRepositoryComparator $comparator
     */
    public function __construct(GitRepositoryComparator $comparator)
    {
        $this->comparator = $comparator;
    }

    /**
     * @param ComparableGitRepository $firstRepository
     * @param ComparableGitRepository $secondRepository
     * @return GitRepositoryComparision
     */
    public function execute(ComparableGitRepository $firstRepository, ComparableGitRepository $secondRepository)
    {
        return $this->comparator->compare($firstRepository, $secondRepository);
    }
}