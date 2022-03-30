<?php include('header.php');
	if(!isset($_SESSION['user'])){
		header('location:login.php');
	}
?>
<script>
	document.getElementById("nav1").className = "nav-item"; 
	document.getElementById("nav2").className = "nav-item";
	document.getElementById("nav3").className += "active"; 
	document.getElementById("nav4").className = "nav-item"; 
	document.getElementById("nav5").className = "nav-item"; 
	document.getElementById("nav6").className = "nav-item"; 
	document.getElementById("nav7").className = "nav-item"; 
</script>
<div class="content">
	<div class="wrap">
		<div class="content-top">
			<div class="section group" style='height:500px;'>
				<h1 style='color:black'>User Profile</h1>
				<img src='images/user.jpg' style='margin-left:300px; margin-top:50px; border-radius:20px'>
			</div>	
		</div>
	</div>
</div>
<?php include('footer.php');?>