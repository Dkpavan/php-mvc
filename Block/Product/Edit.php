<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Product_Edit extends Block_Core_Template{

    protected $product = null;

    public function __construct()
    {
        $this->setTemplate("View/product/Edit.phtml");
    }

    public function setProduct($product)
    {
       $this->product = $product;
       return $this;
    }
    
    public function getProduct()
    {
        return $this->product;
    }
}