<?php

namespace Aygon\DataListBundle\DataList\ProviderFactory;

use Aygon\DataListBundle\DataList\Handler\HandlerInterface;

/**
 * @author Arno Geurts
 */
interface ProviderFactoryInterface
{
    /**
     * Create a provider for the given handler
     * 
     * @param HandlerInterface $handler
     * @return ProviderInterface
     */
    public function createProvider(HandlerInterface $handler);
    
    /**
     * Check if the provider factory supports the given handler
     * 
     * @param HandlerInterface $handler
     */
    public function supports(HandlerInterface $handler);
}