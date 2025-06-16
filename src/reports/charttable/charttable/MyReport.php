<?php



//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    
    public function settings()
    {
        //Get default connection from config.php
        $config = include __DIR__ . "/../../../config.php";

        return array(
            "dataSources"=>array(
                "sales"=>array(
                    "class"=>'\koolreport\datasources\CSVDataSource',
                    "filePath"=>__DIR__ . "/../../../databases/customer_product_dollarsales2.csv",
                    "fieldSeparator"=>";"
                ),
            )
        );
    }   
    protected function setup()
    {
        $this->src('sales')
        ->pipe(new \koolreport\processes\Limit(15))
        ->pipe($this->dataStore("sales"));
    } 

}