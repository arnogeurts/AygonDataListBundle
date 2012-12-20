<?php

namespace Aygon\DataListBundle\DataList\Handler;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\QueryBuilder;
use Aygon\DataListBundle\DataList\FilterForm\Model\Filters;

/**
 * @author Arno Geurts
 */
abstract class EntityHandler implements HandlerInterface
{
    /**
     * Get the entity manager name
     * 
     * @return string
     */
    public function getEntityManager()
    {
        return 'default';
    }
    
    /**
     * Build the filter form
     * 
     * @param FormBuilderInterface $factory
     */
    public function buildFilterForm(FormBuilderInterface $factory)
    { 
    }
    
    /**
     * Build the query for selecting the list items
     * 
     * @param QueryBuilder $builder
     * @param array $criteria
     */
    abstract public function buildQuery(QueryBuilder $builder, Filters $filters);
}