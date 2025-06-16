<?php
use \koolreport\datagrid\DataTables;
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
$currentUrl = $_SERVER['REQUEST_URI'];
$exportExcel = '/' . trim($currentUrl, '/') . '/export?type=excel';
$exportBigSpreadsheet = '/' . trim($currentUrl, '/') . '/export?type=bigspreadsheet';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Row Detail Table</h1>
        <p class="lead">Exporting excel table with row detail table</p>
		<form method="post">
			<input type="hidden" name="csrfToken" value="<?php echo $csrfToken; ?>">
			<button type="submit" class="btn btn-primary" formaction="<?php echo $exportExcel; ?>">Download Excel</button>
			<button type="submit" class="btn btn-primary" formaction="<?php echo $exportBigSpreadsheet; ?>">Download Big Spreadsheet</button>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			DataTables::create(array(
				"name" => "rowDetailTable",
				"dataSource" => $this->dataStore('sales'),
				"columns"=>array(
					"customerName",
					"productLine",
					// "productName",
					// "dollar_sales"=>array(
					// 	"type"=>"number",
					// )
				),
				"rowDetailData" => function($row) {
					return $row["productName"] . " : " . $row["dollar_sales"];
				},
				"onReady" => "function() {
					rowDetailTable.on( 'draw', function () {
						KRrowDetailTable.expandAllRowDetails();
					} );
					KRrowDetailTable.expandAllRowDetails();
				}",
				"width" => "100%"
			));
			?>
		</div>
	</div>
</div>
