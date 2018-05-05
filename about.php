<?php
	$server="localhost";
	$username="root";
	$password="";
	$dbname="cms";
	$conn= new mysqli($server, $username, $password, $dbname);
	if($conn->connect_error)
	{
		echo '<script>alert("Database connection error: "'.$conn->connect_error.')<script>';
	}
	$sql="SELECT * FROM menustrip";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		echo '<a href="'.$row["link"].'" onclick="pagename() id="'.$row["id"].'">'.$row["name"].'</a>';
	}
	mysqli_close($conn);
  ?>