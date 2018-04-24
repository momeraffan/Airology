<?php
	if (isset($_POST["submit"]))
	{
		$username=$_POST["username"];
		$password=$_POST["password"]; 
		$conn=new mysqli('localhost', 'root', '', 'cms')
		if($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}
		$server="localhost";
		$username="root";
		$password="";
		$dbname="cms";
		$conn= new mysqli($server, $username, $password, $dbname);
		$qry="SELECT * FROM adminpeople";
		$result=$conn->query($qry);
		while($row=$result->fetch_assoc())
		{
			if($username==$row["username"] && $password==$row["password"])
			{
				echo 'alert("User successfully logged in!");';
				
			}
			else
			{
				if(counter<2)
				{
					counter++;
					header("Location: login.html");
				}
			}
		}
		
	}
	
?>