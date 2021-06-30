<?php 
Ccc::loadFile("Block/Core/Text/List.php");
Ccc::loadFile('Model/Core/Message.php');

class Block_Pages_Html_Message extends Block_Core_Text_List{

    public function __construct()
    {
        $this->setTemplate("View/Pages/html/message.phtml");
    }
    
    public function setMessage($message = null){
        if(!$message){
            $message =  new Model_Core_Message();   
        }
        $this->message = $message;
		return $this;
	}
	public function getMessage(){
		if(!$this->message){
			$this->setMessage();
		}
		return $this->message;
	}

}