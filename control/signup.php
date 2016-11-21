<?php
/**********VICAVELLY® STUDIO INC*********/
/*
created by   vitus©   @   VICAVELLY® Studio 
Time started : 11:45pm;
Date         : 21th November, 2016;
*/

//session_start();  //starting session
$error = '';  // variable to store error message

$host= "localhost";
$user= "root";
$pwd= "";

$db= "FriendsApplication";
	
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
	
	//define username, password and submit variable
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['uname'];
	$password = md5($_POST['pass']);
	$submit = $_POST['submit'];
	$email = $_POST['email'];
	
	if (isset($submit))
	{
		if (empty($username))
		{
			$error = "Username is a required field";
			echo "<script type = 'text/javascript'>";
			echo "alert ('$error')";
			echo "/script";
			echo "<script> window.history.back()</script>";
		}
		else if (empty($password))
		{
			$error = "Password is a required field";
			echo "<script type = 'text/javascript'>";
			echo "alert ('$error')";
			echo "/script";
			echo "<script> window.history.back()</script>";
		}
		else if (empty($email))
		{
			$error = "email is a required field";
			echo "<script type = 'text/javascript'>";
			echo "alert ('$error')";
			echo "/script";
			echo "<script> window.history.back()</script>";
		}
	
	
		//to protect from SQL INJECTION 
		$username = stripslashes($uname);   // PREVENT MAGIC KEYS SUCH AS (.. OR '' OR "" ) BASICALLY TO PREVENT SQL INJECTION
		$firstname = stripslashes($fname);
		$lastname = stripslashes($lname);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($uname);   // MAKES SURE USER TYPES ON IN STRING FORMAT
		$firstname = mysql_real_escape_string($fname);
		$lastname = mysql_real_escape_string($lname);
		$username  = mysql_real_escape_string($password);
		
		// selecting database
		$db = mysql_select_db("FriendsApplication", $conn);
	
		//check if user exist in database
		$query = mysql_query("select * from signup where password = '$password', uname='$uname',  AND email='$email'", $conn);
		$rows = mysql_num_rows($query);
	
		if ($row == 1)
		{
			$result = "$email is already an account holder .  Thank you for trying again";
			echo "<script type = 'text/javascript'>";
			echo "alert ('$result')";
			echo "/script";
			echo "<script> window.history.back()</script>";
		}
		else
		{
			$query2 = mysql_query("insert into login (username,password,email) values ('$username', '$password', '$email' )");
			//check if $query2 was carried out
			if ($query2)
			{
				$result2 = "Congatulations! You have successfully created your account";
				echo "<script type = 'text/javascript'>";
				echo "alert ('$result2')";
				echo "/script";
				echo "<script> window.history.back()</script>";
			}
		}
		
		if (!$row)
		{
			$err4 = "Could not contact Data Server....Pls try again later";
			echo "<script type = 'text/javascript'>";
			echo "alert ('$err4')";
			echo "/script";
			echo "<script> window.history.back()</script>";
		}

	}
}
mysql_close($conn);
?>
