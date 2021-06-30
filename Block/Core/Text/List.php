<?php 
Ccc::loadFile("Block/Core/Template.php");

class Block_Core_Text_List extends Block_Core_Template{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("View/core/text/list.phtml");
    }

}