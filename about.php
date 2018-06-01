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
	$sql="SELECT * FROM about";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		echo '<section class="card">
			<h2>'.$row["title"].'</h2>
			<img src="data:image/jpeg;base64,'.base64_encode( $row["picture"] ).'" class="responsiveimages" alt="Picture not loaded"></img>
			<section class="fakeimg" style="minheight:200px">
			<p>'.$row["description"].'</p>
			</section></section>';
	}
	mysqli_close($conn);
  ?>