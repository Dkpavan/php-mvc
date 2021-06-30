<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Category_Grid extends Block_Core_Template{

    protected $categorys= [];

    public function __construct()
    {
        $this->setTemplate("View/category/grid.phtml");
    }

    public function setCategories(array $categorys = null)
    {
       if(!$categorys){
            $category = new Model_Category();
            $categorys = $category->fetchAll("SELECT * from `category`"); 
       }
       $this->categorys = $categorys;
       return $this;
    
    }

    public function getCategories()
    {
        return $this->categorys;
    }
}