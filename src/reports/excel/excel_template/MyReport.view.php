<?php

use \koolreport\pivot\widgets\PivotTable;
use \koolreport\widgets\koolphp\Table;
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
$currentPath = $_SERVER['REQUEST_URI'];
$exportExcel = '/' . trim($currentPath, '/') . '/export';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
		<h1>Excel Exporting Template</h1>
		<p class="lead">Using template to create excel report</p>
		<form method="post">
			<input type="hidden" name="csrfToken" value="<?= $csrfToken; ?>">
			<a href="<?= $exportExcel ?>" class="btn btn-primary">Download Excel</a>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			Table::create(array(
				"dataSource" => $this->dataStore('orders'),
				"columns" => array(
					"customerName",
					"productName",
					"productLine",
					"orderDay",
					"orderMonth",
					"orderYear",
					"orderQuarter",
					"dollar_sales" => array(
						"type" => "number",
					)
				),
				"paging" => array(
					"pageSize" => 5
				)
			));
			?>
		</div>
		<br><br><br>
		<div>
			<?php
			Table::create(array(
				"dataSource" => $this->dataStore('salesQuarterCustomer'),
			));
			?>
		</div>
		<br><br><br>
		<div>
			<?php
			Table::create(array(
				"dataSource" => $this->dataStore('salesQuarterProduct'),
			));
			?>
		</div>
		<br><br><br>
		<div>
			<?php
			PivotTable::create(array(
				"dataSource" => $this->dataStore('salesPivot'),
			));
			?>
		</div>
	</div>
</div>