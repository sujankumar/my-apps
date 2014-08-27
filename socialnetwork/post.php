<?php
    session_start();//session start
    include 'connection.php';//including a file for mysql connection
    // get the tweets from the POST request
    $post = $_POST['tweets'];
    // To protect MySQL injection (more detail about MySQL injection)
    $post = stripslashes($post);
    $post = mysql_real_escape_string($post);
    $post_by = $_SESSION['user_name'];
    $mysql = "INSERT INTO post "."(posts,post_by) "."VALUES "."('$post','$post_by')";
    $result = mysql_query( $mysql, $conn ); //mysql connection for query
    if(! $result ){
    die('Could not enter data: ' . mysql_error());
    }else{
    header("location:user.php");
    mysql_close($conn);//mysql connection close
    }
    ?>