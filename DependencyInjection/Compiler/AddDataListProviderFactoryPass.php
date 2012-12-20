<?php

namespace Aygon\DataListBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds tagged satis.module services to the module manager service
 */
class AddDataListProviderFactoryPass implements CompilerPassInterface
{
    /**
     * Adds tagged data_list_provider_factory service to the data list factory
     * 
     * @param ContainerBuilder $container
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('data_list_factory')) {
            return;
        }
 
        $definition = $container->getDefinition('data_list_factory');

        foreach ($container->findTaggedServiceIds('data_list_provider_factory') as $id => $attributes) {
            $definition->addMethodCall('addProviderFactory', array(new Reference($id)));
        }
    }
}
