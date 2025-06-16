<?php

class SaleByCountriesReport extends \koolreport\KoolReport
{
    
    public function settings()
    {
        $config = include __DIR__ . "/../../../config.php";

        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );
    }
}