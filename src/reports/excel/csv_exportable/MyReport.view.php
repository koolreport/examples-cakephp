<?php
use \koolreport\widgets\koolphp\Table;
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
$currentUrl = $_SERVER['REQUEST_URI'];
$export = '/' . trim($currentUrl, '/') . '/export';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>CSV Exportable</h1>
        <p class="lead">How to export datastores to CSV files</p>
		<form method="post">
			<input type="hidden" name="csrfToken" value="<?php echo $csrfToken; ?>">
			<button type="submit" class="btn btn-primary" formaction="<?php echo $export; ?>">Export to CSV</button>
			<button type="submit" class="btn btn-primary" formaction="<?php echo $export; ?>?multiply=10">Large CSV (30 thousand rows)</button>
			<button type="submit" class="btn btn-primary" formaction="<?php echo $export; ?>?multiply=100">Huge CSV (300 thousand rows)</button>
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
					"orderDate",
					"orderMonth",
					"orderYear",
					"orderQuarter",
					"dollar_sales"
				),
				"paging"=>array(
					"pageSize"=>5
				)
			));
			?>
		</div>
	</div>
</div>
