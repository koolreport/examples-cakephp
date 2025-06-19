<?php

function getRootPath()
{
    return str_replace("\\","/",realpath(dirname(dirname(__FILE__))));
}

function getRootUrl()
{
    $document_root = $_SERVER["DOCUMENT_ROOT"];
    $script_name = dirname($_SERVER["SCRIPT_NAME"]);
    // echo "document_root=$document_root<br>";
    // echo "script_name=$script_name<br>";
    // echo "<pre>" . json_encode($_SERVER, JSON_PRETTY_PRINT) . "</pre>";
    // exit;
    $root_url = $script_name;
    while(!is_file($document_root.$root_url."/reports.json"))
    {
        $root_url = dirname($root_url);
    }
    return $root_url;
}

$menu = json_decode(file_get_contents(realpath(dirname(__FILE__))."/../reports.json"),true);
// $root_url = getRootUrl();
$root_url = \Cake\Routing\Router::url('/', true);
