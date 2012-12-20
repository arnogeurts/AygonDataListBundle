<?php

namespace Aygon\DataListBundle\DataList\DataCollector;

/**
 * @author Arno Geurts
 */
class NullCollector implements \IteratorAggregate, DataCollectorInterface
{   
    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator(array());
    }
    
    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return 0;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setMaxResults($maxResults)
    {
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFirstResult($firstResult)
    {
    }
}