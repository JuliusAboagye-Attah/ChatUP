<?php
    $host= "localhost";
    $user= "root";
    $pwd= "";

    $db= "ChatUp";
 
    

    //establishing connection
    $conn=@mysql_connect($host, $user, $pwd);
    $select=@mysql_select_db($db);

    //check if connected
    if(!$conn || !$select)
    {
	   header("Location: not.php");
       exit();          
    }
    else
    {
        session_start();
        
        $userid = $_POST['username'];
        $pass = $_POST['password'];
        
        $username = stripslashes($userid); 
        // MAKES SURE USER TYPES ON IN STRING FORMAT
		$usern = mysql_real_escape_string($username);   
            
        $_SESSION['username'] = $usern;
        $_SESSION['password'] = $pass;
        
        
        //check if user exist in the database
        $sql = "SELECT (uname, password) FROM `signup` WHERE uname = '$usern' AND password = MD5('$pass')";
        $query = mysql_query($sql, $conn);
        if(!$query)
        {
           header("Location: notretrieving.php");
           exit();
        }
        else
        {
            echo $query;
        }
//        echo $usern;
//        echo $pass;
    }
?>