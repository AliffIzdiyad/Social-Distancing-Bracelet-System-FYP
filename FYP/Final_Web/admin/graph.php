<?php
session_start(); //starting session
if (!isset($_SESSION['bracelet_id'])) {
    header('Location: ../login.php'); //Redirecting to Home Page
}
include '../db.php';

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date("Y-m-d");
$data1 = "";
$data2 = "";
$query = "SELECT * FROM signal_value WHERE ";
if (!isset($_REQUEST['start_date'])) {
    $query .= "DATE(time_updated) = '" . $date . "' ORDER BY time_updated asc";
  } elseif (isset($_REQUEST['start_date'])) {
    $query .= "DATE(time_updated) = '" . $_REQUEST['start_date'] . "' ORDER BY time_updated asc";
  }
$result_set = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result_set)) {
    $data1 .= $row['signal_val'] . ',';
    $data2 .= '"' . date('H:i:s', strtotime($row['time_updated'])) . '",';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../js/dtexport/buttons.dataTables.min.css">

    <title>Welcome Admin</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
    <style>
    @media (min-width: 992px) {
      .inline_text {
        margin-top: 28px;
      }
    }

    @media (max-width: 600px) {
      .filter_but {
        text-align: center;
      }
    }
  </style>
</head>

<body class="sidebar-mini fixed">
    <div class="wrapper">
        <!-- Navbar-->
        <header class="main-header hidden-print"><a href="#" class="logo" style="font-family: 'Lato','Segoe UI',sans-serif;">Bracelet</a>
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button--><a href="#" data-toggle="offcanvas" class="sidebar-toggle"></a>
                <!-- Navbar Right Menu-->
                <div class="navbar-custom-menu">
                    <ul class="top-nav">
                        <!-- User Menu-->
                        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user fa-lg"></i></a>
                            <ul class="dropdown-menu settings-menu">
                                <li><a href="setting.php"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
                                <li><a href="../logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Side-Nav-->
        <aside class="main-sidebar hidden-print">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image"><img src="../images/admin.jpg" alt="User Image" class="img-circle"></div>
                    <div class="pull-left info">
                        <p>Hi, <?php echo $_SESSION['bracelet_user_name']; ?> !</p>
                        <p class="designation">Administrator</p>
                    </div>
                </div>
                <!-- Sidebar Menu-->
                <ul class="sidebar-menu">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                    <li class="active"><a href="graph.php"><i class="fa fa-bar-chart"></i><span>Graph</span></a></li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            <div class="page-title" style="margin-bottom:15px;">
                <div>
                    <h1><i class="fa fa-bar-chart"></i> Graph</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="tile">
                            <div class="tile-body">
                                <form class="row" method="get">
                                    <div style="text-align:center;" class="form-group col-md-3">
                                        <label class="control-label">Start Date</label>
                                        <input class="form-control" style="line-height:10px;" id="datePicker" type="date" name="start_date" value="<?= (isset($_REQUEST['start_date'])) ? date($_REQUEST['start_date']) : date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-md-12 filter_but">
                                        <button type="submit" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div id="container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascripts-->
    <script src="../js/chart/highcharts.js"></script>
    <script src="../js/chart/data.js"></script>
    <script src="../js/chart/exporting.js"></script>
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/essential-plugins.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/pace.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript">
        Highcharts.chart('container', {

            title: {
                text: 'Line Chart'
            },

            yAxis: {
                title: {
                    text: 'Signal Range'
                }
            },

            xAxis: [{
                categories: [<?php echo $data2; ?>]
            }],

            series: [{
                showInLegend: false,
                data: [<?php echo $data1; ?>]
            }],

            exporting: {
                enabled: false
            },

            credits: {
                enabled: false
            },

        });
    </script>
</body>

</html>