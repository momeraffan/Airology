<?php
	session_start();
	if(isset($_SESSION['adminid']))
	{
		echo '<script>alert("User successfully logged in!");</script>';
		echo '<script>location.href = "adminhome.php"</script>';
	}
	else{
		if (isset($_POST["submit"]))
		{
			$username=$_POST["username"];
			$password=$_POST["password"]; 
			$conn=new mysqli('localhost', 'root', '', 'cms');
			if($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
				echo "<script>location.href = 'login.html'</script>";
			}
			$dbserver="localhost";
			$dbusername="root";
			$dbpassword="";
			$dbname="cms";
			$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
			$qry="SELECT * FROM adminpeople";
			$result=$conn->query($qry);
			while($row=$result->fetch_assoc())
			{
				if($username==$row["username"] and $password==$row["password"])
				{
					$_SESSION['adminid'] = $row["id"];
					echo '<script>alert("User successfully logged in!");</script>';
					echo "<script>location.href = 'adminhome.php'</script>";
				}
				else
				{
					echo '<script>alert("User login unsuccessful! Try again...");</script>';
					echo "<script>location.href = 'login.php'</script>";
				}
			}
			
		}
	}
?>