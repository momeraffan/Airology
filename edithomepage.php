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
	<link rel="stylesheet" href="timeline.css">
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
					<a href="#">Edit Vision Page</a>
					<a href="#">Edit Sessions Page</a>
					<a href="#">Edit Contact Page</a>
					<a href="#">Edit Services Page</a>
					<a href="editadmins.php">Edit Admins</a>';
			}
			else
			{
				echo '<a href="adminhome.php">Admin Panel</a>
					<a href="#">Edit Sessions Page</a>';
			}
		?>
		
		<a href="signout.php" style="float:right">Sign Out</a>
		</section>
	</nav>
	<footer></footer>
</body>
</html>