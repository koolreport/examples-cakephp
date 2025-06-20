<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

require_once "MyReport.php";
$report = new MyReport;
$report->run();
// $report->render();
use Cake\Routing\Router;

$request = Router::getRequest();
$csrfToken = $request->getAttribute('csrfToken');
?>
<?php
if (isset($_POST['command'])) {
?>
    <div id="report_render">
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
    <div id="report_render">
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
        Scriptable > Pie | Chart.js sample
    </title>
    <meta name="csrfToken" content="<?php echo $csrfToken; ?>" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <style>
        .content {
            max-width: 800px;
            margin: auto;
        }

        .toolbar {
            display: flex;
        }

        .toolbar>* {
            margin: 0 8px 0 0;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="toolbar">
            <button id="randomize" class="btn">Randomize</button>
            <button id="addDataset" class="btn">Add Dataset</button>
            <button id="removeDataset" class="btn">Remove Dataset</button>
            <button id="togglePieDoughnut" class="btn">Toggle Doughnut View</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrfToken"]')?.getAttribute('content')
                }
            });
            $('#randomize').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    // url: 'run.php',
                    data: {
                        command: 'randomize',
                    },
                    success: function(response) {
                        $('#report_render').html(response);
                    }
                })
            })
            $('#addDataset').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    // url: 'run.php',
                    data: {
                        command: 'addDataset',
                    },
                    success: function(response) {
                        $('#report_render').html(response);
                    }
                })
            })
            $('#removeDataset').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    // url: 'run.php',
                    data: {
                        command: 'removeDataset',
                    },
                    success: function(response) {
                        $('#report_render').html(response);
                    }
                })
            })
            $('#togglePieDoughnut').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    // url: 'run.php',
                    data: {
                        command: 'togglePieDoughnut',
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