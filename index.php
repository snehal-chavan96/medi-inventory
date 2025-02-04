<?php
error_reporting(1);
session_start();
include("dbcon.php");
if (isset($_SESSION['user_session'])) {

  $invoice_number = "CA-" . invoice_number();
  header("location:home.php?invoice_number=$invoice_number");
}

if (isset($_POST['submit'])) { //******Login Form*******
  $username = $_POST['username'];

  $password = $_POST['password'];



  $select_sql = "SELECT * FROM users ";

  $select_query = mysqli_query($con, $select_sql);

  if ($select_query) {

    while ($row = mysqli_fetch_array($select_query)) {
      $s_username = $row['user_name'];
      $s_password = $row['password'];
    }
  }

  if ($s_username == $username && $s_password == $password) {

    $_SESSION['user_session'] = $s_username;
    $invoice_number = "CA-" . invoice_number();
    header("location:home.php?invoice_number=$invoice_number");


  } else {
    $error_msg = "<center><font color='red'>Login Failed</font></center>";
  }

} //******Login Form*******

function invoice_number()
{ //********Outputting Random Number For Invoice Number********

  $chars = "09302909209300923";

  srand((double) microtime() * 1000000);

  $i = 1;

  $pass = '';

  while ($i <= 7) {

    $num = rand() % 10;
    $tmp = substr($chars, $num, 1);
    $pass = $pass . $tmp;
    $i++;
  }
  return $pass;
  //********Outputting Random Number For Invoice Number********
}
?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>

<head>

  <title>SPMS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
  <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-image: url(tab.jpg);
      background-size: cover;
      font-family: Arial, sans-serif;
    }



    .container {
      text-align: center;
      size: 40%;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.8);
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
      width: 500px;
      /* Added to limit the container width */
      margin: 0 auto;
      /* Center the container */
    }

    .login-box h1 {
      font-size: 32px;
      margin-bottom: 20px;
      color: #333;
    }
  </style>


</head>

<body>



 

    <form method="POST">

      <div class="container">
        <div class="login-box">
          <table class="table table-bordered table-responsive ">
            <div class="textbox">

              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="textbox">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required>
            </div>

            <input type="hidden" aucomplete="off" name="invoice_number" value="<?php echo 'CA-' . invoice_number() ?>">

          </table>


          <input type="submit" name="submit" class="btn btn-danger btn-large" value="Login">

        </div>

      </div>

      <?php echo $error_msg; ?>

    </form>


  



</body>

</html>