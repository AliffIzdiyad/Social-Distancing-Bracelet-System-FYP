<?php
session_start(); //starting session
include 'db.php';

if (isset($_POST['submit'])) {
  $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $encrypted = encrypt_decrypt('encrypt', $password);
  $query = "select * from user where password='$encrypted' AND username='$user_name'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_num_rows($result);

  if ($row == 1) {
    $row1 = mysqli_fetch_assoc($result);
    $session_id = $row1['user_id'];
    $level = $row1['level'];
    $_SESSION['bracelet_user_name'] = $user_name;
    $_SESSION['bracelet_id'] = $session_id;
    if ($level == "Admin") {
      header("location: admin/index.php"); //redirecting to other page
    }
  }

  if ($row != 1) {
    $_SESSION["err"] = "Invalid Username and Password";
    header("Location: login.php");
    exit(0);
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <title>BRACELET</title>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
  <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/essential-plugins.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins/pace.min.js"></script>
  <script src="js/main.js"></script>
</head>

<body>
  <section class="login-content" style="min-height: 0px; margin-top: 40px;">
    <div class="text-center">
      <h4 class="login-head"><b>Bracelet Signal</b></h4>
    </div>
    <!--sign-in form-->
    <div class="login-box" style="min-height:0px">
      <form action="" class="login-form" method="post" style="position:unset">
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
        <div class="form-group">
          <label class="control-label">Username</label>
          <input type="text" name="user_name" placeholder="Username" autofocus class="form-control" required>
        </div>
        <div class="form-group">
          <label class="control-label">Password</label>
          <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <?php if (!empty($_SESSION["err"])) { ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            echo $_SESSION["err"];
            unset($_SESSION["err"]);
            ?>
          </div>
        <?php } ?>
        <div class="form-group btn-container">
          <button class="btn btn-primary btn-block" name="submit">SIGN IN <i class="fa fa-sign-in fa-lg"></i></button>
        </div>
      </form>
    </div>
  </section>
</body>

</html>