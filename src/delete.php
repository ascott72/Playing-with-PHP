<?php
	session_start();
	if($_SESSION['user']){}
	else
	{
		header("location:index.php");
	}
	
	if($_SERVER['REQUEST_METHOD']=="GET")
	{
		mysql_connect("localhost","root","Gogogo") or die(mysql_error());
		mysql_select_db("phppractice") or die("Cannot connect to database");
		$id = $_GET['id'];
		mysql_query("DELETE FROM list WHERE id= '$id'");
		header("location: home.php");
	}
?>