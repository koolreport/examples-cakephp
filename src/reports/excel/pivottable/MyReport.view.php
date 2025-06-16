<?php

use \koolreport\pivot\widgets\PivotTable;
use \koolreport\widgets\koolphp\Table;

$currentPath = $_SERVER['REQUEST_URI'];
$exportExcel = '/' . trim($currentPath, '/') . '/export';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
		<h1>Excel Exporting Template</h1>
		<p class="lead">Exporting pivot table with template</p>
		<form>
			<a href="<?= $exportExcel ?>" class="btn btn-primary">Download Excel</a>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			PivotTable::create(array(
				"dataSource" => $this->dataStore('salesPivot'),
				"showDataHeaders" => true,
			));
			?>
		</div>
	</div>
</div>