<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Shipping_Edit extends Block_Core_Template{

    protected $shipping = null;

    public function __construct()
    {
        $this->setTemplate("View/shipping/edit.phtml");
    }

    public function setShipping($shipping)
    {
       $this->shipping = $shipping;
       return $this;
    }
    
    public function getShipping()
    {
        return $this->shipping;
    }
}