<?php

namespace Aygon\DataListBundle\Datalist\View;

use Symfony\Component\Form\FormView;

/**
 * @author Arno Geurts
 */
class View
{
    /**
     * The filter form view
     * @var FormView
     */
    private $form;
    
    /**
     * The data list view
     * @var ListView
     */
    private $list;
    
    /** 
     * The paginator view
     * @var PaginatorView
     */
    private $paginator;
    
    /**
     * Constructor of the data list view
     * Inject the form view, data list view and paginator view
     * 
     * @param FormView $form
     * @param ListView $list
     * @param PaginatorView $paginator
     */
    public function __construct(FormView $form, ListView $list, PaginatorView $paginator)
    {
        $this->form = $form;
        $this->list = $list;
        $this->paginator = $paginator;
    }
    
    /**
     * Get the form view
     * 
     * @return FormView
     */
    public function getForm()
    {
        return $this->form;
    }
    
    /**
     * Get the list view
     * 
     * @return DataList
     */
    public function getList()
    {
        return $this->list;
    }
    
    /**
     * Get the paginator view
     * 
     * @return Paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }
}