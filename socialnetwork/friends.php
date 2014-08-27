<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Friends</title>
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
          <a class="navbar-brand active" href="/socialnetwork/user.php">
          <i class="fa fa-smile-o"> 
              <?php
              echo $_SESSION["user_name"]; 
              ?></i>
          </a>
        </div>
        <div class="navbar-collapse pull-right top">
          <a href="#" class="btn btn-default btn-warning"><i class="fa fa-users"></i> Friends</a>
          <a href="/socialnetwork/logout.php" class="btn btn-default btn-danger pos"><i class="fa fa-power-off"></i>Logout</a>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <!-- Table -->
          <?php
          include'connection.php';//including connection.php 
          global $conn;
          // get the user_name, user_id from session
          $user_id=$_SESSION['user_id']; 
          $user_name=$_SESSION['user_name'];

          // To protect MySQL injection (more detail about MySQL injection)
          $user_id = stripslashes($user_id);
          $user_name = stripslashes($user_name);
          $user_id = mysql_real_escape_string($user_id);
          $user_name = mysql_real_escape_string($user_name);
          $sql = "SELECT * FROM requests where to_request = '$user_name' ";
          $retval = mysql_query( $sql, $conn );//mysql connection for query
          if(! $retval ){
            die('Could not get data: ' . mysql_error());
            }
             ?>
          <table class="table">
            <thead>
              <tr>
                <th><h4>Requests</h4></th>           
              </tr>
            </thead>
            <tbody>
            <!-- reading data from database-->
              <?php while($row = mysql_fetch_array($retval)){?>
              <tr>
                <td><h5><?php echo "{$row['from_request']}";?></h5></td>
                <td>
                  <a href="/socialnetwork/reqaccept.php?to=<?echo $row['from_request'];?>" class="btn btn-default btn-success btn-sm">
                                  <i class="fa fa-thumbs-o-up"></i>Yes</a>
                  <a href="/socialnetwork/reqreject.php?to=<?echo $row['from_request'];?>" class="btn btn-default btn-info btn-sm">
                                  <i class="fa fa-thumbs-o-down"></i>No</a>
                </td>
                <?php
                }
                mysql_close($conn);//mysql connection close
                ?>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-4">
          <?php
          include'connection.php';
          global $conn;
          $user_id=$_SESSION['user_id']; 
          $user_name=$_SESSION['user_name'];
          $sql = "SELECT * FROM requests where to_request = '$user_name' AND status=1";
          $retval = mysql_query( $sql, $conn );
          if(! $retval ){
          die('Could not get data: ' . mysql_error());
          }
          ?>
          <table class="table">
            <thead>
              <tr>
                <th><h4>My Friends</h4></th>           
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysql_fetch_array($retval)){?>
              <tr>
                <td><h5><?php echo "{$row['from_request']}";?></h5></td>
              </tr>
              <?php
                }
                mysql_close($conn);//mysql connection close
                ?>
            </tbody>
          </table>
        </div>
        <div class="col-md-4">
          <?php
          include'connection.php';
          global $conn;
          $user_name=$_SESSION['user_name'];
          $sql = "SELECT * FROM users where user_id != '$user_id'"; 
          $retval = mysql_query($sql,$conn);
          if(! $retval ){
          die('Could not get data: ' . mysql_error());
          }
          ?>
          <table class="table">
            <thead>
              <tr><th><h4>All users</h4></th></tr>
            </thead>
            <tbody>
              <?php while($row = mysql_fetch_array($retval)){?>
              <tr>
                <td><h5><?php echo "{$row['user_name']}";?></h5></td> 
                  <td><a href="/socialnetwork/request.php?name=<?echo $row['user_name'];?>" class="btn btn-default btn-primary btn-sm">
                  <i class="fa fa-plus"></i></a>
                </td>
              </tr> 
                <?php
                      }
                      mysql_close($conn);//mysql connection close
                    ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>