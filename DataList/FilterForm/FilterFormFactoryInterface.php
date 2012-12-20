<?php

namespace Aygon\DataListBundle\DataList\FilterForm;

use Aygon\DataListBundle\DataList\DataListOptions;
use Aygon\DataListBundle\DataList\FormFilter\AjaxSessionPersistor;
use Aygon\DataListBundle\DataList\Provider\ProviderInterface;

interface FilterFormFactoryInterface
{
    /**
     * Create the filter form
     * 
     * @param ProviderInterface $provider
     * @param DataListOptions $options
     */
    public function create(ProviderInterface $provider, DataListOptions $options);
} 