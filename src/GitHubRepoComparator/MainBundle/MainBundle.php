<?php

namespace GitHubRepoComparator\MainBundle;

use GitHubRepoComparator\MainBundle\DependencyInjection\GitHubRepoComparatorMainBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class GitHubRepoComparatorMainBundle
 * @package GitHubRepoComparator\MainBundle
 */
final class MainBundle extends Bundle
{
    /**
     * @return GitHubRepoComparatorMainBundleExtension|null|\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getContainerExtension()
    {
        return new GitHubRepoComparatorMainBundleExtension();
    }
}
