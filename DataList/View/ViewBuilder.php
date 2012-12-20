<?php

namespace Aygon\DataListBundle\DataList\View;

use Aygon\DataListBundle\DataList\DataList;

/**
 * @author Arno Geurts
 */
class ViewBuilder
{
    /**
     * The data list to build view for
     * @var DataList
     */
    private $list;
    
    /**
     * Constructor of the view builder
     * Inject the data list to build view for
     * 
     * @param DataList $list
     */
    public function __construct(DataList $list)
    {
        $this->list = $list;
    }
    
    /**
     * Build the view for the injected data list
     * 
     * @return View
     */
    public function buildView()
    {
        $list = $this->buildListView();
        $form = $this->buildFormView();
        $paginator = $this->buildPaginatorView();
        
        return new View($form, $list, $paginator);
    }
    
    /**
     * Build the form view as part of the complete view
     * 
     * @return FormView
     */
    private function buildFormView()
    {
        return $this->list->getFilterForm()->createView();
    }
    
    /**
     * Build the list view as part of the complete view
     * 
     * @return ListView
     */
    private function buildListView()
    {
        return new ListView($this->list->getDataCollector());
    }
    
    /**
     * Build the paginator view as part of the complete view
     *
     * @return PaginatorView
     */
    private function buildPaginatorView()
    {
        $pageAmount = ceil($this->list->getDataCollector()->count() / $this->list->getFilterForm()->getData()->getResultsPerPage());
        $currentPage = $this->list->getFilterForm()->getData()->getCurrentPage();
        return new PaginatorView($pageAmount, $currentPage);
    }
}