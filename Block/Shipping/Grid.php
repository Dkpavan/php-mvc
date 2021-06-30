<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Shipping_Grid extends Block_Core_Template{

    protected $shippings= [];

    public function __construct()
    {
        $this->setTemplate("View/shipping/grid.phtml");
    }

    public function setShippings(array $shippings = null)
    {
       if(!$shippings){
            $shipping = new Model_Shipping();
            $shippings = $shipping->fetchAll("SELECT * from `shipping`"); 
       }
       $this->shippings = $shippings;
       return $this;
    
    }

    public function getShippings()
    {
        return $this->shippings;
    }
}