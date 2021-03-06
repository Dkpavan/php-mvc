<?php
 ob_start();
class Model_Core_Session  
{
    protected $nameSpace = 'Core';

    public function __construct()
    {
        $this->sessionStart();
        $this->setNameSpace('Core');
    }

    public function setNameSpace($nameSpace)
    {
        $this->nameSpace = $nameSpace;
        return $this;
    }

    public function resetNameSpace()
    {
        $_SESSION[$this->getNameSpace()] = [];
        return $this;
    }

    public function getNameSpace()
    {
        return $this->nameSpace;
    }

    public function sessionStart()
    {
       
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        return $this;
    }

    public function sessionDestroy()
    {
        session_destroy();
        return $this;
    }

    public function __set($key, $value)
    {
        $_SESSION[$this->getNameSpace()][$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if($_SESSION){
            if(array_key_exists($key,$_SESSION[$this->getNameSpace()])){
                return $_SESSION[$this->getNameSpace()][$key];
            }
        }
        return false;
    }

    public function __unset($key)
    {
        if(array_key_exists($key,$_SESSION[$this->getNameSpace()])){
           unset($_SESSION[$this->getNameSpace()][$key]);
        }
        return $this;
    }

    public function getId()
    {
        return session_id();
    }

    public function regenerateId(){
        return session_regenerate_id();
    }


}

ob_flush();