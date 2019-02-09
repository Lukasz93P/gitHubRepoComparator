<?php

namespace GitHubRepoComparator\Actions\RepositoryComparisionRequestProcessing;

use GitHubRepoComparator\Comparision\GitRepositoryComparision;

interface ActionProcessRepositoryComparisionRequest
{
    /**
     * @param string $firstRepoAuthorName
     * @param string $firstRepoName
     * @param string $secondRepoAuthorName
     * @param string $secondRepoName
     * @return GitRepositoryComparision
     * @throws \RuntimeException
     */
    public function execute($firstRepoAuthorName, $firstRepoName, $secondRepoAuthorName, $secondRepoName);
}