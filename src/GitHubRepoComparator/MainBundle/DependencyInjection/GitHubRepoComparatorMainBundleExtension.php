<?php

namespace GitHubRepoComparator\MainBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

/**
 * Class GitHubRepoComparatorMainBundleExtension
 * @package GitHubRepoComparator\MainBundle\DependencyInjection
 */
final class GitHubRepoComparatorMainBundleExtension extends Extension
{
    const ALIAS = 'github_repo_comparator';

    const SERVICES_CONFIG_FILENAME = 'services';
    const SERVICES_CONFIG_FILE_EXTENSION = '.yaml';

    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container,
            new FileLocator(__DIR__ . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'config'));

        $loader->load(self::SERVICES_CONFIG_FILENAME . self::SERVICES_CONFIG_FILE_EXTENSION);
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return self::ALIAS;
    }
}
