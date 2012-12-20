<?php

namespace Aygon\DataListBundle\DataList\FilterForm\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Aygon\DataListBundle\DataList\DataListOptions;
use Aygon\DataListBundle\DataList\FilterForm\DataPersister\FilterFormDataPersisterInterface;
use Aygon\DataListBundle\DataList\FilterForm\DataTransformer\FixedValueTransformer;

class FilterFormSubscriber implements EventSubscriberInterface
{
    public function __construct(DataListOptions $options, FormFactory $factory, FilterFormDataPersisterInterface $persistor, Request$request)
    {
        $this->options = $options;
        $this->factory = $factory;
        $this->persistor = $persistor;
        $this->request = $request;
    }
    
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND => 'preBind'
        );
    }
    
    public function preSetData(DataEvent $event)
    {
        $form = $event->getForm();
        // filter form token
        $field = $this->factory->createNamedBuilder($this->options->get('filter_form_token'), 'hidden');
        $field->addViewTransformer(new FixedValueTransformer(1));
        $form->add($field->getForm());
        
        if ( ! $form->has($this->options->get('page_number_parameter'))) {
            $field = $this->factory->createNamedBuilder($this->options->get('page_number_parameter'), 'hidden');
            $field->addViewTransformer(new FixedValueTransformer(0));
            $form->add($field->getForm());
        }
        
        if ( ! $form->has($this->options->get('results_per_page_form_field'))) {
            $field = $this->factory->createNamedBuilder($this->options->get('results_per_page_form_field'), 'hidden');
            $field->addViewTransformer(new FixedValueTransformer(0));
            $form->add($field->getForm());
        }
        
    }

    public function preBind(DataEvent $event)
    {
        $data = $event->getData();
        
        $token = $this->options->get('filter_form_token');
        $pageParam = $this->options->get('page_number_parameter');
        $resPerPage = $this->options->get('results_per_page_form_field');
        
        if (! array_key_exists($token, $data)) {
            $data = $this->persistor->load();

            if($this->request->get($pageParam)) {
                $data[$pageParam] = $this->request->get($pageParam);
            }
        } else {
            unset($data[$token]);
        }
        
        if ( ! array_key_exists($pageParam, $data) || ! is_numeric($data[$pageParam]) || $data[$pageParam] < 1) {
            $data[$pageParam] = 1;
        }
        
        if ( ! array_key_exists($resPerPage, $data) || ! is_numeric($data[$resPerPage]) || $data[$resPerPage] < 1) {
            $data[$resPerPage] = $this->options->get('results_per_page');
        } 
        
        $this->persistor->save($data);
        $event->setData($data);
    }
}