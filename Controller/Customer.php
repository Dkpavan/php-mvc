<?php
Ccc::loadFile("Model/Customer.php");
Ccc::loadFile("Model/Customer/Address.php");
Ccc::loadFile("Controller/Core/Abstract.php");
 
class Controller_Customer extends Controller_Core_Abstract
{ 
    public function gridAction()
    {
        try {
            $this->getLayout();
            $gridBlock = $this->getLayout()->createBlock('Block_Customer_Grid')->setCustomers();
            $this->getLayout()->addContent($gridBlock,'grid');
            $this->renderLayout();
        
        }
        catch (\Exception $e) {
            $e->getMessage();
        }
        
    }

    public function addAction()
    {
        try {
            $customer = new Model_Customer();
            $this->getLayout();
            $addBlock = $this->getLayout()->createBlock("Block_Customer_Edit")->setCustomer($customer);
            $this->getLayout()->addContent($addBlock,"edit");
            $this->renderLayout();
        } 
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
        }
    }

    public function editAction()
    {
        try {
            $id = $this->getRequest()->getParams('id');
            if(!$id){
                throw new Exception("Id not found", 1);    
            }
            $customer = new Model_Customer();
            $customer->load($id);
            if(!$customer){
                throw new Exception("Unable to find record", 1);      
            }
            $this->getLayout();
            $editBlock = $this->getLayout()->createBlock("Block_Customer_Edit")->setCustomer($customer);
            $this->getLayout()->addContent($editBlock,"edit");
            $customer->setShippingAddress($customer->shippingAddressId);
            $customer->setBillingAddress($customer->billingAddressId);
            $this->renderLayout();

        }
        catch (Exception $e) {
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
            
            $postData = $this->getRequest()->getPost('Customer');
            if(!$postData){
                throw new Exception("No data posted.", 1);
            }
            
            $id = (int) $this->getRequest()->getParams('id');
            $customer = new Model_Customer();
            if($id){
                $customer = $customer->load($id);
                
                if(!$customer->getId()){
                    throw new Exception("No Id found", 1);     
                }

                $customer->updatedDate = date('Y-m-d H:i:s');
                $this->_saveBillingAddress($customer);
                $this->_saveShippingAddress($customer);
            }
            else{
                $customer->createdDate = date('Y-m-d H:i:s');
            }
            $customer->setData($postData);
    
            if($customer->save()){
                $this->getMessage()->setSuccess("Saved  Successfully");
            }
            else
            {
                $this->getMessage()->setFailure("Unable to Save Data");
            }
            $this->redirect("grid");
        } 
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
        }
    }

    protected function _saveBillingAddress($customer){
        try {
            $postData = $this->getRequest()->getPost('billing'); //always start variable name like camelcase.
            if(!$postData){
                return false;
            }
            
            $addressId = (int) $customer->billingAddressId;
            $address = new Model_Customer_Address();
            
            if($addressId){
                $address = $address->load($addressId);
            }
            
            $address->customerId = $customer->customerId;
            $address->setData($postData);
            if(!$address->save()){
                throw new Exception('unable to save billing address.');
            }
    
            $customer->billingAddressId = $address->addressId;
            $customer->save();
            
        }
        catch (Exception $e) {
            $this->getMessage()->setSuccess($e->getMessage());
            $this->redirect("grid");
        }
       
    }

    public function _saveShippingAddress($customer){
        try {
            $postData = $this->getRequest()->getPost('shipping');
        
            if(!$postData){
                return false;
            }
    
            $addressId = (int) $customer->shippingAddressId;
            $address = new Model_Customer_Address();
            if($addressId){
                $address = $address->load($addressId);
            }
            
            $address->customerId = $customer->customerId;
            $address->setData($postData);
    
    
            if(!$address->save()){
                throw new Exception('unable to save shipping address.');
            }
    
            $customer->shippingAddressId = $address->addressId;
            $customer->save();

        }
        catch (Exception $e) {
            $this->getMessage()->setSuccess($e->getMessage());
            $this->redirect("grid");
        }
       
    }


    public function deleteAction()
    {
       try {
            $id = $this->getRequest()->getParams('id');
            $address = new Model_Customer_Address();
            $address->setPrimaryKey("customerId");
            $address = $address->load($id);
            
            if(!$address->getId()){
                throw new Exception("No record found", 1);  
            }
            
            if($address->delete()){
                $customer = new Model_Customer_Address();
                $customer->delete();
                $this->getMessage()->setSuccess("Deleted Successfully");
                $this->redirect("grid");
            }
       } 
       catch (Exception $e){
            $this->getMessage()->setSuccess($e->getMessage());
            $this->redirect("grid");
       }       
    } 
}

