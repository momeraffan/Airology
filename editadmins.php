<?php
	session_start();
	if(!isset($_SESSION['adminid']))
	{
		echo "<script>location.href = 'login.php'</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<style>
		.accordion {
			background-color: #eee;
			color: #444;
			cursor: pointer;
			padding: 18px;
			width: 100%;
			border: none;
			text-align: left;
			outline: none;
			font-size: 15px;
			transition: 0.4s;
		}

		.active, .accordion:hover {
			background-color: #ccc;
		}

		.panel {
			padding: 0 18px;
			background-color: white;
			max-height: 0;
			overflow: hidden;
			transition: max-height 0.2s ease-out;
		}
		
		table {
			border-collapse: collapse;
			border-spacing: 0;
			width: 100%;
			border: 1px solid #ddd;
		}

		th, td {
			text-align: left;
			padding: 16px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2
		}
	</style>
</head>
<body>
	<header>
		<h1>Edit Admins Page</h1>
	</header>
	<nav>
		<section>
					<a href="edithomepage.php">Edit Home Page</a>
					<a href="#">Edit About Page</a>
					<a href="#">Edit Vision Page</a>
					<a href="#">Edit Sessions Page</a>
					<a href="#">Edit Contact Page</a>
					<a href="#">Edit Services Page</a>
					<a href="signout.php" style="float:right">Sign Out</a>
		</section>
	</nav>
	<br>
	<article>
		<button class="accordion">View all admins</button>
		<section class="panel">
			<p>The following people have acccess as admins:</p>
			<?php
				$dbserver="localhost";
				$dbusername="root";
				$dbpassword="";
				$dbname="cms";
				$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
				$qry = 'SELECT * FROM adminpeople';
				$result = $conn->query($qry);
				echo "<table><tr><th>Admin ID</th><th>Admin username</th></tr>";
				if ($result->num_rows > 0)
				{
				while($row=$result->fetch_assoc())
				{
					echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td></tr>";
				}
				echo"</table>";
				}
				mysqli_close($conn);
			?>
		</section>
		<button class="accordion">Add a new admin</button>
		<section class="panel">
		<form method="POST" action="">
			<br>
			<label>Username: </label><input type="text" placeholder="Enter username here" name="username"></input>
			<label>Password: </label><input type="text" placeholder="Enter password here" name="password"></input>
			<input type="submit" name="submit" value="Add"></input>
		</form>
		<br>
		<?php
		if(isset($_POST["submit"]))
		{
			$username = $_POST["username"];
			$password = $_POST["password"];
			$dbserver="localhost";
			$dbusername="root";
			$dbpassword="";
			$dbname="cms";
			$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
			$qry = "INSERT INTO adminpeople(username, password) VALUES('$username', '$password')";
			if ($conn->query($qry) === TRUE)
			{
				echo "<script>alert('New admin added successfully')</script>";
			} 
			else
			{
				echo "<script>alert('Error: ". $conn->error."')</script>";
			}
			$conn->close();
		}
		?>
		</section>
		<button class="accordion">Edit your own account</button>
		<section class="panel">
			<form method="POST" action="">
			<br>
			<label>Username: </label><input type="text" placeholder="Enter username here" name="updateusername"></input>
			<label>Password: </label><input type="text" placeholder="Enter password here" name="updatepassword"></input>
			<input type="submit" name="update" value="Update"></input>
		</form>
		<br>
		<?php
		if(isset($_POST["update"]))
		{
			$username = $_POST["updateusername"];
			$password = $_POST["updatepassword"];
			$dbserver="localhost";
			$dbusername="root";
			$dbpassword="";
			$dbname="cms";
			$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
			$qry = "UPDATE adminpeople SET username='".$username."', password='".$password."' WHERE id=".$_SESSION['adminid'];
			if ($conn->query($qry) === TRUE)
			{
				echo "<script>alert('Account updated successfully')</script>";
			} 
			else
			{
				echo "<script>alert('Error: ". $conn->error."')</script>";
			}
			$conn->close();
		}
		?>
		</section>
		<button class="accordion">Delete admin</button>
		<section class="panel">
			<form method="POST" action="">
			<br>
			<label>Admin ID: </label><input type="text" placeholder="Enter Admin Id here to delete admin" name="delid"></input>
			<input type="submit" name="delete" value="Delete"></input>
		</form>
		<br>
		<?php
		if(isset($_POST["delete"]))
		{
			$delid = $_POST["delid"];
			if($delid==1)
			{
				echo "<script>alert('Cannot delete Senior Admin (i.e. yourself)')</script>";
			}
			else
			{
				$dbserver="localhost";
				$dbusername="root";
				$dbpassword="";
				$dbname="cms";
				$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
				$qry = "DELETE FROM adminpeople WHERE id=".$delid;
				if ($conn->query($qry) === TRUE)
				{
					echo "<script>alert('Admin deleted successfully')</script>";
				} 
				else
				{
					echo "<script>alert('Error: ". $conn->error."')</script>";
				}
				$conn->close();
			}
		}
		?>
		</section>
		<script type="text/javascript">
		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++)
		{
			acc[i].addEventListener("click", function()
			{
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight)
				{
				  panel.style.maxHeight = null;
				}
				else
				{
					panel.style.maxHeight = panel.scrollHeight + "px";
				} 
			});
		}
	</script>
	</article>
	<footer>Want more customization?
		<br>
		Contact the developer:
		Muhammad Omer Affan
		+923333346061
		omeraffan@outlook.com
		<br>
		*Charges will be applied for further customization*</footer>
</body>
</html>