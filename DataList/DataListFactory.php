<?php

namespace Aygon\DataListBundle\DataList;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Aygon\DataListBundle\DataList\Handler\HandlerInterface;
use Aygon\DataListBundle\DataList\Provider\ProviderInterface;
use Aygon\DataListBundle\DataList\ProviderFactory\ProviderFactoryInterface;
use Aygon\DataListBundle\DataList\FilterForm\FilterFormFactoryInterface;

/**
 * @author Arno Geurts
 */
class DataListFactory
{
    /**
     * The filter form factory
     * @var FilterFormFactoryInterface
     */
    private $formFactory;
    
    /**
     * The stack of data list provider factories
     * @var array
     */
    private $providerFactories = array();
    
    /**
     * Construct the data list factory
     * Inject the Symfony2 service container
     * 
     * @param ContainerInterface $container
     */
    public function __construct(FilterFormFactoryInterface$formFactory)
    {
        $this->formFactory = $formFactory;
    }
    
    /**
     * Add a provider factory to the stack
     * 
     * @param ProviderFactoryInterface $providerFactory
     */
    public function addProviderFactory(ProviderFactoryInterface $providerFactory)
    {
        $this->providerFactories[] = $providerFactory;
    }
    
    /**
     * Create a data list for the given handler
     * 
     * @param HandlerInterface $handler
     * @return DataList
     */
    public function create(HandlerInterface $handler, array $options = array()) 
    {
        $list = new DataList($this->getProvider($handler), $this->formFactory);
        $list->setOptions($options);
        
        return $list;
    }
    
    /**
     * Create a provider for the handler using one of the provider factories
     * 
     * @param HandlerInterface $handler
     */
    private function getProvider(HandlerInterface $handler)
    {
        foreach ($this->providerFactories as $factory) {
            if ($factory->supports($handler)) {
                return $factory->createProvider($handler);
            }
        }
        
        throw new \Exception(sprintf('No data list provider factory found for handler class %s', get_class($handler)));
    }
}