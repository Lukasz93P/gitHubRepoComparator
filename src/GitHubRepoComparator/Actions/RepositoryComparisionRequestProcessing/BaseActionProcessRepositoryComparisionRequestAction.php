<?php

namespace GitHubRepoComparator\Actions\RepositoryComparisionRequestProcessing;

use GitHubRepoComparator\Actions\ComparableGitRepositoryAmplification\ActionAmplifyComparableGitRepository;
use GitHubRepoComparator\Actions\RepositoryComparision\ActionCompareRepositories;
use GitHubRepoComparator\Actions\RepositoryCreation\ActionCreateComparableRepository;
use GitHubRepoComparator\Comparision\GitRepositoryComparision;

class BaseActionProcessRepositoryComparisionRequestAction implements ActionProcessRepositoryComparisionRequest
{
    /**
     * @var ActionCreateComparableRepository
     */
    private $actionCreateRepository;

    /**
     * @var ActionAmplifyComparableGitRepository
     */
    private $actionAmplifyRepository;

    /**
     * @var ActionCompareRepositories
     */
    private $actionCompareRepositories;

    /**
     * BaseActionProcessRepositoryComparisionRequestAction constructor.
     * @param ActionCreateComparableRepository $actionCreateRepository
     * @param ActionAmplifyComparableGitRepository $actionAmplifyRepository
     * @param ActionCompareRepositories $actionCompareRepositories
     */
    public function __construct(ActionCreateComparableRepository $actionCreateRepository,
                                ActionAmplifyComparableGitRepository $actionAmplifyRepository,
                                ActionCompareRepositories $actionCompareRepositories)
    {
        $this->actionCreateRepository = $actionCreateRepository;
        $this->actionAmplifyRepository = $actionAmplifyRepository;
        $this->actionCompareRepositories = $actionCompareRepositories;
    }

    /**
     * @param string $firstRepoAuthorName
     * @param string $firstRepoName
     * @param string $secondRepoAuthorName
     * @param string $secondRepoName
     * @return GitRepositoryComparision
     * @throws \RuntimeException
     */
    public function execute($firstRepoAuthorName, $firstRepoName, $secondRepoAuthorName, $secondRepoName)
    {
        $firstRepository = $this->actionCreateRepository->execute(array('authorName' => $firstRepoAuthorName,
            'name' => $firstRepoName));
        $secondRepository = $this->actionCreateRepository->execute(array('authorName' => $secondRepoAuthorName,
            'name' => $secondRepoName));

        return $this->actionCompareRepositories->execute($this->actionAmplifyRepository->execute($firstRepository),
            $this->actionAmplifyRepository->execute($secondRepository));
    }
}