<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Category_Edit extends Block_Core_Template{

    protected $category = null;
    protected $categorys = [];

    public function __construct()
    {
        $this->setTemplate("View/category/edit.phtml");
        $this->setCategories();
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

    public function setCategory($category )
    {
       $this->category = $category;
       return $this;
    }
    
    public function getCategory()
    {
        if(!$this->category){
            $this->setCategory();
        }
        return $this->category;
    }
}