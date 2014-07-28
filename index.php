<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
| (c) Copyright 2014 by InvoicePlane.com / Kovah.de
|
*/
session_start();

require_once('config.php');
require_once('engine.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvoicePlane DB Conversion Tool</title>

    <link href="/<?php echo SUBDIR ?>assets/default/css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/<?php echo SUBDIR ?>assets/default/js/libs/jquery-1.11.1.min.js"></script>
    <script src="/<?php echo SUBDIR ?>assets/default/js/libs/bootstrap-3.2.0.min.js"></script>

</head>
<body>

<div id="tool" class="container">
    <div class="row">
        <div class="col-xs-12">

            <div class="panel panel-primary">

                <div class="panel-heading">
                    <h1 class="panel-title">
                        <i class="fa fa-retweet"></i> InvoicePlane DB Conversion Tool
                    </h1>
                </div>

                <div class="panel-body">

                    <?php
                    // Check for alerts
                    if ( isset($_SESSION['alert']) ) {
                        echo '<div class="alert alert-'.$_SESSION['alert']['type'].'">';
                        echo $_SESSION['alert']['message'];
                        echo '</div>';
                        unset($_SESSION['alert']);
                    }

                    ?>

                    <?php
                    // Determine which content should be loaded
                    if ( !empty($path[1]) && $path[1] == 'step' && !empty($path[2])  ) {

                        switch ($path[2]) {
                            case 'config':
                                require_once('content/config.php');
                                $progress = 25;
                                break;
                            case 'backup':
                                require_once('content/backup.php');
                                $progress = 50;
                                break;
                            case 'conversion':
                                require_once('content/conversion.php');
                                $progress = 75;
                                break;
                            case 'finished':
                                require_once('content/finished.php');
                                $progress = 100;
                                break;
                        }

                    } else {

                        require_once('content/start.php');

                    }

                    ?>

                </div>

                <?php if ( isset($progress) ) { ?>

                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar"
                             aria-valuenow="<?php echo $progress ?>" aria-valuemin="0"
                             aria-valuemax="100" style="width: <?php echo $progress ?>%;">
                        </div>
                    </div>

                <?php } ?>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="/<?php echo SUBDIR ?>"><i class="fa fa-home"></i></a>
                        </div>
                        <div class="col-xs-6 text-right text-muted">
                            <?php echo 'v'.TOOL_VERSION; ?>
                        </div>
                        <div class="col-xs-12 text-right text-muted">
                            For help please take a look at the <a href="https://forums.invoiceplane.com/">wiki</a> or visit the <a href="https://forums.invoiceplane.com/">official forums</a>.
                        </div>
                    </div>
                    <span class="pull-left">

                    </span>
                    <span class="pull-right">

                    </span>
                    <span class="clearfix"></span>
                </div>

            </div>
        </div>
    </div>

    <?php
    if ( DEBUG === true ) {
        echo '<pre>';
        print_r($path);
        print_r($_SESSION);
        echo '<pre>';
    }
    ?>

</div>

</body>
</html>