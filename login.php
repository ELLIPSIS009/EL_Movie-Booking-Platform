<?php include('header.php');?>
</div>
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
		<div class="content-top" style="min-height:300px;padding:50px">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
				  <div class="panel-heading">Login</div>
				  <div class="panel-body">
				  	<?php include('msgbox.php');?>
				<p class="login-box-msg">Sign in to start your session</p>
				<form action="process_login.php" method="post">
      <div class="form-group has-feedback">
        <input name="Email" type="text" size="25" placeholder="Email" class="form-control" placeholder="Email"/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="Password" type="password" size="25" placeholder="Password" class="form-control" placeholder="Password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group">
          <button type="submit" class="btn btn-primary">Login</button>
 
          <p class="login-box-msg" style="padding-top:20px">New Here? <a href="registration.php">Register</a></p>
      </div>
      </div>
</div>
    </form>
			</div>
		</div>
		<div class="clear"></div>	
		
	</div>
<?php include('footer.php');?>
</div>