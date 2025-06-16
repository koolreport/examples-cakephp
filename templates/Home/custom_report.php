<?php
$public_path = $_SERVER['DOCUMENT_ROOT'] . "/";
include $public_path . "helpers/common.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="KoolReport is an intuitive and flexible Open Source PHP Reporting Framework for faster and easier data report delivery.">
    <meta name="author" content="KoolPHP Inc">
    <meta name="keywords" content="php reporting framework">
    <link rel="shortcut icon" href="/assets/images/bar.png">
    <title>
        KoolReport Examples &amp; Demonstration
    </title>

    <link href="/assets/fontawesome/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/simpleline/simple-line-icons.min.css" rel="stylesheet">
    <link href="/assets/css/tomorrow.css" rel="stylesheet">

    <link href="/assets/theme/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/theme/css/main.css" rel="stylesheet">
    
    <script type="text/javascript" src="/assets/theme/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/theme/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="/assets/js/highlight.min.js"></script>
    <script type="text/javascript" src="/assets/js/showdown.js"></script>

</head>
<body>
    <?php include $public_path . "helpers/nav.php"; ?>
    <?php include $public_path . "helpers/online_link.php"; ?>
    <main role="main" class="container">
        <?php 
            echo $report_content;
        ?>
    </main>
    <?php include $public_path . "helpers/footer.php"; ?>
    <script type="text/javascript">hljs.initHighlightingOnLoad();</script>
</body>
</html>