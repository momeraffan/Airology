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
	$sql="SELECT * FROM footer";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		echo '<a href="'.$row["link"].'" class="fa fa-'.$row["sitename"].'"></a>';
	}
	mysqli_close($conn);
  ?>