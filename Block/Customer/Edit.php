<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Customer_Edit extends Block_Core_Template{

    protected $customer = null;
   
    public function __construct()
    {
        $this->setTemplate("View/customer/edit.phtml");
    }

    
    public function setCustomer($customer)
    {
       $this->customer = $customer;
       return $this;
    }
    
    public function getCustomer()
    {
        return $this->customer;
    }
}