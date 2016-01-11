<html>
	<head>
		<title>PHP Practice</title>
		<style>
			td.yes{background-color: black}
		</style>
	</head>
	<?php
		session_start();
		if($_SESSION['user']){}
		else
		{
			header("location:index.php");
		}
		$user = $_SESSION['user'];
	?>
	<body>
		<h2>Home Page</h2>
		<p>Hello <?php print "$user"?> !</p>
		<a href="logout.php">Click Here to logout </a></br></br>
		<form action= "add.php" method = "POST">
			Add more to list : <input type="text" name="details" /><br />
			public post? <input type="checkbox" name="public[]" value="yes" /><br />
			<input type="submit" value="Add to list" />
		</form>
		<h2 align = "center">My list</h2>
		<table border = "1px" width="100%">
		<tr>
			<th>ID</th>
			<th>Details</th>
			<th>Post Time</th>
			<th>Edit Time</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Public Post</th>
		</tr>
		
		<?php
			mysql_connect("localhost","root","Gogogo") or die(mysql_error());
			mysql_select_db("phppractice")or die("Cannot connect to Database");
			$query= mysql_query("Select * from list");
			$highlight= "no";
			
			while($row = mysql_fetch_array($query))
			{
				if($row['public']=="no")
				{
					$highlight="yes";
				}
				else
				{
					$highlight="no";
				}
				print "<tr>";
					print '<td align = "center">'. $row['id']."</td>";
					print '<td class='.$highlight.' align = "center">'. $row['details']."</td>";
					print '<td class='.$highlight.' align = "center">'. $row['date_posted']. "-".$row['time_posted']."</td>";
					print '<td class= '.$highlight.' align = "center">'. $row['date_edited']. "-".$row['time_edited']."</td>";
					print '<td align = "center"><a href= "edit.php?id='.$row['id'].'">edit</a></td>';
					print '<td align = "center"><a href= "#" onclick = "myFunction('.$row['id'].')">delete</a></td>';
					print '<td align = "center">'. $row['public']."</td>";
				print "</tr>";
			}
		?>
		</table>
		<script>
			function myFunction(id)
			{
				var r = confirm("Are you sure you want to delete this record?");
				if(r==true)
				{
					window.location.assign("delete.php?id="+id);
				}
			}
		</script>
	</body>
</html>
