<?php

use \koolreport\widgets\koolphp\Table;
use \koolreport\inputs\Select2;
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
?>
<div class="report-content">
    <div class="text-center">
        <h1>Multiple Data Filters</h1>
        <p class="lead">
            The example demonstrate how to build dynamic reports with multiple data filters
        </p>
    </div>

    <form method="post">
        <input type="hidden" name="csrfToken" value="<?= h($csrfToken) ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <b>Select Years</b>
                    <?php
                    Select2::create(array(
                        "multiple" => true,
                        "name" => "years",
                        "dataSource" => $this->src("automaker")->query("
                            select YEAR(orderDate) as year
                            from orders
                            group by year
                        "),
                        "attributes" => array(
                            "class" => "form-control"
                        )
                    ));
                    ?>
                </div>

                <div class="form-group">
                    <b>Select Product Lines</b>
                    <?php
                    Select2::create(array(
                        "multiple" => true,
                        "name" => "productLines",
                        "dataSource" => $this->src("automaker")->query("
                            select productLine
                            from orders
                            join orderdetails on orders.orderNumber = orderdetails.orderNumber
                            join products on products.productCode = orderdetails.productCode
                            " . ($this->params["years"] != array() ? "where YEAR(orderDate) in (:years)" : "") . "
                            group by productLine
                        ")->params(
                            $this->params["years"] != array() ?
                                array(":years" => $this->params["years"]) :
                                array()
                        ),
                        "attributes" => array(
                            "class" => "form-control"
                        )
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <b>Select Customers</b>
                    <?php
                    Select2::create(array(
                        "multiple" => true,
                        "name" => "customerNames",
                        "dataSource" => $this->src("automaker")->query("
                            select customerName
                            from orders
                            join customers on customers.customerNumber = orders.customerNumber                            
                            " . ($this->params["years"] != array() ? "where YEAR(orderDate) in (:years)" : "") . "
                            group by customerName
                        ")->params(
                            $this->params["years"] != array() ?
                                array(":years" => $this->params["years"]) :
                                array()
                        ),
                        "attributes" => array(
                            "class" => "form-control"
                        )
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>

    </form>
    <?php
    Table::create(array(
        "dataSource" => $this->dataStore("orders"),
        "columns" => array(
            "customerName",
            "productLine",
            "amount" => array("prefix" => "$"),
            "year" => array("format" => false)
        ),
        "grouping" => array(
            "year",
            "productLine"
        ),
        "paging" => array(
            "pageSize" => 25
        ),
        "cssClass" => array(
            "table" => "table-bordered"
        )
    ));
    ?>
</div>
