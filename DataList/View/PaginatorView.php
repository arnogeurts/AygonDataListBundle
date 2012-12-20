<?php

namespace Aygon\DataListBundle\Datalist\View;

use Aygon\DataListBundle\DataList\View\Paginator\ItemView;
use Aygon\DataListBundle\DataList\View\Paginator\NextView;
use Aygon\DataListBundle\DataList\View\Paginator\PreviousView;

/**
 * @author Arno Geurts
 */
class PaginatorView
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
     * Construct the paginator view
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
     * Get the previous page button
     * 
     * @return Previous
     */
    public function getPrevious() 
    {
        return new PreviousView($this->currentPage);
    }
    
    /**
     * Get the next page button
     * 
     * @return Next
     */
    public function getNext()
    {
        return new NextView($this->pageAmount, $this->currentPage);
    }
    
    /**
     * Get a list of page numbers with a given length
     * 
     * @return array
     */
    public function getItems($length = 5)
    {
        $first = $this->currentPage - floor(($length - 1)/2);
        $last = $this->currentPage + ceil(($length - 1)/2);
        
        if ($first < 1) {
            $first = 1;
            $last = $length >= $this->pageAmount ?  $this->pageAmount : $length;
        } elseif ($last > $this->pageAmount) {
            $last = $this->pageAmount;
            $first = $this->pageAmount - ($length - 1) >= 1 ? $this->pageAmount - ($length - 1) : 1;
        }
        
        $items = array();
        for ($i = $first; $i <= $last; $i++) {
            $items[] = new ItemView($i, $this->currentPage);
        }
        
        return $items;
    }
}