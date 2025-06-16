<?php

use \koolreport\pivot\widgets\PivotMatrix;
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
?>

<div class="report-content">
    <div class="text-center">
        <h1>Pivot data produced by PivotSQL process</h1>
        <p class="lead">PivotSQL works with large SQL datasets
        </p>
    </div>

    <form id='form1' class="form-inline" method="post">
        <?php
        PivotMatrix::create(array(
            "id" => "pivotMatrix1",
            'dataSource' => $this->dataStore('pivotData'),
            "scope" => [
                "csrfToken" => $csrfToken,
            ],
            'waitingFields' => array(
                "productLine" => "label",
                "productName" => "label",
                "orderMonth" => "label",
                "dollar_sales - count" => "data",
            ),
            'paging' => array(
                'size' => 10,
                'maxDisplayedPages' => 5,
                'sizeSelect' => array(5, 10, 20, 50, 100)
            )
        ));
        ?>
    </form>
</div>
