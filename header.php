<?php
	include('config.php');
	session_start();
	date_default_timezone_set('Asia/Kolkata');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>EL BookMyShow</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="all" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/nav-bar.css">
		<script src='js/nav.js'></script>
	</head>
	<body>
		<nav class="navbar navbar-expand-custom navbar-mainbg" style="border:none; border-radius:0;">
			<a href="index.php"><img src="images/t-logo.png" alt="Logo Image Here" style='width:400px; margin-left:35%'/></a>
			<button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fas fa-bars text-white"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
					<div class="hori-selector"><div class="left"></div><div class="right"></div></div>
					<li class="nav-item">
						<a class="nav-link" href=""><i class="fas fa-tachometer-alt"></i></a>
					</li>
					<li class="nav-item active" id='nav1'>
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item" id='nav2'>
						<a class="nav-link" href="movies_events.php">Movies List</a>
					</li>
					<li class="nav-item"  id='nav3'>
						<?php if(isset($_SESSION['user'])){
							$us=mysqli_query($con,"select * from tbl_registration where user_id='".$_SESSION['user']."'");
							$user=mysqli_fetch_array($us);
						?>
						<a href="profile.php" class="nav-link"><?php echo $user['name'];?></a>
					</li>
					<li class="nav-item"  id='nav4'>
						<a href="logout.php" class="nav-link">Logout</a>
					</li>
					<li class="nav-item" id='nav5'>
						<?php }else{?><a href="login.php" class="nav-link">Login</a>
					</li>
					<li class="nav-item" id='nav6'>
						<a href="registration.php" class="nav-link">Register</a><?php }?>
					</li>
					<li class="nav-item" id='nav7'>
						<a href="about_us.php" class="nav-link">About Us</a>
					</li>
				</ul>
				<div style="width:400px"></div>
				<div class="clear"></div>	
				<form action="process_search.php" id="reservation-form" method="post" onsubmit="myFunction()">
					<fieldset>
						<div class="field" >
							<input type="text" placeholder="Enter A Movie Name" class='searchbarfeild' required id="search111" name="search">	
							<input type="submit" value="Search" class='searchbarbtn' id="button111">
						</div>       	
					</fieldset>
				</form>
			</div>
		</nav>
		<script>
			function myFunction() {
				if($('#hero-demo').val()==""){
					alert("Please enter movie name...");
					return false;
				}
				else{
					return true;
				}
			}
		</script>
	</body>
</html>