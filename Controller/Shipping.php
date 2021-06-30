<?php 
Ccc::loadFile("Model/Shipping.php");
Ccc::loadFile("Controller/Core/Abstract.php");
 
class Controller_Shipping extends Controller_Core_Abstract
{ 
    public function gridAction()
    {
        try {
            $this->getLayout();
            $gridBlock = $this->getLayout()->createBlock("Block_Shipping_Grid")->setShippings();
            $this->getLayout()->addContent($gridBlock,'grid');
            $this->renderLayout();
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function addAction()
    {
        try {
            $shipping = new Model_Shipping();
            $this->getLayout();
            $addBlock = $this->getLayout()->createBlock("Block_Shipping_Edit")->setShipping($shipping);
            $this->getLayout()->addContent($addBlock,'edit');
            $this->renderLayout();
        }
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }

    public function editAction()
    {
        try {
            $id = $this->getRequest()->getParams('id');
            $shipping = new Model_Shipping();
            $shipping = $shipping->load($id);

            if(!$shipping->getId()){
                throw new Exception("Invalid Id", 1);     
            }
            $this->getLayout();
            $editBlock = $this->getLayout()->createBlock("Block_Shipping_Edit")->setShipping($shipping);
            $this->getLayout()->addContent($editBlock,'edit');
            $this->renderLayout();;
        } 
        catch (Exception $e) {
           $this->getMessage()->setFailure($e->getMessage());
           $this->redirect('grid');
        }
       
    }

    public function saveAction()
    {
        try {
            if(!$this->getRequest()->isPost()){
                throw new Exception("Invalid request", 1);
            }

            $postData = $this->getRequest()->getPost('shipping');
            if(!$postData){
                throw new Exception("No data Posted", 1);
            }

            $id =   $this->getRequest()->getParams('id');
            $shipping = new Model_Shipping();
            if($id){
                $shipping = $shipping->load($id);

                if(!$shipping->getId()){
                    throw new Exceptionta("No Id found", 1);
                }

            }
            else{
                $shipping->createdDate = date('Y-m-d H:i:s');
            }

            $Shipping['methodId'] = $id;
            $shippingData = array_merge($postData,$Shipping);
            $shipping->setData($shippingData);

            if($shipping->save()){
                $this->getMessage()->setSuccess("Data Saved Successfully");
            }
            else { 
                $this->getMessage()->setFailure("Unable to Save Data ");
            }
           
            $this->redirect('grid');

        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getParams('id');
            $shipping = new Model_Shipping();
            $shipping = $shipping->load($id);

            if(!$shipping->getId()){
                throw new Exception("Record not found", 1);
            }
            if($shipping->delete()){
                $this->getMessage()->setSuccess("Deleted Successfully");
            }
            else{
                $this->getMessage()->setSuccess("Unable to Delete");
            }
            $this->redirect('grid');

        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }


}