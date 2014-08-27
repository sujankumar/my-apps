<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User profile</title>


    <!-- Bootstrap core CSS -->
    <link href="/socialnetwork/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/socialnetwork/bootstrap/css/own.css" rel="stylesheet">
    <link href="/socialnetwork/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">
     
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <div class="navbar navbar-inverse navbar-static-top navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand active" href="#">
          <i class="fa fa-smile-o"></i> 
            <?php
             echo $_SESSION["user_name"]; 
            ?>
          </a>
        </div>
        <div class="navbar-collapse pull-right top">
          <a href="/socialnetwork/friends.php" class="btn btn-default btn-warning"><i class="fa fa-users"></i> Friends</a>
          <a href="/socialnetwork/logout.php" class="btn btn-default btn-danger pos"><i class="fa fa-power-off"></i>Logout</a>
	      </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h4>Updates</h4> 
          <?php
          include'connection.php';
          global $conn;
          $username= $_SESSION['user_name'];
          $friends = array();
          $sql="SELECT * FROM requests WHERE (from_request='$username' OR to_request='$username') and status=1";
          $result = mysql_query( $sql,$conn);
          while($row = mysql_fetch_assoc($result)){
              if($row['from_request']!=$username){
                array_push($friends, $row['from_request']);
              }
              else if($row['to_request']!=$username){
                array_push($friends, $row['to_request']);
              }
              else{
                echo "you dont have friends";
              } 
            }
      
            array_push($friends, $username);
            for ($i=0; $i<sizeof($friends); $i++) { 
              $sql="SELECT * FROM post WHERE post_by='$friends[$i]'";
              $result = mysql_query( $sql,$conn);
              while($row = mysql_fetch_assoc($result)){
                if($row['posts']!=NULL){
                  echo "<h5> Update from ". $friends[$i] ." </h5>";
                  echo "<h5> &nbsp; &nbsp; &nbsp;". $row['posts'] ."</h5>";
                }
              }
            }
            mysql_close($conn);
                ?>
                
        </div>
        <div class="col-md-4">
          <h4>Post a new update</h4>
          <form method="post" action="post.php">
          <textarea class="form-control" rows="6" required="required" name ="tweets" placeholder="Type your status update here..."></textarea>
          <button  type="submit" class="btn btn-default btn-success  btn-default pull-right po"><i class="fa fa-pencil"></i> Post</button>
        </div>
        </form>
      </div>
    </div>
  </body>
</html>