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
		if(Auth::check()) echo "<a href='logout'>ออกจากระบบ</a>";
		//var_dump(Auth::check());
		
		//var_dump(Session::get('user'));
		
	 ?>
	 <div class="navbar navbar-inverse">
  Tourist Attraction Webpage
     </div>
	<div style="height:50px"></div>
	<!-- <form class="form-horizontal" method="POST" action="login">
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
	</form> -->
<div class="span4">
	<?php 
		if(!Auth::check()) echo '
			<a href="login">
			<button class="btn btn-primary" style="width:200px">เข้าสู่ระบบ</button>
			</a>';
		else echo '<h3>ยินดีต้อนรับ คุณ '. Auth::user()->name_first . ' ' . Auth::user()->name_last . '</h3>'
	?>
	
</div>

<div style="clear:both; height: 100px"></div>

<div class="span8">
	<form method="POST" style="font-family:thai-san">
		<select name="region" id="region">
			<option value="0" selected>ทุกภาค</option>
			<option value="N">ภาคเหนือ</option>
			<option value="NE">ภาคอีสาน</option>
			<option value="C">ภาคกลาง</option>
			<option value="E">ภาคตะวันออก</option>
			<option value="W">ภาคตะวันตก</option>
			<option value="S">ภาคใต้</option>
		</select>
		<br>
		<select name="province" id="province">
			<option value="0">ทุกจังหวัด</option>
		</select>
		<br>
		<select name="district" id="district">
			<option value="0">ทุกอำเภอ</option>
		</select>
		<br>
		<a href="#" name="link-ad" id="link-ad">Advance Search!</a>
		<div class="add-search">
			<b>ต้องมีสิ่งต่อไปนี้</b>
			<br>
			<?php 
				$add = DB::table('additional')->get();
				foreach ($add as $key) {
					echo "<input type='checkbox' name='add" . $key->Add_id . "' value='" . $key->Add_id . "'> " . $key->Add_name . "<br>";
				}
			?>
		</div>
		<input type="submit" value="Search!">
	</form>
</div>

<div style="clear:both; height: 100px"></div>
<h4 style="width: 900px; margin-left: 20px;">เผื่อท่านชอบ</h4>
<hr styld="width: 900px">
<div class="row-fluid" style="width: 900px; margin:20px;">
	<?php 
		$data = DB::table('tourrist_attrac')->get();
	?>
	<div class="span4" style="background-color: rgb(230,230,230); border: 2px solid gray; border-radius:5px; padding: 5px; height: 300px">
		<?php 
			$num = rand(0, sizeof($data));
			echo "<a href='tour/". $data[$num]->Tour_attr_id ."'><h5>" . $data[$num]->Tour_attr_name . "</h5></a>";
			echo substr($data[$num]->Description, 0, 1000) . "..."; 
		?>
	</div>
	<div class="span4" style="background-color: rgb(230,230,230); border: 2px solid gray; border-radius:5px; padding: 5px; height: 300px">
		<?php 
			$num = rand(0, sizeof($data));
			echo "<a href='tour/". $data[$num]->Tour_attr_id ."'><h5>" . $data[$num]->Tour_attr_name . "</h5></a>";
			echo substr($data[$num]->Description, 0, 1000) . "..."; 
		?>
	</div>
	<div class="span4" style="background-color: rgb(230,230,230); border: 2px solid gray; border-radius:5px; padding: 5px; height: 300px">
		<?php 
			$num = rand(0, sizeof($data));
			echo "<a href='tour/". $data[$num]->Tour_attr_id ."'><h5>" . $data[$num]->Tour_attr_name . "</h5></a>";
			echo substr($data[$num]->Description, 0, 1000) . "..."; 
		?>
	</div>

</div>


</body>
</html>