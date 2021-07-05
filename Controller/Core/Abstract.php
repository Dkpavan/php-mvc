<?php 
Ccc::loadFile("Model/Core/Adapter.php");
Ccc::loadFile("Model/Core/Request.php");
Ccc::loadFile("Model/Core/Message.php");
Ccc::loadFile("Model/Core/Layout.php");
Ccc::loadFile("Model/Core/Url.php");


class Controller_Core_Abstract 
{
    protected $adapter;
    protected $request;
    protected $session;
    protected $massage;
    protected $layout;
    protected $url;

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        if (!$this->adapter) {
            $this->adapter = new Adapter();
        }
        return $this->adapter;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function getRequest()
    {
        if(!$this->request){
            $this->request = new Model_Core_Request();
        }
        return $this->request;
    }

    public function setMessage($massage)
    {
        $this->massage = $massage;
        return $this;
    }

    public function getMessage()
    {
        if(!$this->massage){
            $this->massage = new Model_Core_Message();
        }
        return $this->massage;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function getLayout()
    {
        if(!$this->layout){
            $this->layout = new Model_Core_Layout();
        }
        return $this->layout;
    }

    public function renderLayout()
    {
        return $this->getLayout()->renderLayout();
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getUrl()
    {
        if(!$this->url){
            $this->url = new Model_Core_Url();
        }
        return $this->url;
    }

    public function redirect($action , $controller = null)
    {
        if(!$controller){
            $controller = $this->getRequest()->getControllerName();
        }
        header("location:".$this->getUrl()->Url("$action","$controller",[],true)."");
        exit;
    }

}
