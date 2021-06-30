<?php

Ccc::loadFile("Model/Core/Session.php");

class Model_Core_Message
{
    protected $session = null;

    public function setSession()
    {
        $this->session = new Model_Core_Session();
        return $this;
    }
    
    public function getSession()
    {
        if(!$this->session){
            $this->setSession();
        }
        return $this->session;
    }

    // public function setSuccess($massage)
    // {
    //     $this->success = $massage;
    //     return $this;  
    // }

    public function setSuccess($massage)
    {
        $this->getSession()->success = $massage;
        return $this->getSession()->success;  
    }

    public function getSuccess()
    {
        return $this->getSession()->success;
    }
    
    public function clearSuccess()
    {
        unset($this->getSession()->success);
        return $this;
    }

    public function setFailure($failure)
    {
        $this->getSession()->failure = $massage;
        return $this->getSession()->failure;  
    }

    public function getFailure()
    {
        return $this->getSession()->failure;  
    }

    public function clearFailure()
    {
        unset($this->getSession()->failure);
        return $this;
    }

    public function setNotice($notice)
    {
        $this->getSession()->notice = $massage;
        return $this->getSession()->notice; 
    }

    public function getNotice()
    {
        return $this->getSession()->notice; 
    }

    public function clearNotice()
    {
        unset($this->getSession()->notice);
        return $this;
    }

}


