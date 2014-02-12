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
    <div class="container">

        <div class="row">
            <div class="col-lg-8">

                <!-- the actual blog post: title/author/date/content -->
                <h1>ข้อมูลของสถานที่ท่องเที่ยว <?php echo $tour[0]->Tour_attr_name ?></h1>
                <div class='movie_choice'>
                    Rate: <?php echo $tour[0]->Tour_attr_name ?>
                    <div id="r1" class="rate_widget">
                        <div class="star_1 ratings_stars"></div>
                        <div class="star_2 ratings_stars"></div>
                        <div class="star_3 ratings_stars"></div>
                        <div class="star_4 ratings_stars"></div>
                        <div class="star_5 ratings_stars"></div>
                        <div class="total_votes">vote data</div>
                    </div>
                </div>
                <hr>
                    <?php 
                    header('Content-type: image/jpeg');
                    if(is_null($tour[0]->Tour_pic)) echo '<img src="http://placehold.it/900x300" class="img-responsive">';
                          else echo $tour[0]->Tour_pic;  ?>
                
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('.ratings_stars').hover(
                // Handles the mouseover
                function() {
                    $(this).prevAll().andSelf().addClass('ratings_over');
                    $(this).nextAll().removeClass('ratings_vote'); 
                },
                // Handles the mouseout
                function() {
                    $(this).prevAll().andSelf().removeClass('ratings_over');
                    set_votes($(this).parent());
                }
            );
        });
        
    </script>

</body>

</html>
