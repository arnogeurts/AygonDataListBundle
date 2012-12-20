<?php

namespace Aygon\DataListBundle\Datalist\View\Paginator;

/**
 * @author Arno Geurts
 */
class NextView
{
    /**
     * The total amount of pages
     * @var int
     */
    private $pageAmount;
    
    /**
     * The current page number
     * @var int
     */
    private $currentPage;
    
    /**
     * Construct the next button view
     * Inject the amount of pages and the current page
     * 
     * @param int $pageAmount
     * @param int $currentPage
     */
    public function __construct($pageAmount, $currentPage)
    {
        $this->pageAmount = $pageAmount;
        $this->currentPage = $currentPage;
    }
    
    /**
     * Check if a next page is available
     * 
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->currentPage < $this->pageAmount;
    }
    
    /**
     * Get the page number for the next page,
     * or the current page is this is the last page of the paginator
     * 
     * @return int
     */
    public function getPageNumber()
    {
        return $this->isAvailable() ? $this->currentPage + 1 : $this->currentPage;
    }
}