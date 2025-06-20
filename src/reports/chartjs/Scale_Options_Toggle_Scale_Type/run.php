<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

require_once "MyReport.php";
$report = new MyReport;
$report->run();
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
?>
<?php
if (isset($_POST['command'])) {
?>
    <div id='report_render'>
        <?php
        $report->render();
        ?>
    </div>
<?php
    exit();
}
?>
<?php
if (!isset($_POST['command'])) {
?>
    <div id='report_render'>
        <?php
        $report->render();
        ?>
    </div>
<?php
}
?>

<html>

<head>
    <title>
        Toggle Scale Type
    </title>
    <meta name="csrfToken" content="<?php echo $csrfToken; ?>" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
</head>

<body>
    <div>
        <button id="toggleScale" class="btn" style="margin: 0px 0px 10px 10px;"> Toggle Scale Type</button>
    </div>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrfToken"]')?.getAttribute('content')
                }
            });
            $('#toggleScale').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    // url: 'run.php',
                    data: {
                        command: "toggleScale"
                    },
                    success: function(response) {
                        $('#report_render').html(response);
                    }
                })
            })
        })
    </script>
    <div>
        <div id="report_render"></div>
    </div>
</body>

</html>