<?php 

namespace Aygon\DataListBundle\DataList\FilterForm\DataPersister;

interface FilterFormDataPersisterInterface
{
    /**
     * Persist the current page number
     * 
     * @param int $page
     */
    public function save(array $filterData);
    
    /**
     * Load the current page number
     * 
     * @return int
     */
    public function load();
}