<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" >
    
    <title>ข้อมูลของ <?php echo $tour[0]->Tour_attr_name ?></title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
	var map;
	function initialize() {
	  var mapOptions = {
	    zoom: 8,
	    center: new google.maps.LatLng(<?php echo $tour[0]->Tour_lat ?>, <?php echo $tour[0]->Tour_long ?>)
	  };
	  map = new google.maps.Map(document.getElementById('map-canvas'),
	      mapOptions);

	  var marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?php echo $tour[0]->Tour_lat ?>, <?php echo $tour[0]->Tour_long ?>),
      map: map,
      title: "<?php echo $tour[0]->Tour_attr_name ?>"
  	});
	}

	google.maps.event.addDomListener(window, 'load', initialize);

    </script>



    <!-- Add custom CSS here -->
    <!-- <link href="css/blog-post.css" rel="stylesheet"> -->
    <style type="text/css">
    #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
</head>

<body>
    
        <?php 
            echo Session::get('notify') ? "<p class='alert'>" . Session::get('notify') . "</p>" : "" ;
         ?>
    <div class="container">

        <div class="row">
            <div class="col-lg-8">
                <!-- the actual blog post: title/author/date/content -->
                <h1>ข้อมูลของสถานที่ท่องเที่ยว <?php echo $tour[0]->Tour_attr_name ?></h1>
                <a href="/tourist_attraction/public" style="float:right">กลับหน้าหลัก</a>
                <div class='movie_choice'>
                    Rate: <?php echo $tour[0]->Tour_attr_name ?>
                    <div id="<?php echo $tour[0]->Tour_attr_id; ?>" class="rate_widget">
                        <div id="1" class="star_1 ratings_stars"></div>
                        <div id="2" class="star_2 ratings_stars"></div>
                        <div id="3" class="star_3 ratings_stars"></div>
                        <div id="4" class="star_4 ratings_stars"></div>
                        <div id="5" class="star_5 ratings_stars"></div>
                        <div class="total_votes">vote data</div>
                    </div>
                </div>
                <hr>
                    <div style="text-align:center">
                    <?php 
                    header('Content-type: image/jpeg');
                    if(is_null($tour[0]->Tour_pic)) echo '<img src="http://placehold.it/900x300" class="img-responsive">';
                          else echo "<img src='".$tour[0]->Tour_pic."'/>" ;   ?>
                    </div>
                <hr>
                <p class="lead"><b>ข้อมูลเพิ่มเติม:</b></p>
                	<p><?php echo $tour[0]->Description ?></p>
                </p>
                <hr>
                <p class="lead"><b>การเดินทางมา:</b></p>
                	<p><?php echo $tour[0]->Transportation ?></p>
                </p>
                <hr>
                <p class="lead"><b>เว็บไซต์:</b></p>
                	<p><?php 
                    if($tour[0]->Tour_web == "") echo "ไม่มีข้อมูลเว็บไซต์";                    
                    else echo "<a href='http://" . $tour[0]->Tour_web . "'>" . $tour[0]->Tour_web . "</a>" ?></p>
                </p>
                <hr>
                <p class="lead"><b>โรงแรม:</b></p>
                    <p>
                        <?php 
                            $district = DB::table('in_district')->where('Tour_attr_id', $tour[0]->Tour_attr_id)->lists('District_id');
                            
                            $hotel = DB::table('hotel')->where('District_id', $district[0])->get();
                            if(sizeof($hotel)==0){
                                echo "ไม่มีข้อมูลโรงแรม";
                            }else{
                                echo "<table class='table'><tr>
                                      <th style='width:300px'>ชื่อโรงแรม</th>
                                      <th style='width:600px'>เว็บไซต์โรงแรม</th><tr>";
                                foreach ($hotel as $key) {
                                    echo "<tr><td>" . $key->Hotel_name . "</td><td><a href='http://" . $key->Hotel_web . "'>" . $key->Hotel_web . "</a></td><tr>";
                                }
                                echo "</table>";
                            }

                        ?>
                    </p>                    
                </p>
                <hr>
                <p class="lead"><b>ร้านอาหาร:</b></p>
                    <p>
                        <?php 
                            $district = DB::table('in_district')->where('Tour_attr_id', $tour[0]->Tour_attr_id)->lists('District_id');
                            
                            $rest = DB::table('Restaurant')->where('District_id', $district[0])->get();
                            if(sizeof($rest)==0){
                                echo "ไม่มีข้อมูลร้านอาหาร";
                            }else{
                                echo "<table class='table'><tr>
                                      <th style='width:300px'>ชื่อร้านอาหาร</th>
                                      <th style='width:600px'>เว็บไซต์ร้านอาหาร</th><tr>";
                                foreach ($rest as $key) {
                                    echo "<tr><td>" . $key->Rest_name . "</td><td><a href='http://" . $key->Rest_web . "'>" . $key->Rest_web . "</a></td><tr>";
                                }
                                echo "</table>";
                            }

                        ?>
                    </p>                    
                </p>


                <hr>
                <p class="lead"><b>แผนที่:</b></p>
                	<div id="map-canvas" style="height:300px"></div>
                </p>                
                <hr>
                <p class="lead"><b>ความคิดเห็น:</b></p>
                    <?php 
                        $comment = DB::table('comment')->where('Tour_attr_id', $tour[0]->Tour_attr_id)->get();
                        if(sizeof($comment) != 0){
                            echo "<table class='table'><tr>
                                  <th style='width:300px'>ผู้ใช้</th>
                                  <th style='width:600px'>ความคิดเห็น</th><tr>";
                            foreach ($comment as $key) {
                                    $user = DB::table('users')->where('id', $key->User_id)->get();
                                    $username = $user[0]->username;
                                    $time = $key->time;
                                    echo "<tr><td>" . $username . '<br><small style="font-size:75%; color:gray;">เมื่อ' . $time ;
                                    if($key->User_id==Auth::user()->id) echo "<br><a href='". $tour[0]->Tour_attr_id . "/erase/" . $key->id . "'>ลบ</a>";
                                    echo "</small></td><td>" . $key->comment . "</td><tr>";
                            }      
                            echo "</table>";
                        }else {
                            echo "<br>ไร้ความคิดเห็น";
                        }
                        echo "<hr>";

                        if(Auth::check()){
                            echo "แสดงความคิดเห็น<br><br><form method='POST'><textarea class='form-control' id='comment' name='comment' style='width:100%; font-size: 150%;' row='5'></textarea>";
                            echo "<br><input type='submit' class='btn btn-primary' value='ส่งความคิดเห็น'/></form>";
                        }else{
                            echo "กรุณาเข้าสู่ระบบก่อนแสดงความคิดเห็น";
                        }
                    ?>
                </p>                
                <hr>	
            </div>
        </div>

        

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Computer Science, Chulalongkorn University 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- JavaScript -->

    
  
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script type="text/JavaScript" src="../js/rate.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
        });
        
    </script>

</body>

</html>
