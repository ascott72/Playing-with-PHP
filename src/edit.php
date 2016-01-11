<html>
<head>
	<title>Php Practice</title>
</head>
<?php
	session_start();
	if($_SESSION['user']){}
	else
	{
		header("location:index.php");
	}
	$user = $_SESSION['user'];
	$id_exists=false;
	
?>

<body>
	<h2>Home Page</h2>
	<p>Hello <?php print "$user"?></p>
	<a href= "logout.php">Click here to logout</a><br /><br />
	<a href= "home.php"> Return to Home page</a>
	<h2 align= "center">Currently Selected</h2>
	<table border="1px" width="100%">
	<tr>
		<th>/Id</th>
		<th>Details</th>
		<th>Post Time</th>
		<th>Edit Time</th>
		<th>Public Post</th>
	
	</tr>

	<?php
		if(!empty($_GET['id']))
		{
			$id = $_GET['id'];
			$_SESSION['id']= $id;
			$id_exists= true;
			mysql_connect("localhost","root","Gogogo") or die(mysql_error());
			mysql_select_db("phppractice") or die("Cannot connect to database");
			$query = mysql_query("Select * from list Where id= '$id'");
			$count = mysql_num_rows($query);
			if($count > 0)
			{
				while($row = mysql_fetch_array($query))
				{
					print "<tr>";
						print '<td align = "center">'. $row['id']."</td>";
						print '<td align = "center">'. $row['details']."</td>";
						print '<td align = "center">'. $row['date_posted']. "-".$row['time_posted']."</td>";
						print '<td align = "center">'. $row['date_edited']. "-".$row['time_edited']."</td>";
						print '<td align = "center">'. $row['public']."</td>";
					print "</tr>";
						
				}
			}
			else
			{
				$id_exists= false;
			}
		}
	?>
</table>
<br />
<?php
	if($id_exists)
	{
		print ' ' .
		'<form action= "edit.php" method="POST"> ' .
			'Enter new detail: <input type = "text" name = "details"/><br/>' .
			'public post? <input type ="checkbox" name = "public[]" value ="yes"/>' .
			'<input type = "submit" value="Update List"/>' .
		'</form>';
	}
	else
	{
		print '<h2 align= "center"> There is no data to be edited.</h2>';
	}
?>
</body>
</html>

<?php
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		mysql_connect("localhost","root","Gogogo") or die(mysql_error());
		mysql_select_db("phppractice") or die("Cannot connect to database");
		$details= mysql_real_escape_string($_POST['details']);
		$public="no";
		$id = $_SESSION['id'];
		$time = strftime("%X");
		$date = strftime("%B %d, %Y");
		
		foreach($_POST['public'] as $list)
		{
			if($list != NULL)
			{
				$public= "yes";
			}
		}
		mysql_query("UPDATE list SET details = '$details',date_edited='$date',time_edited='$time',public='$public' WHERE id= '$id'");
		header("location: home.php");
		
	}
?>