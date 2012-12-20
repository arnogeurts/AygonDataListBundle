<?php

namespace Aygon\DataListBundle\Datalist\View\Paginator;

/**
 * @author Arno Geurts
 */
class ItemView
{
    /**
     * The page number for this item
     * @var int
     */
    private $pageNumber;
    
    /**
     * The current page number
     * @var int
     */
    private $currentPage;
    
    /**
     * Construct the item view
     * Inject the current page
     * 
     * @param int $currentPage
     */
    public function __construct($pageNumber, $currentPage)
    {
        $this->pageNumber = $pageNumber;
        $this->currentPage = $currentPage;
    }
    
    /**
     * Check if this page number is the current page 
     * 
     * @return boolean
     */
    public function isCurrent()
    {
        return $this->currentPage == $this->pageNumber;
    }
    
    /**
     * Get the page number for the previous page,
     * or the current page is this is the first page of the paginator
     * 
     * @return int
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }
}