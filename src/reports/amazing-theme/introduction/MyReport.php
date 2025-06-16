<?php


class MyReport extends \koolreport\KoolReport
{
    
    use \koolreport\amazing\Theme;
    public function settings()
    {
        return array(
            "dataSources" => array(
                "sales" => array(
                    "class" => '\koolreport\datasources\CSVDataSource',
                    "filePath" => __DIR__ . "/../../../databases/customer_product_dollarsales2.csv",
                    "fieldSeparator" => ";",
                ),
            ),
        );
    }
}
