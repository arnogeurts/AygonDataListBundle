<?php

namespace Aygon\DataListBundle\DataList\FilterForm;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Aygon\DataListBundle\DataList\DataListOptions;
use Aygon\DataListBundle\DataList\FilterForm\DataPersister\AjaxSessionPersister;
use Aygon\DataListBundle\DataList\FilterForm\Model\FilterModel;
use Aygon\DataListBundle\DataList\FilterForm\Subscriber\FilterFormSubscriber;
use Aygon\DataListBundle\DataList\Provider\ProviderInterface;

class AjaxFilterFormFactory implements FilterFormFactoryInterface
{
    /**
     * Inject the container
     * 
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritdoc}
     */
    public function create(ProviderInterface $provider, DataListOptions $options)
    {
        $model = new FilterModel($options);
        $builder = $this->getFormFactory()->createBuilder('form', $model, array('csrf_protection' => false, 'required' => false));
        
        $builder->addEventSubscriber($this->getFilterFormSubscriber($options));
        $provider->buildFilterForm($builder);
        
        $form = $builder->getForm();
        $form->bind($this->getRequest());
        
        return $form;
    }
    
    /**
     * Get the symfony form factory from the container
     * 
     * @return FormFactory
     */
    protected function getFormFactory()
    {
        return $this->container->get('form.factory');
    }
    
    /**
     * Get the request from the container
     * 
     * @return Request
     */
    protected function getRequest()
    {
        return $this->container->get('request');
    }
    
    /**
     * Get the filter form data persistor
     * 
     * @return AjaxSessionPersistor
     */
    protected function getPersister()
    {
        return new AjaxSessionPersister($this->container->get('session'), $this->getRequest());
    }
    
    /**
     * Build the filter form subscriber, to handle the requested data
     * 
     * @return EventSubscriberInterface
     */
    protected function getFilterFormSubscriber(DataListOptions $options)
    {
        return new FilterFormSubscriber($options, $this->getFormFactory(), $this->getPersister(), $this->getRequest());
    }
}