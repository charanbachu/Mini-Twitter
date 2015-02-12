<?php
$nameErr = "";
$passErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	include('connect.php');
	$user=$_POST['username'];
	$email=$_POST['email'];
	$name="SELECT `username` FROM users WHERE username='$user' OR email='$email'";
	$result=mysql_query($name);
	$num=mysql_num_rows($result);
	if(empty($_POST["username"]))
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Name is required");';
		echo 'window.location.href = "login.php";';
		echo '</script>';
	}
	else if($num!=0)
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Username Or Email Exists ");';
		echo 'window.location.href = "login.php";';
		echo '</script>';
	}
	else
	{
		if($_POST['repassword'] === $_POST['password'])
		{
			$email=$_POST['email'];
			$pass=$_POST['password'];
			$name=$_POST['username'];
			$query="INSERT INTO `users` (`email`, `username`, `password`) VALUES ('$email', '$name', '$pass')";
			$query_run=mysql_query($query);
			$query="INSERT INTO `friends`(`username`) VALUES ('$name')";
			$query_run=mysql_query($query);
			if($query_run)
			{
				echo '<script type="text/javascript">'; 
				echo 'alert("Registerd Succesfully :)");'; 
				echo 'window.location.href = "login.php";';
				echo '</script>';
			}
			else
			{
				echo '<script type="text/javascript">'; 
				echo 'alert("Failed to register;'; 
				echo 'window.location.href = "login.php";';
				echo '</script>';
			}
		}
	}
}
?>
