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
		echo '<section class="card"></h2>'.$row["title"].'</h2><img class="responsiveimages" alt="Picture not loaded">'.$row["picture"].'</img><section class="fakeimg" style="height:200px">'.$row["description"].'</section></section>';
	}
	mysqli_close($conn);
  ?>