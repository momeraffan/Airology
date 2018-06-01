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
		<h1>Edit About Page</h1>
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
			echo '<button class="accordion">View </button>
				<section class="panel">';
			$dbserver="localhost";
			$dbusername="root";
			$dbpassword="";
			$dbname="cms";
			$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
			$qry = 'SELECT * FROM about';
			$result = $conn->query($qry);
			echo "<table><tr><th>ID</th><th>Title</th><th>Description</th></tr>";
			if ($result->num_rows > 0)
			{
				while($row=$result->fetch_assoc())
				{
					echo "<tr><td>".$row["id"]."</td><td>".$row["title"]."</td><td>".$row["description"]."</td></tr>";
				}
				echo "</table>";
			}
			mysqli_close($conn);
			echo '</section>
				<button class="accordion">Add a new section on about page</button>
				<section class="panel">
				<form method="POST" action="" enctype="multipart/form-data" id="addpost">
						<br>
						<label>Title:</label><input type="text" placeholder="Enter title of the post" name="title" maxlength="100"></input>
						<label>Image: </label><input type="file" placeholder="Select a picture" name="img" accept="image/*" ></input><br><br>
						<label>Description:</label><textarea rows="4" cols="50" name="description" form="addpost" placeholder="Enter Description here..." maxlength="1000"></textarea>
						<input type="submit" name="submit" value="Add"></input><br><br>
					</form>';
				if(isset($_POST["submit"]))
				{
					
					$image = $_FILES['img']['tmp_name'];
					$imgContent = addslashes(file_get_contents($image));
					$uploadOk = 4;
					$check = getimagesize($_FILES["img"]["tmp_name"]);
					if($check == false)
					{
						$uploadOk = 1;
					}
					elseif ($_FILES["img"]["size"] > 16462643.2)
					{
						$uploadOk = 2;
					}
					else{
						$uploadOk = 0;
						}
					switch($uploadOk)
					{
						case 0:
							$title=$_POST["title"];
							$dbserver="localhost";
							$dbusername="root";
							$dbpassword="";
							$dbname="cms";
							$dataTime = date("Y-m-d H:i:s");
							$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
							$qry = "INSERT INTO about(adminid, title, picture, description) VALUES('".$_SESSION['adminid']."', '".addslashes($title)."', '$imgContent', '".addslashes($_POST["description"])."')";
							if ($conn->query($qry) === TRUE)
							{
								echo "<script>alert('Post successful')</script>";
							}
							else
							{
								echo "<script>alert('Error: ". $conn->error."')</script>";
							}
							$conn->close();
							
						break;
						case 1: echo "<script>alert('Sorry, your file is not in image.')</script>";
						break;
						case 2: echo "<script>alert('Sorry, your file is too large.')</script>";
						break;
						default: echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
					}
				}
			echo '</section>
				<button class="accordion">Change about section</button>
				<section class="panel">
					<form method="POST" action="" enctype="multipart/form-data" id="updateform">
					<br>
					<label>ID: </label><input type="text" placeholder="Enter ID here" name="updateid"></input>
					<label>Title:</label><input type="text" placeholder="Enter title of the post" name="utitle" maxlength="100"></input>
					<label>Image: </label><input type="file" placeholder="Select a picture" name="uimg" accept="image/*" ></input><br><br>
					<label>Description:</label><textarea rows="4" cols="50" name="udescription" form="updateform" placeholder="Enter Description here..." maxlength="1000"></textarea>
					<input type="submit" name="update" value="Update"></input><br><br>
					</form>
				<br>';
			if(isset($_POST["update"]))
			{
					$image = $_FILES['uimg']['tmp_name'];
					$imgContent = addslashes(file_get_contents($image));
					$uploadOk = 4;
					$check = getimagesize($_FILES["uimg"]["tmp_name"]);
					if($check == false)
					{
						$uploadOk = 1;
					}
					elseif ($_FILES["uimg"]["size"] > 16462643.2)
					{
						$uploadOk = 2;
					}
					else{
						$uploadOk = 0;
						}
					switch($uploadOk)
					{
						case 0:
							$uid = $_POST["updateid"];
							$title = $_POST["utitle"];
							$description=$_POST["udescription"];
							$dbserver="localhost";
							$dbusername="root";
							$dbpassword="";
							$dbname="cms";
							$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
							$qry = "UPDATE about SET title='".addslashes($title)."', picture='".$imgContent."', description='".addslashes($description)."' WHERE id=".$uid;
							if ($conn->query($qry) === TRUE)
							{
								echo "<script>alert('Links updated successfully')</script>";
							} 
							else
							{
								echo "<script>alert('Error: ". $conn->error."')</script>";
							}
							$conn->close();
							
						break;
						case 1: echo "<script>alert('Sorry, your file is not in image.')</script>";
						break;
						case 2: echo "<script>alert('Sorry, your file is too large.')</script>";
						break;
						default: echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
					}
			}
			echo '</section>
				<button class="accordion">Delete a section</button>
				<section class="panel">
					<form method="POST" action="">
					<br>
					<label>ID: </label><input type="text" placeholder="Enter link Id here to delete link" name="delid"></input>
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
					$qry = "DELETE FROM about WHERE id=".$delid;
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