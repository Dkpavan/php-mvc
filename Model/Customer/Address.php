<?php
Ccc::loadFile("Model/Core/Table.php");

class Model_Customer_Address extends Model_Core_Table 
{
    public function __construct()
    {
        $this->setTableName("address");
        $this->setPrimaryKey("addressId");
        
    }
}
