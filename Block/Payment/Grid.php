<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Payment_Grid extends Block_Core_Template{

    protected $payments= [];

    public function __construct()
    {
        $this->setTemplate("View/payment/grid.phtml");
    }

    public function setPayments(array $payments = null)
    {
       if(!$payments){
            $payment = new Model_Payment();
            $payments = $payment->fetchAll("SELECT * from `payment`"); 
       }
       $this->payments = $payments;
       return $this;
    
    }

    public function getPayments()
    {
        return $this->payments;
    }
}