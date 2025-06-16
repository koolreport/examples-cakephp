<?php


class MyReport extends \koolreport\KoolReport
{
    function settings()
    {
        return array(
            "dataSources" => array(
                "d3Data" => array(
                    'filePath' => __DIR__ . '/../../../../databases/c3_string_x.csv',
                    'fieldSeparator' => ';',
                    'class' => "\koolreport\datasources\CSVDataSource"
                ),
            )
        );
    }

    function setup()
    {
        $this->src("d3Data")->pipe($this->dataStore('data'));
    }
}
