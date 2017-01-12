<?php

   $error = '';  // variable to store error message

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
	   $err = "Could not contact Data Server";
	   echo "<script type = 'text/javascript'>";
	   echo "alert ('$err')";
	   echo "/script";
	   echo "<script> window.history.back()</script>";
	   echo "<script> window.history.back()</script>";
	   echo "<script> window.history.back()</script>";
    }

    else
    {
        //define fname,lname,uname,email,password
        
        $fname = $_POST['fname'];
        $uname = $_POST['uname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
	    $password = md5($_POST['pass2']);
        $submit = $_POST['submit'];
        
        if (isset($submit))
        {   
        //to protect from SQL INJECTION 
		// PREVENT MAGIC KEYS SUCH AS (.. OR '' OR "" ) BASICALLY TO PREVENT SQL INJECTION
		$firstname = stripslashes($fname);
		$lastname = stripslashes($lname);
        $username = stripslashes($uname); 
        // MAKES SURE USER TYPES ON IN STRING FORMAT
		$usern = mysql_real_escape_string($username);   
		$firstn = mysql_real_escape_string($firstname);
		$lastn = mysql_real_escape_string($lastname);
            
        // selecting database
		$db = mysql_select_db("ChatUp", $conn);
	
            
		//check if user exist in database
        $sql = " SELECT * FROM signup WHERE email='$email' ";
		$query = mysql_query($sql, $conn);
            if(!$query)
            {
                echo "it did not go i.e for query";
            }
            else
            {
		          $rows = mysql_num_rows($query);
                if ($rows >= 1)
                {
                    header("Location: suc.php?user=".$usern);
                    exit();
                   
                }
                else
                {
                    $query2 = mysql_query("insert into signup (fname,lname,uname,email,password) values ('$firstn', '$lastn', '$usern', '$email', '$password' )");
                
                    //check if $query2 was carried out
			         if ($query2)
                    {
                         header("Location: unsuc.php?user=".$usern);
                         exit();   
                    }
                    else
                    {
                        header("Location: sorry.php");
                        exit(); 
                    }
                }
            }     
        }
    }

?>