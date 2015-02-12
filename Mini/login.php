  <!DOCTYPE html>
  <?php
  session_start();
  $_SESSION['check']=0;
  $nameErr = NULL;
  $passErr = NULL;
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
  	include('connect.php');
  	$user=$_POST['username'];
  	$name="SELECT `username` FROM users WHERE username='$user'";
          $result=mysql_query($name);
  	$num=mysql_num_rows($result);
  	if(empty($_POST["username"]))
  	{
  		$nameErr = "Name is required";
  	}
    if($num!=1)
    {
      $nameErr = "Username Dosenot Exist";
    }
    else
    {
      		$query="SELECT * FROM users WHERE username='$user'";
          $query_run=mysql_query($query);
      		$row=mysql_fetch_assoc($query_run);
      		$pass=$row['password'];
      		if($pass==$_POST['password'])
      		{
      			$_SESSION['check']=1;
              $cookie_name = "user";
              $cookie_value = $user;
              setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
      				$newURL="home.php";
              header('Location: '.$newURL);
      		}
      		else
      		{
      			$passErr="Password is incorrect";
      		}
    }
    
  }
?>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Login Page</title>
      <meta name="msapplication-TileColor" content="#5bc0de" />
      <meta name="msapplication-TileImage" content="img/metis-tile.png" />

      <!-- Bootstrap -->
      <link rel="stylesheet" href="css/login/bootstrap.min.css">

      <!-- Font Awesome -->
      <link rel="stylesheet" href="css/login/font-awesome.min.css">

      <!-- Metis core stylesheet -->
      <link rel="stylesheet" href="css/login/main.min.css">
      <link rel="stylesheet" href="css/login/animate.min.css">
    </head>
    <body class="login">
      <div class="form-signin">
        <div class="text-center">
          <img src="img/logo.png" alt="Metis Logo">
        </div>
        <hr>
        <div class="tab-content">
          <div id="login" class="tab-pane active">
            <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post"> 
              <p class="text-muted text-center">
                Enter your username and password
              </p>
              <input type="text" name="username" placeholder="username" class="form-control top" ><span><?php echo "<p class=text-danger>$nameErr</p>";?></span>
              <input type="password" name="password" placeholder="password" class="form-control bottom"><span><?php echo "<p class=text-danger>$passErr</p>";?></span> 
              <div class="checkbox">
                <label>
                  <input type="checkbox">Remember Me
                </label>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Sign in</button>
            </form>
          </div>
          <div id="signup" class="tab-pane">
            <form action="register.php" method="post">
              <input type="text" name="email" placeholder="email" class="form-control top">
              <input type="text" name="username" placeholder="username" class="form-control middle">
              <input type="password" name="password" placeholder="password" class="form-control middle">
              <input type="password" name="repassword" placeholder="retype-password" class="form-control bottom">
              <button class="btn btn-lg btn-success btn-block" type="submit" name="register">Register</button>
            </form>
          </div>
        </div>
        <hr>
        <div class="text-center">
          <ul class="list-inline">
            <li> <a class="text-muted" href="#login" data-toggle="tab">Login</a>  </li>
           <!-- <li> <a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a>  </li>-->
           <li><a class="text-muted" href="#signup" data-toggle="tab">Register</a></li>
          </ul>
        </div>
      </div>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script type="text/javascript">
        (function($) {
          $(document).ready(function() {
            $('.list-inline li > a').click(function() {
              var activeForm = $(this).attr('href') + ' > form';
              //console.log(activeForm);
              $(activeForm).addClass('animated fadeIn');
              //set timer to 1 seconds, after that, unload the animate animation
              setTimeout(function() {
                $(activeForm).removeClass('animated fadeIn');
              }, 1000);
            });
          });
        })(jQuery);
      </script>
    </body>
  </html>
