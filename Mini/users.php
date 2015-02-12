<?php
session_start();
if(!$_SESSION['check'])
{       
  echo '<script type="text/javascript">';
  echo 'window.location.href = "login.php";';
  echo '</script>';
}
if(isset($_GET['link']))
{
  $user=$_COOKIE['user'];
  include('connect.php');
  $ulink=$_GET['link'];
  $query="INSERT INTO `friendrequests`(`user1`, `user2`) VALUES ('$user', '$ulink')";
  $query_run=mysql_query($query);
}
echo '<script type="text/javascript">';
echo 'window.location.href="friends.php";';
echo '</script>';
?>

