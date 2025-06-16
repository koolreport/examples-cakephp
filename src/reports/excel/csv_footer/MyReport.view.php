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
        <h1>CSV Footer</h1>
        <p class="lead">How to use footers and aggregates when exporting to CSV</p>
		<form method="post">
			<input type="hidden" name="csrfToken" value="<?php echo $csrfToken; ?>">
			<button type="submit" class="btn btn-primary" formaction="<?php echo $export; ?>">Export to CSV</button>
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
					// "orderDate",
					// "orderMonth",
					// "orderYear",
					// "orderQuarter",
					"dollar_sales" => [
						"footer" => "sum",
						"footerText" => "Total: @value"
					]
				),
				"showFooter" => true,
				"paging"=>array(
					"pageSize"=>5
				)
			));
			?>
		</div>
	</div>
</div>
