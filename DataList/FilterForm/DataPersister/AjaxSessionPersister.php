<?php

namespace Aygon\DataListBundle\DataList\FilterForm\DataPersister;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @author Arno Geurts
 */
class AjaxSessionPersister extends SessionPersister
{
    /**
     * The Request object
     * @var Request
     */
    private $request;
    
    /**
     *
     * @param ContainerInterface $container
     */
    public function __construct(Session $session, Request $request)
    {
        $this->request = $request;
        parent::__construct($session);
    }
    
    /**
     * Check if the persistor should load variables
     * 
     * @return boolean
     */
    public function load()
    {
        if ( ! $this->request->isXmlHttpRequest()) {
            return array();
        }
        
        return parent::load();
    }
}