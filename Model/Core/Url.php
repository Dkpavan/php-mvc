<?php 
Ccc::loadFile('Model/Core/Request.php');

class Model_Core_Url
{
	
	protected $request = null;

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

	public function Url($action = null, $controller = null, $params = [] , $reset = false)
	{
		$url = $this->getRequest()->getParams();

		if($reset == true){
			$url = [];
			$params = [];
		}

		if($action == null){
			$action = $this->getRequest()->getParams('a');
		}

		if($controller == null){
			$controller = $this->getRequest()->getParams('c');
		}

		$url['c'] = $controller;
		$url['a'] = $action;

		
		$url = array_merge($url,$params);
		$urlQuery = http_build_query($url);
		unset($finalUrl);
		return "http://localhost/all/mywork/Project/index.php?{$urlQuery}";

	}

	public function baseUrl($url = null)
	{
		$finalUrl = "http://localhost/all/mywork/Project/";

		if($url){
			$finalUrl .= $url;
		}
		return $finalUrl;
	}

}
