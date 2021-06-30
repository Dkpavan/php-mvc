<?php 
Ccc::loadFile("Block/Core/Template.php");
class Block_Customer_Grid extends Block_Core_Template{

    protected $customers= [];

    public function __construct()
    {
        $this->setTemplate("View/customer/grid.phtml");
    }

    public function setCustomers(array $customers = null)
    {
       if(!$customers){
            $customer = new Model_Customer();
            $query = "SELECT   * , customer.customerId from `customer` left join `address` on customer.billingAddressId = address.addressId ";
            $customers = $customer->fetchAll($query); 
       } 
       $this->customers = $customers;
       return $this;
    
    }

    public function getCustomers()
    {
        return $this->customers;
    }
}