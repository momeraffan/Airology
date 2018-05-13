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
</head>
<body>
	<header>
		<h1>ADMIN PANEL</h1>
	</header>
	<nav>
		<section>
		<?php
			if($_SESSION['adminid']==1)
			{
				echo '<a href="edithomepage.php" class="block">Edit Home Page</a>
					<br><br><br><br>
					<a href="#" class="block">Edit About Page</a>
					<br><br><br><br>
					<a href="#" class="block">Edit Vision Page</a>
					<br><br><br><br>
					<a href="#" class="block">Edit Sessions Page</a>
					<br><br><br><br>
					<a href="#" class="block">Edit Contact Page</a>
					<br><br><br><br>
					<a href="#" class="block">Edit Services Page</a>
					<br><br><br><br>
					<a href="editadmins.php" class="block">Edit Admins</a>
					<br><br><br><br>';
			}
			else
			{
				echo '<a href="edithomepage.php" class="block">Edit Home Page</a>
					<br><br><br><br>
					<a href="#" class="block">Edit Sessions Page</a>
					<br><br><br><br>';
			}
		?>
			<a href="signout.php" class="block">Sign Out</a>
		</section>
	</nav>
	<footer>
		Want more customization?
		<br>
		Contact the developer:
		Muhammad Omer Affan
		+923333346061
		omeraffan@outlook.com
		<br>
		*Charges will be applied for further customization*
	</footer>
</body>
</html>