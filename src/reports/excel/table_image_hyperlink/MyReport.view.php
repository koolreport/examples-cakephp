<?php
use \koolreport\widgets\koolphp\Table;
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
$currentUrl = $_SERVER['REQUEST_URI'];
$exportExcel = '/' . trim($currentUrl, '/') . '/export?type=excel';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Exporting Image and Hyperlink Columns</h1>
        <p class="lead">Exporting excel table with image and hyperlink columns</p>
		<form method="post">
			<input type="hidden" name="csrfToken" value="<?php echo $csrfToken; ?>">
			<button type="submit" class="btn btn-primary" formaction="<?php echo $exportExcel; ?>">Download Excel</button>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			Table::create(array(
				"dataSource" => $this->dataStore('orders'),
				"columns"=>array(
					"productName",
					"dollar_sales"=>array(
						"type"=>"number",
					),
					'image' => [
						'type' => 'string',
						'formatValue' => function($value, $row, $ckey) {
							return '<img src="' . $_SERVER['REQUEST_URI'] . '../../../../assets/images/bar.png" height="40px" />';
						},
					],
					'url' => [
						'formatValue' => function ($value, $row, $ckey) {
							return '<a href="https://www.example.com">Example site</a>';
						},
					]
				),
				"paging"=>array(
					"pageSize"=>5
				)
			));
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrfToken"]')?.getAttribute('content')
		}
	});
</script>