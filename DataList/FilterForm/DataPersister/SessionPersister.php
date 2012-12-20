<?php

namespace Aygon\DataListBundle\DataList\FilterForm\DataPersister;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @author Arno Geurts
 */
abstract class SessionPersister implements FilterFormDataPersisterInterface
{
    /**
     * The session
     * @var Session
     */
    private $session;
    
    /**
     *
     * @param ContainerInterface $container
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
       
    /**
     * {@inheritdoc}
     */
    public function save(array $filterData)
    {
        $this->setSession($filterData);
    }
    
    /**
     * {@inheritdoc}
     */
    public function load()
    {
        return $this->getSession();
    }

    
    /**
     * Get the array of variables stored in the session
     * 
     * @return array
     */
    private function getSession()
    {
        return $this->session->get($this->getSessionKey(), array());
    }
    
    /**
     * Store an array of variables in the session
     * 
     * @param array $session
     */
    private function setSession(array $session)
    {
        $this->session->set($this->getSessionKey(), $session);
    }
    
    /**
     * Get the session key
     * 
     * @return string
     */
    private function getSessionKey()
    {
        return '_paginator_session_key';
    }
}