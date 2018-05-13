<?php
	$conn->close();
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty($_POST["name"]))
		{			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "cms";
			$namev= $_POST["nameofcommenter"];
			$email = $_POST["emailofcommenter"];
			$comment = $_POST["comment"];
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die('<script>window.alert("Connection failed: " . $conn->connect_error)</script>');
			} 
			else
			{
				$sql = "INSERT INTO feedback (name, email, comment)
				VALUES ('$name', '$email', '$comment')";

				if ($conn->query($sql) == TRUE) {
					echo "<script>snackbarr();</script>";
				} else {
					echo '<script>window.alert("Error: " . $sql . "<br>" . $conn->error)</script>';
				}
			}
		}
	}
?>