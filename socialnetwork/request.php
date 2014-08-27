<?php
session_start();//start a sessions
?>
<?php
include'connection.php';
class friends //class initialization with name
{  //class proporties
   public $user_name ;
   public $friend ;
   private $conn;
  
   function __construct($user_name,$friend_request){//constructor
    global $conn;
    $this->conn = $conn;
    $this->user_name = $user_name;
    $this->friend_request = $friend_request;
   } //class methods
        function insert(){
      $sql = "INSERT INTO requests"."(from_request,to_request) "."VALUES "."('$this->user_name', '$this->friend_request')";
      $retval = mysql_query( $sql, $this->conn );//mysql query for inserting data into a table
      if(! $retval )
      {
      die('Could not enter data: ' . mysql_error());
      }
      header("Location:/socialnetwork/friends.php");//redirecting page location

        }
}
$request=new friends ($_SESSION['user_name'],$_GET['name']);//object creation
$request-> insert();//calling a function
mysql_close($conn);//mysql close connection
?>

  
