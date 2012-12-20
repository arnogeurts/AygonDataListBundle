<?php

namespace Aygon\DataListBundle\Datalist\View\Paginator;

/**
 * @author Arno Geurts
 */
class PreviousView
{
    
    /**
     * The current page number
     * @var int
     */
    private $currentPage;
    
    /**
     * Construct the next button view
     * Inject the current page
     * 
     * @param int $currentPage
     */
    public function __construct($currentPage)
    {
        $this->currentPage = $currentPage;
    }
    
    /**
     * Check if a previous page is available
     * 
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->currentPage > 1;
    }
    
    /**
     * Get the page number for the previous page,
     * or the current page is this is the first page of the paginator
     * 
     * @return int
     */
    public function getPageNumber()
    {
        return $this->isAvailable() ? $this->currentPage - 1 : 1;
    }
}