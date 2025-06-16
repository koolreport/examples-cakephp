<?php
//Step 1: Load KoolReport


//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    function settings()
    {
        $config = include __DIR__ . "/../../../config.php";

        return array(
            "dataSources"=>$config
        );
    }
    protected function setup()
    {

    }
}