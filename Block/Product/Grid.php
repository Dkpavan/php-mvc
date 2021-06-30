<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Product_Grid extends Block_Core_Template{

    protected $products= [];

    public function __construct()
    {
        $this->setTemplate("View/product/grid.phtml");
    }

    public function setProducts(array $products = null)
    {
       if(!$products){
            $product = new Model_Product();
            $products = $product->fetchAll("SELECT * from `product`");    
       }

       $this->products = $products;
       return $this;
    
    }

    public function getProducts()
    {
        return $this->products;
    }
}