# KoolReport in CakePHP

CakePHP is an open-source web, rapid development framework that makes building web applications simpler, faster and require less code.

KoolReport is reporting framework and can be integrated into CakePHP or any other MVC framework. KoolReport help you to create data report faster and easier.

In this repository, we would like to demonstrate how KoolReport can be used in CakePHP.

# Installation

Run `composer` command in your CakePHP directory to install `koolreport/core`

```
composer require koolreport/core
```
or install `koolreport/pro` if you have a license for it

```
composer require koolreport/pro
```

# Create reports

1. Inside `src` directory, create `reports` subdirectory to hold your reports.
2. Create `MyReport.php` and `MyReport.view.php` inside `reports` directory. Assign `src\reports` namespace for the report if you want it can be autoloaded. Otherwise, you could load the report directly in your controller when using it. Please see the contents of two files in our repository.

```
namespace App\reports;
class MyReport extends \koolreport\KoolReport
{
    ...
```

## Create route and action

In `config/routes.php`, create a route to your report and its action with a controller:

```
    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/customReport', [ 'controller' => 'Home', 'action' => 'customReport']);
```

In the `HomeController` controller (`src/Controllers/HomeController.php`), create the action method:

```
public function customReport()
{
    $report = new \App\reports\MyReport();
    $report_content = $report->run()->render(true);
    $this->set('report_content', $report_content);
    return $this->render('custom_report');
}
```
Create the report view `templates/Home/customReport.php` and put your report content anywhere you like:

```
<html>
...
<?php echo $report_content; ?>
</html>
```

All done!

## View result

Put your CodeIgniter app on your server/localhost. Then you can access after running

```
http://locahost/examples-cakephp/customReport
```

![combochart](combochart.png)

## CSRF field/token in form submissions and xhr requests

In reports with form submission or xhr request users need to add csrf field/token to the form and request for server response to work.

For example, adding csrf field to form:

```
    <form method="post">
        <input type="hidden" name="csrfToken" value="<?= \Cake\Routing\Router::getRequest()->getAttribute('csrfToken') ?>">
```
or add csrf token to request:

```
    <script>
        subReport.update("SaleByCountriesReport", {
            csrfToken:'<?php echo \Cake\Routing\Router::getRequest()->getAttribute('csrfToken'); ?>'
        });
```
or set csrf token in jQuery's ajax setup:

```
<meta name="csrfToken" content="<?= \Cake\Routing\Router::getRequest()->getAttribute('csrfToken') ?>" />
...
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
        }
    });
</script>
```

# Summary

KoolReport is a great php reporting framework. You can use KoolReport alone with pure php or inside any modern MVC frameworks like CakePHP, CakePHP, CodeIgniter, Yii2. If you have any questions regarding KoolReport, free free to contact us at [our forum](https://www.koolreport.com/forum/topics) or email to [support@koolreport.com](mailto:support@koolreport.com).

__Happy Reporting!__