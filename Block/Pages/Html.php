<?php 
Ccc::loadFile("Block/Core/Template.php");
Ccc::loadFile("Block/Pages/Html/Header.php");
Ccc::loadFile("Block/Pages/Html/Footer.php");
Ccc::loadFile("Block/Pages/Html/Content.php");
Ccc::loadFile("Block/Pages/Html/Head.php");
Ccc::loadFile("Block/Pages/Html/Message.php");

class Block_Pages_Html extends Block_Core_Template{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("View/Pages/html.phtml");
       
    }

    public function prepareChildren()
    {
        $this->setChild($this->getLayout()->createBlock("Block_Pages_Html_Header"),"header");
        $this->setChild($this->getLayout()->createBlock("Block_Pages_Html_Footer"),"footer");
        $this->setChild($this->getLayout()->createBlock("Block_Pages_Html_Content"),"content");
        $this->setChild($this->getLayout()->createBlock("Block_Pages_Html_Head"),"head");
        $this->setChild($this->getLayout()->createBlock("Block_Pages_Html_Message"),"message");
        return $this;
    }

}