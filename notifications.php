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
	$sql="SELECT * FROM notifications";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		$items[] = $row;
	}
	$items = array_reverse($items ,true);
	$counter = 0;
	foreach($items as $item)
	{
		$counter++;
		echo '<section class="fakeimg">
			  <p>'.$counter.'. '.$item["message"].'</p></section>';
	}
	mysqli_close($conn);
  ?>