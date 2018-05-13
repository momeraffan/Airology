<?php
	session_start();
	if(isset($_SESSION['adminid']))
	{
		echo "<script>alert('Already logged in...')</script>";
		echo "<script>location.href = 'adminhome.php'</script>";
	}
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Airology/login</title>
      <link rel="stylesheet" href="css/style.css">
	  <script type="text/javascript">
		function goto()
		{
			location.href = "homepage.html";
		}
	  </script>
</head>

<body>
<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700' rel='stylesheet' type='text/css'>

<div class="container">
  <div class="profile">
    <button class="profile__avatar" id="toggleProfile">
     <img src="pic.png" alt="Avatar" /> 
    </button>
    <div class="profile__form">
      <div class="profile__fields">
	  <form action="signin.php" method="POST">
        <div class="field">
          <input type="text" id="fieldUser" name="username" class="input" required pattern=.*\S.* />
          <label for="fieldUser" class="label">Username</label>
        </div>
        <div class="field">
          <input type="password" id="fieldPassword" name="password" class="input" required pattern=.*\S.* />
          <label for="fieldPassword" class="label">Password</label>
        </div>
        <div class="profile__footer">
          <input type="submit" class="btn" value="submit" name="submit" />
        </div>
		</form>
      </div>
     </div>
	 <button class="btn" style="width:100%" onclick="goto()">Go back to website</button>
  </div>
</div>
    <script  src="js/index.js"></script>
</body>

</html>
