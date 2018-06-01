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
	$sql="SELECT * FROM sessionvideo";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		$items[] = $row;
	}
	$items = array_reverse($items ,true);
	foreach($items as $item)
	{
		echo '<section class="carder">
				<iframe width="100%" height="auto" src="'.$item["link"].'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				<section class="containerr">
				<h4>'.$item["title"].'</h4>
				<h6>'.$item["date"].'</h6>
			  <p>'.$item["comment"].'</p>
			  </section></section>';
	}
	mysqli_close($conn);
  ?>