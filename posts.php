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
	$sql="SELECT * FROM homepageposts";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		$items[]=$row;
	}
	$items = array_reverse($items ,true);
	foreach($items as $item)
	{
		echo '<article class="card">
			  <h2>'.$item["title"].'</h2>
			  <h5>'.$item["time"].'</h5>
			  <img src="data:image/jpeg;base64,'.base64_encode( $item["image"] ).'" class="responsiveimages"></img>
			  <p>'.$item["description"].'</p></article>';
	}
	mysqli_close($conn);
  ?>