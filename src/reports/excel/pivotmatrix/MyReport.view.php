<?php

use \koolreport\pivot\widgets\PivotMatrix;
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
$currentUrl = $_SERVER['REQUEST_URI'];
$export = '/' . trim($currentUrl, '/') . '/export';
?>
<form method="post">
	<input type="hidden" name="csrfToken" value="<?php echo $csrfToken; ?>">
	<div class="report-content">
		<div style='text-align: center;margin-bottom:30px;'>
			<h1>Excel Exporting Template</h1>
			<p class="lead">Exporting pivot matrix with template</p>
			<button type="submit" class="btn btn-primary" formaction="<?php echo $export; ?>">Download Excel</button>
			<input type="hidden" name="koolPivotUpdate" value="1" />
		</div>
		<div class='box-container'>
			<div>
				<?php
				PivotMatrix::create(array(
					"name" => "PivotMatrix1",
					"dataSource" => $this->dataStore('salesPivot'),
					"scope" => [
						"csrfToken" => $csrfToken,
					],
					"showDataHeaders" => true,
				));
				?>
			</div>
		</div>
	</div>
</form>