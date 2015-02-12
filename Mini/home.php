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
  include('connect.php');
    $user=$_COOKIE['user'];
    $post=$_POST['status'];
    if (!empty($post))
    {
      $query="INSERT INTO `posts`(`name`, `status`) VALUES ('$user','$post')";
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
                         <div class="col-sm-6">
                          <p class="lead">Updates</p>
                           <?php
                              include('connect.php');
                              $uname=$_COOKIE['user'];
                              $query="SELECT friend FROM friends WHERE username= '$uname'";
                              $query_run=mysql_query($query);
                              $list="";
                              if($query_run)
                                {
                                    while($row=mysql_fetch_assoc($query_run))
                                      {
                                        $list=$row['friend'];
                                      }
                                }
                              $query = "SELECT * FROM posts WHERE ('$list' LIKE CONCAT('%', name, '%')) ";
                              $query_run=mysql_query($query);
                              if($query_run)
                                {
                                  $i=0;
                                  while($row=mysql_fetch_assoc($query_run) )
                                    {
                                      $uname=$row['name'];
                                      $status=$row['status'];
                                      echo "<div class=panel panel-default>";
                                      echo "<div class=panel-body>";
                                      echo "<p class=lead>$uname</p>";
                                      echo "<p>$status</p>";
                                      echo "</div>";
                                      echo "</div>";
                                      $i=$i+1;
                                    }
                                    
                                  }
                            ?>
                          </div>
                          
                          <!-- main col right -->
                          <div class="col-sm-6">
                               
                                <div class="well"> 
                                   <form class="form-horizontal" role="form" action="home.php" method="post">
                                    <h4>What's New</h4>
                                     <div class="form-group" style="padding:14px;">
                                      <textarea class="form-control" placeholder="Update your status" name='status'></textarea>
                                    </div>
                                    <button class="btn btn-primary pull-right" type="submit" name="post">Post</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                  </form>
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
