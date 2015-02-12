<!DOCTYPE html>

<?php
session_start();
if(!$_SESSION['check'])
{       
  echo '<script type="text/javascript">';
  echo 'window.location.href = "login.php";';
  echo '</script>';
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $user1=$_POST['user1'];
  include('connect.php');
    $user2=$_COOKIE['user'];
    if (isset($_POST['yes']))
    {
      $query="SELECT friend FROM friends WHERE username= '$user2'";
      $query_run=mysql_query($query);
      $list=",";
      
      if($query_run)
      {
        while($row=mysql_fetch_assoc($query_run))
        {
          $list=$row['friend'];
        }
        $list.=$user1.",";
      }
      $query= "UPDATE `Project`.`friends` SET `friend` = '$list' WHERE `friends`.`username` = '$user2';";
      $query_run=mysql_query($query);
      $query="SELECT friend FROM friends WHERE username= '$user1'";
      $query_run=mysql_query($query);
      $list=",";
      
      if($query_run)
      {
        while($row=mysql_fetch_assoc($query_run))
        {
          $list=$row['friend'];
        }
        $list.=$user2.",";
      }
      $query= "UPDATE `Project`.`friends` SET `friend` = '$list' WHERE `friends`.`username` = '$user1';";
      $query_run=mysql_query($query);
      if($query_run)
      {
        $query= "DELETE FROM friendrequests WHERE user1 = '$user1' AND user2 = '$user2' ";
        $query_run=mysql_query($query);
      }
    }
    elseif (isset($_POST['no']))
    {
      $query= "DELETE FROM friendrequests WHERE user1 = '$user1' AND user2 = '$user2' ";
      $query_run=mysql_query($query);
    }
    
}
?>

<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Ambition Box</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<div class="wrapper">
    
                      
          
            <!-- sidebar -->
            
            <!-- /sidebar -->
          
            <!-- main right col -->
            <div class="column col-sm-12 col-xs-12" id="main">
                
                <!-- top nav -->
              	<div class="navbar navbar-blue navbar-static-top">  
                    
                  	<nav class="collapse navbar-collapse" role="navigation">
                    
                    <ul class="nav navbar-nav">
                      <li>
                        <a href="home.php"><i class="glyphicon glyphicon-user"></i><?php echo " $_COOKIE[user]";?></a>
                      </li>
                      <li>
                        <a href="home.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                      </li>
                      
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <li>
                        <a href="friends.php"><i class="glyphicon glyphicon-plus"></i> Friends</a>
                      </li>
                       <li>
                        <a href="login.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                      </li>
                    </ul>
                    
                  	</nav>
                </div>
                <!-- /top nav -->
              
                <div class="padding">
                    <div class="full col-sm-14">
                      
                        <!-- content -->                      
                      	<div class="row">
                          
                         <!-- main col left -->   
                         <div class="col-sm-5">
                          <p class="lead">FriendRequest</p>
                          <?php
                              include('connect.php');
                              $uname=$_COOKIE['user'];
                              $query="SELECT user1 FROM friendrequests WHERE user2= '$uname' ";
                              $query_run=mysql_query($query);
                              if($query_run)
                                {
                                    while($row=mysql_fetch_assoc($query_run))
                                      {
                                      $uname=$row['user1'];
                                     // echo "<div class=panel panel-default>";
                                      //echo "<div class=panel-body>";

                                      echo "<form class=form-inline  action=friends.php method=post>";
                                      echo "<input type=text style=border:0 name=user1 value=$uname readonly/> ";
                                      echo " <button class='btn btn-primary ' type=submit name=yes >ADD </button>";
                                      echo " <button class='btn btn-danger' type=submit name=no> Decline</button>";
                                      echo "</form>";
                                      echo "<br>";
                                      //echo "</div>";
                                      //echo "</div>";
                                    }
                                    echo $row['name'];
                                }
                            ?>
                          </div>
                          <div class="col-sm-4">
                            <p class="lead">Friends</p>
                            <?php
                              include('connect.php');
                              $user=$_COOKIE['user'];
                              $query="SELECT friend FROM friends WHERE username= '$user'";
                              $query_run=mysql_query($query);
                              $list="";
                              if($query_run)
                                {
                                    while($row=mysql_fetch_assoc($query_run))
                                      {
                                        $list=$row['friend'];
                                      }
                                }
                                $pieces = explode(",", $list);
                                for($i=0;$i<count($pieces) && $i<10;$i++)
                                {
                                  echo "<p class=text-danger >$pieces[$i]</p>";
                                  echo "<br>";
                                }

                            
                              echo "</div>";
                              
                              //<!-- main col right -->
                              echo "<div class='col-sm-2'>";
                              echo "<p class='lead'>Users</p>";
                              include('connect.php');
                              $user=$_COOKIE['user'];
                              $query="SELECT username FROM users WHERE ('$list' NOT LIKE CONCAT('%', username, '%') AND username != '$user')";
                              $query_run=mysql_query($query);

                              if($query_run)
                                {
                                    while($row=mysql_fetch_assoc($query_run))
                                      {
                                        $query1="SELECT * FROM friendrequests WHERE (user1= '$user' AND user2='$row[username]')OR
                                                                                          (user2= '$user' AND user1='$row[username]')";
                                        $query_run1=mysql_query($query1);

                                        if(mysql_fetch_assoc($query_run1))
                                        {
                                          //
                                        }
                                        else
                                        {
                                        echo "<button class='btn btn-primary'>$row[username]</button>";
                                        echo "  <a href= users.php?link=$row[username]><i class='glyphicon glyphicon-plus'></i></a>";
                                        }
                                        //echo "<a href=users.php?link=$row[username]><p class=text-success >$row[username]</p></a>";
                                        //echo "<a href=users.php><i class=glyphicon glyphicon-plus></i></a>";
                                        echo "<br> <br>";


                                      }
                                }
                                ?>
                              </div>
                          </div>
                       </div><!--/row-->
                    </div><!-- /col-9 -->
                </div><!-- /padding -->
            <!-- /main -->
    </div>
</div>


<!--post modal-->
<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			Update Status
      </div>
      <div class="modal-body">
          <form class="form center-block">
            <div class="form-group">
              <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div>
          <button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
            <ul class="pull-left list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
		  </div>	
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>
