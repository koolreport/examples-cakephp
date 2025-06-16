<?php



use \koolreport\querybuilder\DB;

//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    
    public function settings()
    {
        //Get default connection from config.php
        $config = include __DIR__ . "/../../../config.php";

        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );
    }   
    protected function setup()
    {
        $this->src('automaker')
        ->query(
            DB::table("employees")
            ->select('employeeNumber','firstName','lastName','jobTitle')
            ->toMySQL()
        )
        ->pipe($this->dataStore("employees"));
    } 

}