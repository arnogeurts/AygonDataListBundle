<?php

namespace Aygon\DataListBundle\DataList\Provider;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Aygon\DataListBundle\DataList\DataCollector\EntityCollector;
use Aygon\DataListBundle\DataList\FilterForm\Model\Filters;
use Aygon\DataListBundle\DataList\Handler\EntityHandler;

/**
 * @author Arno Geurts
 */
class EntityProvider implements ProviderInterface
{
    /**
     * The entity handler
     * @var EntityHandler
     */
    private $handler;
    
    /**
     * The Doctrine registry
     * @var Registry
     */
    private $doctrine;
    
    /**
     * The constructor of the entity provider
     * Inject the entity handler and the doctrine registry
     * 
     * @param EntityHandler $handler
     * @param Registry $doctrine
     */
    public function __construct(EntityHandler $handler, Registry $doctrine)
    {
        $this->handler = $handler;
        $this->doctrine = $doctrine;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildFilterForm(FormBuilderInterface $builder)
    {
        $this->handler->buildFilterForm($builder);
    }

    /**
     * {@inheritdoc}
     */
    public function buildDataCollector(Filters $filters)
    {
        $em = $this->doctrine->getEntityManager($this->handler->getEntityManager());
        $queryBuilder = $em->createQueryBuilder();
        $this->handler->buildQuery($queryBuilder, $filters);
        
        return new EntityCollector($queryBuilder);
    }
    
    public function getDefaultOptions(OptionsResolverInterface $resolver)
    {
    }
}