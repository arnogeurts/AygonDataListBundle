<?php

namespace Aygon\DataListBundle\DataList\FilterForm\Model;

use Aygon\DataListBundle\DataList\DataListOptions;

class FilterModel
{
    private $options;
    
    private $page_number;
    
    private $results_per_page;
    
    private $filters = array();
    
    public function __construct(DataListOptions $options)
    {
        $this->options = $options;
    }
    
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }
    
    public function set($key, $value)
    {
        switch ($key) {
            case $this->options->get('page_number_parameter'):
                $this->page_number = $value;
                break;
                
            case $this->options->get('results_per_page_form_field'):
                $this->results_per_page = $value;
                break;
        
            default:
                $this->filters[$key] = $value;
                break;
        }
    }
    
    public function __get($key)
    {
        return $this->get($key);
    }
    
    public function get($key)
    {
        switch ($key) {
            case $this->options->get('page_number_parameter'):
                return $this->getCurrentPage();
                break;
                
            case $this->options->get('results_per_page_form_field'):
                return $this->getResultsPerPage();
                break;
        
            default:
                return array_key_exists($key, $this->filters) ? $this->filters[$key] : null;
                break;
        }
    }
    
    public function getFilters()
    {
        return new Filters($this->filters);
    }
    
    public function getCurrentPage()
    {
        if (! is_numeric($this->page_number) || $this->page_number < 1) {
            return 1;
        }
        
        return $this->page_number;
    }
    
    public function getResultsPerPage()
    {
        if (! is_numeric($this->results_per_page) || $this->results_per_page < 1) {
            return 1;
        }
        
        return $this->results_per_page;
    }
}