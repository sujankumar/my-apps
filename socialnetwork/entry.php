<?php
    include 'connection.php';
    // get the user_name, email_id, password from the POST request
    $user_name=$_POST['user_name']; 
    $email_id=$_POST['email_id'];
    $password=$_POST['password']; 

    // To protect MySQL injection (more detail about MySQL injection)
    $myusername = stripslashes($user_name);
    $email_id = stripslashes($email_id);
    $password = stripslashes($password);
    $user_name = mysql_real_escape_string($user_name);
    $email_id = mysql_real_escape_string($email_id);
    $pass_word = mysql_real_escape_string($password);
    $mysql = "INSERT INTO users"."(user_name,email_id,password) "."VALUES "."('$user_name','$email_id','$password')";
    $result = mysql_query( $mysql, $conn ); //mysql connection for query
    if(! $result ){
    die('Could not enter data: ' . mysql_error());
    }else{
    header("location:signin.html");
    mysql_close($conn);//mysql connection close
    }
    ?>
    