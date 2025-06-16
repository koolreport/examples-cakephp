<?php


class MyReport extends \koolreport\KoolReport
{
    
    use \koolreport\amazing\Theme;
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