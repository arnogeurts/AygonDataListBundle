<?php

namespace Aygon\DataListBundle\DataList;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Aygon\DataListBundle\DataList\DataCollector\NullCollector;
use Aygon\DataListBundle\DataList\Provider\ProviderInterface;
use Aygon\DataListBundle\DataList\FilterForm\FilterFormFactoryInterface;
use Aygon\DataListBundle\DataList\View\ViewBuilder;

/**
 * @author Arno Geurts
 */
class DataList
{
    /**
     * The data list provider
     * @var ProviderInterface
     */
    private $provider;
    
    /**
     * The filter form factory
     * @var FilterFormFactoryInterface
     */
    private $formFactory;
    
    /**
     * The filter form
     * @var Form
     */
    private $form;
    
    /**
     * The data collector
     * @var DataCollector
     */
    private $datacollector;
    
    /**
     * The options parsed from the provider
     * @var DataListOptions
     */
    private $options;
    
    /**
     * Construct the data list
     * Inject the data list provider and the form factory
     * 
     * @param ProviderInterface $provider
     * @param FormFactory $formFactory
     */
    public function __construct(ProviderInterface $provider, FilterFormFactoryInterface $formFactory)
    {
        $this->provider = $provider;
        $this->formFactory = $formFactory;
    }
    
    /**
     * Get the filter form
     * 
     * @return Form
     */
    public function getFilterForm()
    {
        if ($this->form === null) {
            $this->form = $this->formFactory->create($this->provider, $this->getOptions());
        }
        
        return $this->form;
    }
                
    /**
     * Get the data collector 
     * 
     * @return DataCollectorInterface
     */
    public function getDataCollector()
    {
        if ($this->datacollector === null) {
            if ($this->getFilterForm()->isValid()) {
                $filters = $this->getFilterForm()->getData()->getFilters();
                $this->datacollector = $this->provider->buildDataCollector($filters);
            } else {
                // if filter form is invalid -> don't load any data
                $this->datacollector = new NullCollector();
            }
            
            $first = $this->getFilterForm()->getData()->getResultsPerPage() * ($this->getFilterForm()->getData()->getCurrentPage() - 1);
            $this->datacollector->setMaxResults($this->getFilterForm()->getData()->getResultsPerPage());
            $this->datacollector->setFirstResult($first);
        }
        
        return $this->datacollector;
    }
    
    
    public function getOptions()
    {
        if ($this->options === null) {
            $this->setOptions();
        }
        
        return $this->options;
    }
    
    /**
     * Get the data list options
     * 
     * @return DataListOptions
     */
    public function setOptions(array $options = array())
    {
        $resolver = new OptionsResolver();
        DataListOptions::getDefaultOptions($resolver);
        $this->provider->getDefaultOptions($resolver);
        $this->options = new DataListOptions($resolver->resolve($options));
    }
    
    /**
     * Create the view for the data list
     * 
     * @return View
     */
    public function createView()
    {
        $builder = new ViewBuilder($this);
        return $builder->buildView();
    }
    
    /**
     * Reset filter data
     */
    public function reset()
    {
        $this->getFilterForm()->getData()->reset();
    }
}