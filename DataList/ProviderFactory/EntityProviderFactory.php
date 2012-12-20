<?php

namespace Aygon\DataListBundle\DataList\ProviderFactory;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Aygon\DataListBundle\DataList\Handler\EntityHandler;
use Aygon\DataListBundle\DataList\Handler\HandlerInterface;
use Aygon\DataListBundle\DataList\Provider\EntityProvider;

/**
 * @author Arno Geurts
 */
class EntityProviderFactory implements ProviderFactoryInterface
{
    /**
     * The Doctrine registry
     * @var Registry
     */
    private $doctrine;
    
    /**
     * Constructor
     * Inject the Doctrine registry
     * 
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    /**
     * Create a provider for the given handler
     * 
     * @param HandlerInterface $handler
     * @return ProviderInterface
     */
    public function createProvider(HandlerInterface $handler)
    {
        if ( ! $this->supports($handler)) {
            throw new \Exception(sprintf('Handler of class %s is not supported by the entity provider', get_class($handler)));
        }
        
        return new EntityProvider($handler, $this->doctrine);
    }
    
    /**
     * {@inheritdoc}
     */
    public function supports(HandlerInterface $handler)
    {
        return $handler instanceof EntityHandler;
    }
}