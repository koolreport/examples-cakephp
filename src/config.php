<?php
return array(
    "automaker"=>array(
        "connectionString"=>"mysql:host=localhost:3306;dbname=automaker",
        "username"=>"root",
        "password"=>"matkhaumoi",
        "charset"=>"utf8"
    ),
    "sakila"=>array(
        "connectionString"=>"mysql:host=localhost:3306;dbname=sakila",
        "username"=>"root",
        "password"=>"matkhaumoi",
        "charset"=>"utf8"
    ),
    "world"=>array(
        "connectionString"=>"mysql:host=localhost:3306;dbname=world",
        "username"=>"root",
        "password"=>"matkhaumoi",
        "charset"=>"utf8"
    ), 
    "employees"=>array(
        "connectionString"=>"mysql:host=localhost:3306;dbname=employees",
        "username"=>"root",
        "password"=>"matkhaumoi",
        "charset"=>"utf8"
    ),
    "salesCSV"=>array(
        'filePath' => __DIR__ . "/databases/customer_product_dollarsales2.csv",
        'class' => "\koolreport\datasources\CSVDataSource",      
        'fieldSeparator' => ';',
    )
);