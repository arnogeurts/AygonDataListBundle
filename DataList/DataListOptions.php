<?php

namespace Aygon\DataListBundle\DataList;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DataListOptions extends \ArrayObject
{
    
    /**
     * Get the default options
     * 
     * @param OptionsResolverInterface $resolver
     */
    public static function getDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'filter_form_token'             => '_filter_form_token',
                'page_number_parameter'         => 'page',
                'results_per_page'              => 20,
                'results_per_page_form_field'   => 'results_per_page'
            ));
    }
    
    /**
     * Get a value from the options by key
     * 
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->offsetGet($key);
    }
}