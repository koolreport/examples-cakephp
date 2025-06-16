<?php

use \koolreport\widgets\google;

$currentPath = $_SERVER['REQUEST_URI'];
$exportExcel = '/' . trim($currentPath, '/') . '/export';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
		<h1>Excel Exporting Template</h1>
		<p class="lead">Exporting chart with template</p>
		<form>
			<a href="<?= $exportExcel ?>" class="btn btn-primary">Download Excel</a>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			google\BarChart::create(array(
				"dataSource" => $this->dataStore('salesQuarterCustomer'),
				"columns" => [
					'customerName',
					"Q1",
					"Q2",
					"Q3",
					"Q4"
				]
			));
			?>
		</div>
		<br><br><br>
		<div>
			<?php
			google\LineChart::create(array(
				"dataSource" => $this->dataStore('salesQuarterProduct'),
				"columns" => [
					'productName',
					"Q1",
					"Q2",
					"Q3",
					"Q4"
				]
			));
			?>
		</div>
	</div>
</div>