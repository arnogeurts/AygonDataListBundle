<?php

namespace Aygon\DataListBundle\DataList\DataCollector;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @author Arno Geurts
 */
class EntityCollector extends Paginator implements DataCollectorInterface
{
    /**
     * {@inheritdoc}
     */
    public function setMaxResults($maxResults)
    {
        $this->getQuery()->setMaxResults($maxResults);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFirstResult($firstResult)
    {
        $this->getQuery()->setFirstResult($firstResult);
    }
}