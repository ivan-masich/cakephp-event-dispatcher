<?php

namespace event_dispatcher\DependencyInjection;

use \dependency_injection\DependencyInjection\BaseExtension;
use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \event_dispatcher\DependencyInjection\Compiler\RegisterKernelListenersPass;
use \Symfony\Component\Config\FileLocator;
use \Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use \dependency_injection\DependencyInjection\CompilerPassDataInterface;

/**
 * @author Masich Ivan <john@masich.com>
 */
class Extension extends BaseExtension implements CompilerPassDataInterface
{
    /**
     * @var array
     */
    private $compilerPassData;
    
    public function __construct()
    {
        $this->setCompilerPassData(
            array(
                new RegisterKernelListenersPass()
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../config'));

        $loader->load('services.xml');
    }

    /**
     * {@inheritDoc}
     */
    function getAlias()
    {
        return 'event_dispatcher';
    }

    /**
     * {@inheritDoc}
     */
    public function setCompilerPassData(array $objects)
    {
        $this->compilerPassData = $objects;
    }

    /**
     * {@inheritDoc}
     */
    public function getCompilerPassData()
    {
        return $this->compilerPassData;
    }
}
