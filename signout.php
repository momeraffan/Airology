<?php
	session_start();
	if(isset($_SESSION['adminid']))
	{
		session_destroy();
		echo '<script>alert("Successfully logged out...")</script>';
		echo "<script>location.href = 'login.php'</script>";
	}
	else
	{
		echo "<script>location.href = 'login.php'</script>";
	}
?>