<html>
<head>
	<title>Tourist Attraction</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>

<style type="text/css"> 
body  
{ 
background-image : url('http://www.hdwallpapersplus.com/wp-content/uploads/2012/10/maldives_sea_wallpaper_25633.jpg'); 
background-repeat : no-repeat; 
background-attachment : fixed 
} 
</style> 
   


</head>
<body>
	<?php 
		echo Session::get('notify') ? "<p class='alert'>" . Session::get('notify') . "</p>" : "" ;

		//var_dump(Session::get('user'));
		//var_dump(Auth::check());
		
		//var_dump(Session::get('user'));
		
	 ?>
	 <div class="navbar navbar-inverse"> 
  
     </div> 
<center> 
     <a href="index.php" target=_blank><img src="http://localhost/tourist_attraction/public/img/banner.jpg" border=0 height=300 width=900 alt="ข้อความ"></a> 
 </center> 
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
<center> 
<div class="container-menu"> 
<div class="row">  
<div class="span8">    
<ul class="nav nav-pills nav-justified"> 
    <li class="active"><a href='index.php'>Home</a></li> 
    <li><a href="login">Log in</a></li> 
    <li><a href="#">Tourist Attraction</a></li> 
    <li><a href="hotel">Hotel</a></li> 
    <li><a href="restaurant">Restaurant</a></li> 
    <li><a href="#">Contact us</a></li> 
</ul> 
</div> 
</div> 
</div> 
</center> 

<div style="clear:both; height: 10px"></div> 
  
<div class="row"> 
<div class="span3"; style="margin:0px 0px 20px 300px; width:150px"> 
	<?php 
		if(!Session::get('user')) echo '
			<a href="login">
			<button class="btn btn-primary" style="width:200px">เข้าสู่ระบบ</button>
			</a>';
		else {
			$user = Session::get('user');
			echo '<h3>ยินดีต้อนรับ คุณ '. $user->name_first . ' ' . $user->name_last . '</h3>';
			echo "<a href='logout' style='color:white'>ออกจากระบบ</a>";
		}

	?>
	
	</div> 


<div style="clear:both; height: 10px"></div>

<div class="container-right1"> 

<div class="span5
">
	<h4 style="width: 600px; margin-left: 0px;">ค้นหาสถานที่ท่องเที่ยว</h4>
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

		<select name="type" id="type">
			<option value="0" selected>ทุกอย่าง</option>
			<option value="N">ธรรมชาติ</option>
			<option value="M">พิพิธภัณฑ์</option>
			<option value="S">แหล่งช็อปปิ้ง</option>
			<option value="A">ผจญภัย</option>
			<option value="T">วัด</option>
			
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

		<br>
	<iframe marginWidth=0 marginHeight=0 src="http://www.bangkokbank.com/fxbanner/banner1.htm" frameBorder=0 width=173 scrolling=no height=165></iframe>
	</br>
	</form>
</div>
</div>
<center> 
<div style="clear:both; height: 100px"></div>
<h4 style="width: 900px; margin-left: 20px;">เผื่อท่านชอบ</h4>

<div class="row-fluid" style="width: 900px; margin:20px;">
	<?php 
		$data = DB::table('tourrist_attrac')->orderBy('Tour_attr_id')->get();
	?>
	<div class="span4" style="background-color: rgb(230,230,230); border: 2px solid gray; border-radius:5px; padding: 5px; height: 300px">
		<?php 
			$num = rand(0, sizeof($data)-1);
			echo "<a href='tour/". $data[$num]->Tour_attr_id ."'><h5>" . $data[$num]->Tour_attr_name . "</h5></a>";
			echo substr($data[$num]->Description, 0, 1000) . "..."; 
		?>
	</div>
	<div class="span4" style="background-color: rgb(230,230,230); border: 2px solid gray; border-radius:5px; padding: 5px; height: 300px">
		<?php 
			$num = rand(0, sizeof($data)-1);
			echo "<a href='tour/". $data[$num]->Tour_attr_id ."'><h5>" . $data[$num]->Tour_attr_name . "</h5></a>";
			echo substr($data[$num]->Description, 0, 1000) . "..."; 
		?>
	</div>
	<div class="span4" style="background-color: rgb(230,230,230); border: 2px solid gray; border-radius:5px; padding: 5px; height: 300px">
		<?php 
			$num = rand(0, sizeof($data)-1);
			echo "<a href='tour/". $data[$num]->Tour_attr_id ."'><h5>" . $data[$num]->Tour_attr_name . "</h5></a>";
			echo substr($data[$num]->Description, 0, 1000) . "..."; 
		?>
	</div>

</div>
</center> 
<center> 
<div style="clear:both; height: 100px"></div>
<h4 style="width: 900px; margin-left: 20px;">ฮิตที่สุด</h4>

<div class="row-fluid" style="width: 900px; margin:20px;">
	<?php 
		$rank = DB::table('rate_tour')->orderBy('total_point', 'desc')->lists('Tour_attr_id');
	?>
	<div class="span4" style="background-color: rgb(230,230,230); border: 2px solid gray; border-radius:5px; padding: 5px; height: 300px">
		<?php 			
			echo "<a href='tour/". $data[$rank[0]-1]->Tour_attr_id ."'><h5>" . $data[$rank[0]-1]->Tour_attr_name . "</h5></a>";
			echo substr($data[$rank[0]-1]->Description, 0, 1000) . "..."; 
		?>
	</div>
	<div class="span4" style="background-color: rgb(230,230,230); border: 2px solid gray; border-radius:5px; padding: 5px; height: 300px">
		<?php 
			echo "<a href='tour/". $data[$rank[1]-1]->Tour_attr_id ."'><h5>" . $data[$rank[1]-1]->Tour_attr_name . "</h5></a>";
			echo substr($data[$rank[1]-1]->Description, 0, 1000) . "..."; 
		?>
	</div>
	<div class="span4" style="background-color: rgb(230,230,230); border: 2px solid gray; border-radius:5px; padding: 5px; height: 300px">
		<?php 
			echo "<a href='tour/". $data[$rank[2]-1]->Tour_attr_id ."'><h5>" . $data[$rank[2]-1]->Tour_attr_name . "</h5></a>";
			echo substr($data[$rank[2]-1]->Description, 0, 1000) . "..."; 
		?>
	</div>

</div>
</center> 

</body>

</html>