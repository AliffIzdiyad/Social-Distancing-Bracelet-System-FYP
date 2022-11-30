<?php
session_start(); //starting session
if (!isset($_SESSION['bracelet_id'])) {
  header('Location: ../login.php'); //Redirecting to Home Page
}
include '../db.php';

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date("Y-m-d");
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
          <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
          <li><a href="graph.php"><i class="fa fa-bar-chart"></i><span>Graph</span></a></li>
        </ul>
      </section>
    </aside>
    <div class="content-wrapper">
      <div class="page-title" style="margin-bottom:15px;">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card" id="checksensor">
            Please Wait ...
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Javascripts-->
  <script src="../js/jquery-2.1.4.min.js"></script>
  <script src="../js/essential-plugins.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/plugins/pace.min.js"></script>
  <script src="../js/main.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      setInterval(function() {
        $("#checksensor").load('../checksensor.php');
      }, 10000);
    });
  </script>
</body>

</html>