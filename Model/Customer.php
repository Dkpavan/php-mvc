<?php
Ccc::loadFile("Model/Core/Table.php");

class Model_Customer extends Model_Core_Table 
{
    protected $shippingAddress = null ;
    protected $billingAddress = null ;

    public function __construct()
    {
        $this->setTableName("customer");
        $this->setPrimaryKey("customerId");
    }

    public function setShippingAddress($addressId = null)
    {
        $address = new Model_Customer_Address();
        $address = $address->load($addressId);
        $this->shippingAddress = $address;
        return  $this->shippingAddress;
    }

    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    public function setBillingAddress($addressId = null)
    {
        $address = new Model_Customer_Address();
        $address = $address->load($addressId);
        $this->billingAddress = $address;
        return  $this->billingAddress;
    }

    public function getBillingAddress()
    {
        return $this->billingAddress;
    }
}
