<?php

namespace event_dispatcher\DependencyInjection;

use \dependency_injection\DependencyInjection\BaseExtension;
use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \event_dispatcher\DependencyInjection\Compiler\RegisterKernelListenersPass;
use \Symfony\Component\Config\FileLocator;
use \Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * @author Masich Ivan <john@masich.com>
 */
class Extension extends BaseExtension
{
    /**
     * {@inheritDoc}
     */
    function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../config'));

        $loader->load('services.xml');

        $container->addCompilerPass(new RegisterKernelListenersPass());
    }

    /**
     * {@inheritDoc}
     */
    function getAlias()
    {
        return 'event_dispatcher';
    }
}
