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
		<h1>Manage Media Links</h1>
	</header>
	<nav>
		<section>
		<?php
		if($_SESSION['adminid']==1)
		{
			echo '<a href="adminhome.php">Admin Panel</a>';
		}
		else
		{
			echo '<a href="edithomepage.php">Edit Home Page</a>
				<a href="editsessions.php">Edit Sessions Page</a>
				<a href="editmedialinks.php">Edit Media Links</a>';
		}
		?>
			<a href="signout.php" style="float:right">Sign Out</a>
		</section>
	</nav>
	<br>
	<article>
		<?php
			echo '<button class="accordion">View all media links</button>
				<section class="panel">';
			$dbserver="localhost";
			$dbusername="root";
			$dbpassword="";
			$dbname="cms";
			$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
			$qry = 'SELECT * FROM footer';
			$result = $conn->query($qry);
			echo "<table><tr><th>Admin ID</th><th>ID</th><th>Platform</th><th>Link</th></tr>";
			if ($result->num_rows > 0)
			{
				while($row=$result->fetch_assoc())
				{
					echo "<tr><td>".$row["adminid"]."</td><td>".$row["id"]."</td><td>".$row["sitename"]."</td><td>".$row["link"]."</td></tr>";
				}
				echo "</table>";
			}
			mysqli_close($conn);
			echo '</section>
				<button class="accordion">Add a new link</button>
				<section class="panel">
				<form method="POST" action="">
					<br>
					<label>Username: </label><input type="text" placeholder="Enter platform name here" name="sitename"></input>
					<label>Password: </label><input type="text" placeholder="Enter link here" name="link"></input>
					<input type="submit" name="submit" value="Add"></input>
				</form>
				<br>';
			if(isset($_POST["submit"]))
			{
				$sitename = $_POST["sitename"];
				$link = $_POST["link"];
				$dbserver="localhost";
				$dbusername="root";
				$dbpassword="";
				$dbname="cms";
				$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
				$qry = "INSERT INTO footer(sitename, link) VALUES('$sitename', '$link')";
				if ($conn->query($qry) === TRUE)
				{
					echo "<script>alert('New link added successfully')</script>";
				} 
				else
				{
					echo "<script>alert('Error: ". $conn->error."')</script>";
				}
				$conn->close();
			}
			echo '</section>
				<button class="accordion">Change link</button>
				<section class="panel">
					<form method="POST" action="">
					<br>
					<label>ID: </label><input type="text" placeholder="Enter ID here" name="updateid"></input>
					<label>Site-name: </label><input type="text" placeholder="Enter sitename here" name="upsitename"></input>
					<label>Link: </label><input type="text" placeholder="Enter link here" name="uplink"></input>
					<input type="submit" name="update" value="Update"></input>
				</form>
				<br>';
			if(isset($_POST["update"]))
			{
					$uid = $_POST["updateid"];
					$sitename = $_POST["upsitename"];
					$ulink = $_POST['uplink'];
					$dbserver="localhost";
					$dbusername="root";
					$dbpassword="";
					$dbname="cms";
					$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
					$qry = "UPDATE footer SET sitename='".$sitename."', link='".$ulink."' WHERE id=".$uid;
					if ($conn->query($qry) === TRUE)
					{
						echo "<script>alert('Links updated successfully')</script>";
					} 
					else
					{
						echo "<script>alert('Error: ". $conn->error."')</script>";
					}
					$conn->close();
				
			}
			echo '</section>
				<button class="accordion">Delete a link</button>
				<section class="panel">
					<form method="POST" action="">
					<br>
					<label>Admin ID: </label><input type="text" placeholder="Enter link Id here to delete link" name="delid"></input>
					<input type="submit" name="delete" value="Delete"></input>
				</form>
				<br>';
			if(isset($_POST["delete"]))
			{
					$delid = $_POST["delid"];
					$dbserver="localhost";
					$dbusername="root";
					$dbpassword="";
					$dbname="cms";
					$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
					$qry = "DELETE FROM footer WHERE id=".$delid;
					if ($conn->query($qry) === TRUE)
					{
						echo "<script>alert('link deleted successfully')</script>";
					} 
					else
					{
						echo "<script>alert('Error: ". $conn->error."')</script>";
					}
					$conn->close();
			}
			echo '</section>';
		?>
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