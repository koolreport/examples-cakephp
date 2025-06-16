<?php
use \koolreport\pivot\widgets\PivotTable;
use \koolreport\widgets\koolphp\Table;

$currentPath = $_SERVER['REQUEST_URI'];
$exportExcel = '/' . trim($currentPath, '/') . '/export';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Exporting Template</h1>
        <p class="lead">Exporting table with template</p>
		<form>
		<a href="<?= $exportExcel ?>" class="btn btn-primary">Download Excel</a>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			Table::create(array(
				"dataSource" => $this->dataStore('orders'),
				"columns"=>array(
					"customerName",
					"productName",
					"productLine",
					"orderDay",
					"orderMonth",
					"orderYear",
					"orderQuarter",
					"dollar_sales"=>array(
						"type"=>"number",
					)
				),
				"paging"=>array(
					"pageSize"=>5
				)
			));
			?>
		</div>
	</div>
</div>
