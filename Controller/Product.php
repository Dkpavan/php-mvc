<?php 
Ccc::loadFile("Model/Product.php");
Ccc::loadFile("Controller/Core/Abstract.php");

class Controller_Product extends Controller_Core_Abstract
{
    public function gridAction()
    {
        try {
            $this->getLayout();
            $gridBlock = $this->getLayout()->createBlock('Block_Product_Grid')->setProducts();
            $this->getLayout()->addContent($gridBlock,'grid');
            $this->renderLayout();
        }
        catch (Exception $e) {
            $e->getMessage();
        }
      
    }

    public function addAction()
    {
        try {
            $product = new Model_Product();
            $this->getLayout();
            $addBlock = $this->getLayout()->createBlock('Block_Product_Edit')->setProduct($product);
            $this->getLayout()->addContent($addBlock,'edit');
            $this->renderLayout();
            
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
        }
    }

    public function editAction()
    {
        try {
            $id = $this->getRequest()->getParams('id');
            $product = new Model_Product();
            $product = $product->load($id);
    
            if(!$product->getId()){
                throw new Exception("invalid Id", 1);     
            }

            $this->getLayout();
            $editBlock = $this->getLayout()->createBlock('Block_Product_Edit')->setProduct($product);
            $this->getLayout()->addContent($editBlock,'edit');
            $this->renderLayout();

        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
           
        }
       
    }

    public function saveAction()
    {
        try {
            
            if (!$this->getRequest()->isPost()) {
                throw new Exception("invalid request", 1);

            }

            $postData = $this->getRequest()->getPost('Product');
            if(!$postData){
                throw new Exception("No data posted", 1);
               
            }
            
            $id = $this->getRequest()->getParams('id');
            $product = new Model_Product(); 
            if($id){
                $product = $product->load($id);

                if(!$product->getId()){
                    throw new Exception("No Id found", 1);
                }
                
                $product->updatedDate = date('Y-m-d H:i:s');
            }
            else{
                $product->createdDate = date('Y-m-d H:i:s');
            }
           
            $product->setData($postData);
            if($product->save()){
               $this->getMessage()->setSuccess("Data saved Successfully");
            }
            else{
                $this->getMessage()->setFailure("Unable to Save Data");
            }
            
            $this->redirect("grid");

        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
        }
    }

    public function deleteAction()
    {
        try {
        
            $id = $this->getRequest()->getParams('id');
            $product = new Model_Product();
            $product = $product->load($id);
            if(!$product->getId()){
                throw new Exception("No record found", 1);  
            }

            if($product->delete()){
                $this->getMessage()->setSuccess("Deleted Successfully");
            }
            else{
                $this->getMessage()->setFailure("Unable to Delete");
            }
            $this->redirect("grid");
        } 
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
      
        }
    }

  
}
