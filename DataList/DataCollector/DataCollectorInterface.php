<?php

namespace Aygon\DataListBundle\DataList\DataCollector;

/**
 * @author Arno Geurts
 */
interface DataCollectorInterface extends \Countable, \Traversable
{
    /**
     * Set the maximum amount of resuls of data
     * 
     * @param int $maxResults
     */
    public function setMaxResults($maxResults);
    
    /**
     * Set the number of the first result of the data
     * 
     * @param int $firstResult
     */
    public function setFirstResult($firstResult);
}