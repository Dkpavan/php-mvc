<?php 
Ccc::loadFile("Block/Core/Text/List.php");

class Block_Pages_Html_Content extends Block_Core_Text_List{

    public function __construct()
    {
        parent::__construct();
        // $this->setTemplate("View/Pages/html/content.phtml");

    }

    public function addChild($child,$key)
    {
        $this->setChild($child,$key);
    }

    
}