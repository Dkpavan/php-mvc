<?php 
Ccc::loadFile("Block/Core/Text/List.php");

class Block_Pages_Html_Footer extends Block_Core_Text_List{

    public function __construct()
    {
        $this->setTemplate("View/Pages/html/footer.phtml");
    }
}