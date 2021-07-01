<?php 
Ccc::loadFile("Block/Core/Text/List.php");
class Block_Product_Media extends Block_Core_Text_List{

    protected $media = [];
    protected $product = null;
    public function __construct()
    {
        $this->setTemplate("View/product/media.phtml");
    }
    
    public function setMedia($media = null){
        $product = new Model_Product();
        if(!$media){
            $media = new Model_Product_Media();
            $id = $this->getRequest()->getParams('id');
            if($id){
                $query = "SELECT * FROM `{$media->getTableName()}` WHERE `{$product->getPrimaryKey()}`={$id}";
                $mediaArray = $media->fetchAll($query);
                $this->media = $mediaArray;
                return $this; 
            }
           
        }
        $this->media = $media;
        return $this; 
    }
    public function getMedia(){
        if(!$this->media){
            $this->setMedia();
        }
        return $this->media;
    }

    
    public function setProduct($product = null)
    {
        if(!$product){
            $id = $this->getRequest()->getParams('id');
            if($id){
                $product = new Model_Product();
                $this->product = $product->load($id);
            }
        }
        $this->product = $product;
        return $this;
    }
    
    public function getProduct()
    {
        if(!$this->product){
            $this->setProduct();
        }
        return $this->product;
    }
}