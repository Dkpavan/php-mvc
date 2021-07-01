<?php

Ccc::loadFile("Model/Core/Table.php");

class Model_Product_Media extends Model_Core_Table 
{
    public function __construct()
    {
        $this->setTableName("productMedia");
        $this->setPrimaryKey("mediaId");
    }
}
