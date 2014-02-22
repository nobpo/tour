<html>
<head>
	<title>Searching Result!</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
</head>
<body>
	
		<?php 
			if(isset($notify))
				echo "<p class='alert' style='margin:20px'>" . $notify . "</p>" ;
		 ?>
	
	<table class="table" style="margin: 20px">
		<?php 
		if(isset($data)){
			echo "<tr>
					<td><b>หมายเลขโรงแรม</b></td>
					<td><b>ชื่อ</b></td>
					<td><b>รูปภาพ</b></td> 
					<td><b>แผนที่</b></td>
					
					<td><b>เว็บไซด์</b></td>
				  </tr>";
			
			foreach ($data as $hotel) {
				echo "<tr>
						<td>" . $hotel->Hotel_id . "</td>
						<td>" . $hotel->Hotel_name . "</td>
						<td><img src='".$hotel->Hotel_pic."'/></td>
						<td><a href='http://maps.google.com/maps?q=". $hotel->Hotel_lat . ",". $hotel->Hotel_long . "'>คลิกเพื่อดูแผนที่</a></td>
						
						<td><a href='http://" . $hotel->Hotel_web . "'>" . $hotel->Hotel_web . "</a></td>
				  	  </tr>";
			}
		}
		 ?>
	</table>
</body>
</html>