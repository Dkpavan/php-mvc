<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Payment_Edit extends Block_Core_Template{

    protected $payment = null;

    public function __construct()
    {
        $this->setTemplate("View/payment/edit.phtml");
    }

    public function setPayment($payment)
    {
       $this->payment = $payment;
       return $this;
    }
    
    public function getPayment()
    {
        return $this->payment;
    }
}