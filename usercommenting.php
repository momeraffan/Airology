<?php
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
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die('<script>window.alert("Connection failed: " . $conn->connect_error)</script>');
			} 
			else
			{
				$sql = "INSERT INTO feedback(name, email, comment) VALUES('$namev', '$email', '$comment')";

				if ($conn->query($sql) == TRUE) {
					echo "<script>snackbarr();</script>";
				} else {
					echo '<script>window.alert("Error: " . $sql . "<br>" . $conn->error)</script>';
				}
			}
		}
	}
?>