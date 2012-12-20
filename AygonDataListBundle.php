<?php

namespace Aygon\DataListBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Aygon\DataListBundle\DependencyInjection\Compiler\AddDataListProviderFactoryPass;


class AygonDataListBundle extends Bundle
{
    /**
     * Build the DI container
     *
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    
        $container->addCompilerPass(new AddDataListProviderFactoryPass());
    }
}
