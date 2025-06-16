<?php

use \koolreport\inputs\Select;
use \koolreport\widgets\koolphp\Table;
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');

$customerName = "";
$this->dataStore("customers")->popStart();
while ($row = $this->dataStore("customers")->pop()) {
    if ($row["customerNumber"] == $this->params["customerNumber"]) {
        $customerName = $row["customerName"];
    }
}
$currentUrl = $_SERVER['REQUEST_URI'];
?>
<div class="report-content">
    <form method="post">
        <input type="hidden" name="csrfToken" value="<?= h($csrfToken) ?>">
        <div class="text-center">
            <h1>Customer Orders</h1>
            <div class="row form-group">
                <div class="col-md-6 offset-md-3">
                    <?php
                    Select::create(array(
                        "name" => "customerNumber",
                        "dataStore" => $this->dataStore("customers"),
                        "dataBind" => array(
                            "text" => "customerName",
                            "value" => "customerNumber",
                        ),
                        "attributes" => array(
                            "class" => "form-control"
                        )
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Look up</button>
            </div>
        </div>
    </form>
    <?php
    if ($this->dataStore("orders")->countData() > 0) {
    ?>
        <?php
        Table::create(array(
            "dataStore" => $this->dataStore("orders"),
            "columns" => array(
                "productName" => array(
                    "label" => "Product",
                ),
                "priceEach" => array(
                    "label" => "Price",
                    "prefix" => "$",
                ),
                "quantityOrdered" => array(
                    "label" => "Quantity"
                ),
                "amount" => array(
                    "label" => "Total",
                    "prefix" => "$",
                )
            ),
            "class" => array(
                "table" => "table table-striped"
            )
        ));
        ?>
        <div class="text-center">
            <input type="hidden" value="<?php echo $this->params["customerNumber"]; ?>" name="customerNumber" />
            <button class="btn btn-primary" formaction="<?php echo $currentUrl; ?>/export">Export to PDF</button>
        </div>
    <?php
    }
    ?>
</div>