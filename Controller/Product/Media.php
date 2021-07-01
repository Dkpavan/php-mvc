<?php 

Ccc::loadFile("Controller/Core/Abstract.php");
Ccc::loadFile("Model/Product/Media.php");

class Controller_Product_Media extends Controller_Core_Abstract{
    
    public function addImageAction()
    {
        $id = $this->getRequest()->getParams("id");
        $name = $_FILES['image']['name']; 
        $location = 'media/catalog/product/';
        $tmp_name = $_FILES['image']['tmp_name'];
        $media = new Model_Product_Media();

        if (move_uploaded_file($tmp_name, $location . $name)) {
            $media->image = $location . $name;
            $media->label = $name;
            $media->productId = $id;

            if($media->save()){
                $this->getMessage()->setSuccess("Upload Image Successfully");
            }
            else{
                $this->getMessage()->setFailure("Unable to Upload Image");
            }
        $this->getLayout();
        $gridBlock = $this->getLayout()->createBlock("Block_Product_Media")->setMedia();
        $this->getLayout()->addContent($gridBlock,"media");
        $this->renderLayout();
            
        }
    }

    public function gridAction()
    {
        $this->getLayout();
        $gridBlock = $this->getLayout()->createBlock("Block_Product_Media")->setMedia();
        $this->getLayout()->addContent($gridBlock,"media");
        $this->renderLayout();
    }

    public function updateImageAction()
    {
        try{
            $radio = [];
            $postData = $this->getRequest()->getPost();

            if(!$postData){
                throw new Exception("No data Posted", 1);     
            }

            if(array_key_exists("remove",$postData)){
                $this->removeImage($postData['remove']);
                $this->redirect("grid","product");
            }
            

            if(array_key_exists("small",$postData)){
                $radio['small'] = $postData['small'];
            }
            if(array_key_exists("thumb",$postData)){
                $radio['thumb'] = $postData['thumb'];
            }
            if(array_key_exists("base",$postData)){
                $radio['base'] = $postData['base'];
            }

            $media = new Model_Product_Media();
            foreach ($postData['label'] as $key => $value) {
                $media->label = $postData['label'][$key];
                
                if(array_key_exists('gallery',$postData) && array_key_exists($key,$postData['gallery'])){
                    $media->isGallery = '1';
                }
                else{
                    $media->isGallery =  '0';
                }
                $media->mediaId = $key;
                if($media->save()){
                    $id = $this->getRequest()->getParams('id');
                    $product = new Model_Product();

                    if(!$id){
                        throw new Exception("Id not Found", 1);
                    }
                    $product->load($id);
                    $product->setData($radio);
                    if($product->save()){
                        $this->getMessage()->setSuccess("Data saved Successfully");
                    }
                    else{
                        $this->getMessage()->setFailure("Unable to Save Data");
                    }
                }
            }
        $this->getLayout();
        $gridBlock = $this->getLayout()->createBlock("Block_Product_Media")->setMedia();
        $this->getLayout()->addContent($gridBlock,"media");
        $this->renderLayout();
    
        }
        catch(Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid","product");
        }
    }

    public function removeImage($removeData)
    {
        $media = new Model_Product_Media();
        foreach($removeData as $value){
            $media->load($value);
            $id = $media->mediaId;
            $query = "Delete from `{$media->getTableName()}` where `{$media->getPrimaryKey()}` = '{$id}'";
            if($media->delete($query)){
                $this->getMessage()->setSuccess("Delete Image Successfully");
                $this->updateProduct($value);
            } 
            else{
                $this->getMessage()->setSuccess("Unable to Delete Image ");
            }  
        }
    }

    public function updateProduct($value)
    {
        try{
            $id = $this->getRequest()->getParams('id');
            $product = new Model_Product();

            if(!$id){
                throw new Exception("Id not Found", 1);
            }
            $product = new Model_Product();
            $product->load($id);
        
            $newProduct = [];

            if($product->small == $value){
                $newProduct['small'] = null;
            }
            if($product->thumb == $value){
                $newProduct['thumb'] = null;
            }
            if($product->base == $value){
                $newProduct['base'] = null;
            }
            $product->setData($newProduct);
            $product->save();
        }
        catch(Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid","product");
        }
    }
}