<?php

namespace Juceveju\FlowchartBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class JucevejuFlowchartExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        //$configuration = new Configuration();
        //$config = $this->processConfiguration($configuration, $configs);
        // get parameters from app/config.yml: http://gitnacho.github.com/symfony-docs-es/cookbook/bundles/extension.html
        $config = array();
        foreach ($configs as $subConfig) {
            $config = array_merge($config, $subConfig);
        }  

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if (!isset($config['jsplumb_path'])) {
            throw new \InvalidArgumentException('The "jsplumb_path" parameter must be set in your config file');
        }

        $container->setParameter('juceveju_flowchart.jsplumb_path', $config['jsplumb_path']);
    }
}
