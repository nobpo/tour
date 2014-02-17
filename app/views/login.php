<html>
<head>
	<title>Tourist Attraction</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<?php 
		echo Session::get('notify') ? "<p class='alert'>" . Session::get('notify') . "</p>" : "" ;
		if(Auth::check()) echo "<a href='/logout'>ออกจากระบบ</a>";
		//var_dump(Auth::check());
	 ?>
	 <div class="navbar navbar-inverse">
  		Tourist Attraction Webpage
     </div>
	<div style="height:50px"></div>
	<form class="form-horizontal" method="POST" action="login">
	  <div class="control-group">
	    <label class="control-label" for="username">Username</label>
	    <div class="controls">
	      <input type="text" id="username" name="username" placeholder="Username">
	    </div>
	  </div>
	  <div class="control-group">
	    <label class="control-label" for="password">Password</label>
	    <div class="controls">
	      <input type="password" id="password" name="password" placeholder="Password">
	    </div>
	  </div>
	  <div class="control-group">
	    <div class="controls">
	      
	      <button type="submit" class="btn">Sign in</button>
	      <br><br>
	      <a href="reg">ลงทะเบียน</a>
	    </div>
	  </div>
	</form>
</body>
</html>