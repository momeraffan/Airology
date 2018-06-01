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
		<h1>Edit Home Page</h1>
	</header>
	<nav>
		<section>
		<?php
			if($_SESSION['adminid']==1)
			{
				echo '<a href="adminhome.php">Admin Panel</a>
					';
			}
			else
			{
				echo '<a href="adminhome.php">Admin Panel</a>
					<a href="#">Edit Sessions Page</a>
					<a href="editmedialinks.php">Edit Media-links</a>';
			}
		?>
		
		<a href="signout.php" style="float:right">Sign Out</a>
		</section>
	</nav>
	<br><br>
	<button class="exto myBtn_multi">Posts</button>
	<section id="myModal" class="modal modal_multi">
		<section class="modal-content">
			<section class="modal-header">
				<span class="close close_multi">&times;</span>
				<h2>Posts Menu</h2>
			</section>
			<section class="modal-body">
				<button class="accordion">Add new post (with picture)</button>
				<section class="panel">
					<form method="POST" action="" enctype="multipart/form-data" id="addpost">
						<br>
						<label>Title:</label><input type="text" placeholder="Enter title of the post" name="title" maxlength="100"></input>
						<label>Image: </label><input type="file" placeholder="Select a picture" name="img" accept="image/*" ></input><br><br>
						<label>Description:</label><textarea rows="4" cols="50" name="description" form="addpost" placeholder="Enter Description here..." maxlength="1000"></textarea>
						<input type="submit" name="submit" value="Add"></input><br><br>
					</form>
					<?php
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
							elseif ($_FILES["img"]["size"] > 16462643.2) {
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
									$qry = "INSERT INTO homepageposts(adminid, title, time, image, description) VALUES('".$_SESSION['adminid']."', '".addslashes($title)."', '$dataTime', '$imgContent', '".addslashes($_POST["description"])."')";
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
					?>
				</section>
					<br>
				<button class="accordion">Add new post (without picture)</button>
				<section class="panel">
					<form method="POST" action="" id="addpostwp">
						<br>
						<label>Title:</label><input type="text" placeholder="Enter title of the post" name="title" maxlength="100"></input>
						<label>Description:</label><textarea rows="4" cols="50" name="description" form="addpostwp" placeholder="Enter Description here..." maxlength="1000"></textarea>
						<input type="submit" name="submission" value="Add"></input><br><br>
					</form>
					<?php
						if(isset($_POST["submission"]))
						{
							$title=$_POST["title"];
							$dbserver="localhost";
							$dbusername="root";
							$dbpassword="";
							$dbname="cms";
							$dataTime = date("Y-m-d H:i:s");
							$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
							$qry = "INSERT INTO homepageposts(adminid, title, time, description) VALUES('".$_SESSION['adminid']."', '".addslashes($title)."', '$dataTime', '".addslashes($_POST["description"])."')";
							if ($conn->query($qry) === TRUE)
							{
								echo "<script>alert('Post successful')</script>";
							} 
							else
							{
								echo "<script>alert('Error: ". $conn->error."')</script>";
							}
							$conn->close();
						}
					?>
				</section>
					<br>
				<button class="accordion">view posts</button>
				<section class="panel">
					<br>
					<?php
						$dbserver="localhost";
						$dbusername="root";
						$dbpassword="";
						$dbname="cms";
						$dataTime = date("Y-m-d H:i:s");
						$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
						$qry = "SELECT * FROM homepageposts";
						$result = $conn->query($qry);
						echo "<table><tr><th>Admin ID</th><th>Post ID</th><th>Post Title</th></tr>";
						if ($result->num_rows > 0)
						{
							while($row=$result->fetch_assoc())
							{
								echo "<tr><td>".$row["adminid"]."</td><td>".$row["id"]."</td><td>".$row["title"]."</td></tr>";
							}
							echo "</table>";
						} 
						else
						{
							echo "<script>alert('Error: ". $conn->error."')</script>";
						}
						$conn->close();
					?>
				</section>
				<br>
				<button class="accordion">Delete a post</button>
				<section class="panel">
					<form method="POST" action="">
						<br>
						<label>ID of post to be deleted:</label><input type="text" placeholder="Enter IDof the post to be deleted" name="id"></input>
						<input type="submit" name="delete" value="Delete"></input><br><br>
					</form>
					<?php
						if(isset($_POST["delete"]))
						{
							$dbserver="localhost";
							$dbusername="root";
							$dbpassword="";
							$dbname="cms";
							$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
							$qry = "DELETE FROM homepageposts WHERE id=".$_POST["id"];
							if ($conn->query($qry) === TRUE)
							{
								echo "<script>alert('Post successfully deleted!')</script>";
							} 
							else
							{
								echo "<script>alert('Error: ". $conn->error."')</script>";
							}
							$conn->close();
						}
					?>
				</section>
			</section>
		</section>
	</section>
	<br><br>
	<button class="exto myBtn_multi">Notifications</button>
	<section id="myModal" class="modal modal_multi">
	<section class="modal-content">
			<section class="modal-header">
				<span class="close close_multi">&times;</span>
				<h2>Notifications Menu</h2>
			</section>
			<section class="modal-body">
				<button class="accordion">Add new notification</button>
				<section class="panel">
					<form method="POST" action="" id="addnotification">
						<br>
						<label>Notification Message:</label><textarea rows="4" cols="50" name="message" form="addnotification" placeholder="Enter Description here..." maxlength="50"></textarea>
						<input type="submit" name="addn" value="Add"></input><br><br>
					</form>
					<?php
						if(isset($_POST["addn"]))
						{
							$dbserver="localhost";
							$dbusername="root";
							$dbpassword="";
							$dbname="cms";
							$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
							$qry = "INSERT INTO notifications(adminid, message) VALUES('".$_SESSION['adminid']."', '".addslashes($_POST["message"])."')";
							if ($conn->query($qry) === TRUE)
							{
								echo "<script>alert('Post successful')</script>";
							} 
							else
							{
								echo "<script>alert('Error: ". $conn->error."')</script>";
							}
							$conn->close();
						}
					?>
				</section>
					<br>
				<button class="accordion">View notifications</button>
				<section class="panel">
					<br>
					<?php
						$dbserver="localhost";
						$dbusername="root";
						$dbpassword="";
						$dbname="cms";
						$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
						$qry = "SELECT * FROM notifications";
						$result = $conn->query($qry);
						echo "<table><tr><th>Admin ID</th><th>Notification ID</th><th>Notification</th></tr>";
						if ($result->num_rows > 0)
						{
							while($row=$result->fetch_assoc())
							{
								echo "<tr><td>".$row["adminid"]."</td><td>".$row["id"]."</td><td>".$row["message"]."</td></tr>";
							}
							echo "</table>";
						} 
						else
						{
							echo "<script>alert('Error: ". $conn->error."')</script>";
						}
						$conn->close();
					?>
				</section>
				<br>
				<button class="accordion">Delete notification</button>
				<section class="panel">
					<form method="POST" action="">
						<br>
						<label>ID of notification to be deleted:</label><input type="text" placeholder="Enter ID of the notification" name="didn"></input>
						<input type="submit" name="deleten" value="Delete"></input><br><br>
					</form>
					<?php
						if(isset($_POST["deleten"]))
						{
							$dbserver="localhost";
							$dbusername="root";
							$dbpassword="";
							$dbname="cms";
							$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
							$qry = "DELETE FROM notifications WHERE id=".$_POST["didn"];
							if ($conn->query($qry) === TRUE)
							{
								echo "<script>alert('Notification successfully deleted!')</script>";
							} 
							else
							{
								echo "<script>alert('Error: ". $conn->error."')</script>";
							}
							$conn->close();
						}
					?>
				</section>
			</section>
		</section>
	</section>
	<br><br>
	<button class="exto myBtn_multi">Articles</button>
	<section id="myModal" class="modal modal_multi">
		<section class="modal-content">
			<section class="modal-header">
				<span class="close close_multi">&times;</span>
				<h2>Articles Menu</h2>
			</section>
			<section class="modal-body">
				<button class="accordion">Add new article</button>
				<section class="panel">
					<form method="POST" action="" id="addarticle">
						<br>
						<label>Title: </label><input type="text" name="titlea" placeholder="Enter title here" maxlength="30"></input>
						<label>Link: </label><textarea rows="4" cols="50" name="linka" form="addarticle" placeholder="Enter link (url) here..."></textarea>
						<input type="submit" name="adda" value="Add"></input><br><br>
					</form>
					<?php
						if(isset($_POST["adda"]))
						{
							$dbserver="localhost";
							$dbusername="root";
							$dbpassword="";
							$dbname="cms";
							$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
							$qry = "INSERT INTO articles(adminid, title, link) VALUES('".$_SESSION['adminid']."', '".addslashes($_POST["titlea"])."', '".addslashes($_POST["linka"])."')";
							if ($conn->query($qry) === TRUE)
							{
								echo "<script>alert('Post successful')</script>";
							} 
							else
							{
								echo "<script>alert('Error: ". $conn->error."')</script>";
							}
							$conn->close();
						}
					?>
				</section>
					<br>
				<button class="accordion">View Articles</button>
				<section class="panel">
					<br>
					<?php
						$dbserver="localhost";
						$dbusername="root";
						$dbpassword="";
						$dbname="cms";
						$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
						$qry = "SELECT * FROM articles";
						$result = $conn->query($qry);
						echo "<table><tr><th>Admin ID</th><th>Article ID</th><th>Title</th><th>Article link</th></tr>";
						if ($result->num_rows > 0)
						{
							while($row=$result->fetch_assoc())
							{
								echo "<tr><td>".$row["adminid"]."</td><td>".$row["id"]."</td><td>".$row["title"]."</td><td>".$row["link"]."</td></tr>";
							}
							echo "</table>";
						} 
						else
						{
							echo "<script>alert('Error: ". $conn->error."')</script>";
						}
						$conn->close();
					?>
				</section>
				<br>
				<button class="accordion">Delete article link</button>
				<section class="panel">
					<form method="POST" action="">
						<br>
						<label>ID of article link to be deleted:</label><input type="text" placeholder="Enter ID of the article link" name="dida"></input>
						<input type="submit" name="deletea" value="Delete"></input><br><br>
					</form>
					<?php
						if(isset($_POST["deletea"]))
						{
							$dbserver="localhost";
							$dbusername="root";
							$dbpassword="";
							$dbname="cms";
							$conn= new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
							$qry = "DELETE FROM articles WHERE id=".$_POST["dida"];
							if ($conn->query($qry) === TRUE)
							{
								echo "<script>alert('Notification successfully deleted!')</script>";
							} 
							else
							{
								echo "<script>alert('Error: ". $conn->error."')</script>";
							}
							$conn->close();
						}
					?>
				</section>
			</section>
		</section>
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
                // Get the modal

        var modalparent = document.getElementsByClassName("modal_multi");

        // Get the button that opens the modal

        var modal_btn_multi = document.getElementsByClassName("myBtn_multi");

        // Get the <span> element that closes the modal
        var span_close_multi = document.getElementsByClassName("close_multi");

        // When the user clicks the button, open the modal
        function setDataIndex() {

            for (i = 0; i < modal_btn_multi.length; i++)
            {
                modal_btn_multi[i].setAttribute('data-index', i);
                modalparent[i].setAttribute('data-index', i);
                span_close_multi[i].setAttribute('data-index', i);
            }
        }



        for (i = 0; i < modal_btn_multi.length; i++)
        {
            modal_btn_multi[i].onclick = function() {
                var ElementIndex = this.getAttribute('data-index');
                modalparent[ElementIndex].style.display = "block";
            };

            // When the user clicks on <span> (x), close the modal
            span_close_multi[i].onclick = function() {
                var ElementIndex = this.getAttribute('data-index');
                modalparent[ElementIndex].style.display = "none";
            };

        }

        window.onload = function() {

            setDataIndex();
        };

        window.onclick = function(event) {
            if (event.target === modalparent[event.target.getAttribute('data-index')]) {
                modalparent[event.target.getAttribute('data-index')].style.display = "none";
            }

            // OLD CODE
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };

//XXXXXXXXXXXXXXXXXXXXXXX    Modified old code    XXXXXXXXXXXXXXXXXXXXXXXXXX

// Get the modal

        var modal = document.getElementById('myModal');

// Get the button that opens the modal
        var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
        var span = modal.getElementsByClassName("close")[0]; // Modified by dsones uk

// When the user clicks on the button, open the modal

        btn.onclick = function() {

            modal.style.display = "block";
        }

// When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }



	</script>
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