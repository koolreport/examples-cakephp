<?php
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
$drilldown = $this->params["@drilldown"];
?>
<meta name="csrfToken" content="<?= $csrfToken ?>" />
<level-title>All countries</level-title>
<?php
\koolreport\widgets\google\GeoChart::create(array(
    "dataSource" => $this->dataStore("country_sale"),
    "columns" => array("country", "sale_amount" => array(
        "label" => "Sales(USD)",
        "prefix" => '$',
    )),
    "clientEvents" => array(
        "rowSelect" => "function(params){
                $drilldown.next({country:params.selectedRow[0]});
            }",
    ),
    "width" => "100%",
));
?>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrfToken"]')?.getAttribute('content')
		}
	});
</script>