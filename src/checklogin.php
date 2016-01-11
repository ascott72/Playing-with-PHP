<?php
	session_start();
	$username= mysql_real_escape_string($_POST['username']);
	$password= mysql_real_escape_string($_POST['password']);
	
	mysql_connect("localhost","root","Gogogo") or die (mysql_error());
	mysql_select_db("phppractice") or die("Cannot connect to database");
	$query = mysql_query("SELECT * from users WHERE username= '$username'");
	$exists = mysql_num_rows($query);
	$table_users= "";
	$table_password ="";
	
	if($exists >0)	
	{
		while($row =  mysql_fetch_assoc($query))
		{
			$table_users = $row['username'];
			$table_password = $row['password'];
		}
		
		if(($username == $table_users)&& ($password == $table_password))
		{
			$_SESSION['user']=$username;
			header("location: home.php");
		}
		else
		{
			print '<script>alert("Incorrect Password!");</script>';
			print '<script>location.assign("login.php");</script>';
		}
	}
	else
	{
		print '<script>alert("Incorrect Username!");</script>';
		print '<script>location.assign("login.php");</script>';
	}
?>