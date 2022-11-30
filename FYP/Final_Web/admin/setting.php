<?php
session_start(); //starting session
if (!isset($_SESSION['bracelet_user_name'])) {
  header('Location: ../login.php'); //Redirecting to Home Page
}
include '../db.php';

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date("Y-m-d");

$query = "SELECT * FROM signal_length";
$result_set = mysqli_query($conn, $query);

if (isset($_POST['update'])) {
  $id = $_POST['signal_id'];
  $signal_status = $_POST['signal_status'];
  $starting_range = $_POST['starting_range'];
  $ending_range = $_POST['ending_range'];
  $query = "UPDATE signal_length SET signal_status='$signal_status', starting_range='$starting_range', ending_range='$ending_range' WHERE signal_id='$id'";
  mysqli_query($conn, $query);
  $_SESSION["msg"] = "Signal Data Updated";
  header("Location: setting.php");
  exit(0);
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
                <li class="active"><a href="setting.php"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
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
          <li><a href="graph.php"><i class="fa fa-bar-chart"></i><span>Graph</span></a></li>
        </ul>
      </section>
    </aside>
    <div class="content-wrapper">
      <div class="page-title" style="margin-bottom:15px;">
        <div>
          <h1><i class="fa fa-cog"></i> Setting</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <?php if (!empty($_SESSION["err"])) { ?>
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                echo $_SESSION["err"];
                unset($_SESSION["err"]);
                ?>
              </div>
            <?php } ?>
            <?php if (!empty($_SESSION["msg"])) { ?>
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                ?>
              </div>
            <?php } ?>
            <div class="card-body">
              <div class="bs-component">
                <div class="panel panel-default">
                  <div class="card-title-w-btn" style="display: block;">
                    <div class="panel-body">
                      <div class="table-responsive" style="border:0px;">
                        <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                            <tr>
                              <th class="text-center">Signal Status</th>
                              <th class="text-center">Starting Range</th>
                              <th class="text-center">Ending Range</th>
                              <th class="text-center">Action</th>
                            </tr>
                          </thead>
                          <tbody class="text-center">
                            <?php
                            while ($rows = mysqli_fetch_assoc($result_set)) {
                            ?>
                              <tr>
                                <td><?php echo $rows['signal_status']; ?></td>
                                <td><?php echo $rows['starting_range']; ?></td>
                                <td><?php echo $rows['ending_range']; ?></td>
                                <td>
                                  <button class="btn btn-info" data-toggle="modal" data-target="#edit-<?php echo $rows['signal_id']; ?>"><i class="fa fa-edit"></i></button>
                                </td>
                                <div id="edit-<?php echo $rows['signal_id']; ?>" tabindex="-1" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Signal Data</h4>
                                      </div>
                                      <form action="" name="myForm" method="POST">
                                        <div class="modal-body">
                                          <input type="hidden" name="signal_id" value="<?php echo $rows['signal_id']; ?>">
                                          <label>Signal Status</label>
                                          <input type="text" name="signal_status" class="form-control" value="<?php echo $rows['signal_status']; ?>" required>
                                          <label>Starting Range</label>
                                          <input type="text" name="starting_range" class="form-control" value="<?php echo $rows['starting_range']; ?>" required>
                                          <label>Ending Range</label>
                                          <input type="text" name="ending_range" class="form-control" value="<?php echo $rows['ending_range']; ?>" required>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                          <button type="submit" name="update" class="btn btn-success">Update</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </tr>
                            <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
  <!-- Data table plugin-->
  <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable({
      "pagingType": "simple",
      "ordering": false
    });
  </script>
</body>

</html>