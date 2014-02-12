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
					<td><b>หมายเลขสถานที่ท่องเที่ยว</b></td>
					<td><b>ชื่อ</b></td>
					<td><b>รายละเอียด</b></td>
					<td><b>การท่องเที่ยว</b></td>
					<td><b>เว็บไซด์</b></td>
				  </tr>";
			
			foreach ($data as $tour) {
				echo "<tr>
						<td><a href='tour/" . $tour->Tour_attr_id . "'>" . $tour->Tour_attr_id . "</a></td>
						<td><a href='tour/" . $tour->Tour_attr_id . "'>" . $tour->Tour_attr_name . "</a></td>
						<td class='word-wrap-50'>" . substr($tour->Description, 0, 800) . "..." . "</td>
						<td>" . substr($tour->Transportation, 0, 500) . "..." . "</td>
						<td><a href='http://" . $tour->Tour_web . "'>" . $tour->Tour_web . "</a></td>
				  	  </tr>";
			}
		}
		 ?>
	</table>
</body>
</html>