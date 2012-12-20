<?php

namespace Aygon\DataListBundle\DataList\Provider;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Aygon\DataListBundle\DataList\FilterForm\Model\Filters;

/**
 * @author Arno Geurts
 */
interface ProviderInterface
{
    public function buildFilterForm(FormBuilderInterface $builder);
    
    public function buildDataCollector(Filters $filters);
    
    public function getDefaultOptions(OptionsResolverInterface $resolver);
}