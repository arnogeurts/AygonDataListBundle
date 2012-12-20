<?php

namespace Aygon\DataListBundle\DataList\View;

/**
 * @author Arno Geurts
 */
class ListView
{
    /**
     * The list items
     * @var array
     */
    private $items;
    
    /**
     * Construct the list view
     * Inject the list items
     * 
     * @param mixed $items
     */
    public function __construct($items)
    {
        if ( ! is_array($items) && ! $items instanceof \Traversable) {
            throw new \Exception('The items in the list view should be an array or traversable object');
        }
        
        $this->items = $items;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->items;
    }
}