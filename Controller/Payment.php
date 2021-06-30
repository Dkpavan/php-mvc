<?php 
Ccc::loadFile("Model/Payment.php");
Ccc::loadFile("Controller/Core/Abstract.php");
 
class Controller_Payment extends Controller_Core_Abstract
{ 
    public function gridAction()
    {
        try {
            $this->getLayout();
            $gridBlock = $this->getLayout()->createBlock('Block_Payment_Grid')->setPayments();
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
            $payment = new Model_Payment();
            $this->getLayout();
            $addBlock = $this->getLayout()->createBlock('Block_Payment_Edit')->setPayment($payment);
            $this->getLayout()->addContent($addBlock,'edit');
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
            $payment = new Model_Payment();
            $payment = $payment->load($id);

            if(!$payment->getId()){
                throw new Exception("Invalid Id", 1);     
            }
            $this->getLayout();
            $editBlock = $this->getLayout()->createBlock('Block_Payment_Edit')->setPayment($payment);
            $this->getLayout()->addContent($editBlock,'edit');
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
            if(!$this->getRequest()->isPost()){
                throw new Exception("Invalid request", 1);
            }

            $postData = $this->getRequest()->getPost('payment');
            if(!$postData){
                throw new Exception("No data Posted", 1);
            }

            $id =   $this->getRequest()->getParams('id');
            $payment = new Model_Payment();
            if($id){
                $payment = $payment->load($id);

                if(!$payment->getId()){
                    throw new Exceptionta("No Id found", 1);
                }
            }
            else{
                $payment->createdDate = date('Y-m-d H:i:s');
            }
            $payment->setData($postData);
           
            if($payment->save()){
                $this->getMessage()->setSuccess("Data Saved Successfully");
            }
            else{
                $this->getMessage()->setFailure("Unable to Save Data");
            }
            
            $this->redirect('grid');
        } 
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
        }
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getParams('id');
            $payment = new Model_Payment();
            $payment = $payment->load($id);
            if(!$payment->getId()){
                throw new Exception("Record not found", 1);
            }
            if($payment->delete()){
                $this->getMessage()->setSuccess("Deleted Successfully");
            }
            else{
                $this->getMessage()->setFailure("Unable to Delete Data");
            }
            $this->redirect('grid');
        }
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
        }
    }
}