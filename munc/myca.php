<?php 

include('include.php');
?>
<?php 
include('page_that_has_to_be_included_for_every_user_visible_page.php');
?>
<?php
$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$url = "http://freegeoip.net/json/".$ip;
$ch  = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);

if ($data) {
    $location = json_decode($data);

    $lat = $location->latitude;
    $lon = $location->longitude;

    $sun_info = date_sun_info(time(), $lat, $lon);
}else{
	die('Please Reload');
}
##
$dist = 25;
##
?>
<?php

if($login == 1){
	if(trim($_USER['lum_ad']) == 1){
		$admin = 1;
	}else{
		$admin = 0;
	}
}else{
	$admin = 0;
	
}

?>
<!DOCTYPE html>
<html lang="en">
    
<!-- the manprofile.htmlby ayan ahmad 07:31:23 GMT -->
<head>
        <?php get_head(); ?>
    <!-- Dropzone css -->
    <link href="assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />

<style>
.mini-stat{
	border:1px solid black;
}
</style>
    </head>


    <body>

        <!-- Aside Start-->
        <aside class="left-panel">

           <?php
		give_brand();
		?>
            <?php 
			get_modules($conn,$login,$admin);
			?>
                
        </aside>
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <header class="top-head container-fluid">
                <button type="button" class="navbar-toggle pull-left">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Search -->
                <form action="home.php" method="post" role="search" class="navbar-left app-search pull-left hidden-xs ">
                  <input name="mun_search" type="text" placeholder="Search MUNS..." class="form-control">
                  <a href="#"><i class="fa fa-search"></i></a>
                </form>
                
                <!-- Left navbar -->
                <nav class=" navbar-default" role="navigation">
                    

                    <!-- Right navbar -->
                     <?php
                    if($login==1){
						include('ifloginmodalsection.php');
					}
					?>
                    
                    <!-- End right navbar -->
                </nav>
                
            </header>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="bg-picture" style="background-image:url('<?php echo $_USER['usr_back_pic'] ?>')">
                          <span class="bg-picture-overlay"></span><!-- overlay -->
                          <!-- meta -->
                          <div class="box-layout meta bottom">
                            <div class="col-sm-6 clearfix">
                              <span class="img-wrapper pull-left m-r-15"><img src="<?php echo $_USER['usr_prof_pic'] ?>" alt="" style="width:64px" class="br-radius"></span>
                              <div class="media-body">
                                <h3 class="text-white mb-2 m-t-10 ellipsis"><?php echo ucwords($_USER['usr_name'] )?></h3>
                                <h5 class="text-white"><?php echo $_USER['lum_username'] ?></h5>
                              </div>
                            </div>
                           <?php /*
 <div class="col-sm-6">

                              <div class="pull-right">
                                <div class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle btn btn-primary" href="#"> Following <span class="caret"></span></a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Poke</a></li>
                                        <li><a href="#">Private message</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Unfollow</a></li>
                                    </ul>
                                </div>
                              </div>
                            </div> */ ?>

                          </div>
                          <!--/ meta -->
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-sm-12">
                        <div class="panel panel-default p-0">
                            <div class="panel-body p-0"> 
                                <ul class="nav nav-tabs profile-tabs">
                                    <li class="active"><a data-toggle="tab" href="#aboutme">About Me</a></li>
                                    <li class=""><a data-toggle="tab" href="#user-activities">Current Activity</a></li>
                                    <li class=""><a data-toggle="tab" href="#edit-profile">Settings</a></li>
                                    <li class=""><a data-toggle="tab" href="#projects">Attending MUNs</a></li>
                                </ul>

                                <div class="tab-content m-0"> 

                                    <div id="aboutme" class="tab-pane active">
                                    <div class="profile-desk">
                                        <h3><?php echo ucwords($_USER['usr_name'] )?></h3>
                                        <span class="designation">Member Since <strong>
										<?php echo date('M, Y',$_USER['usr_reg_dnt'] )?></strong></span>
                                       
                                       
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <th colspan="3"><h3> Information</h3></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><b>Country</b></td>
                                                    <td>
                                                        <?php echo ucwords($_USER['usr_reg_country'] )?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Email</b></td>
                                                    <td>
                                                        <?php echo ($_USER['lum_email'] )?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Date of Birth</b></td>
                                                    <td><?php echo date('D jS M, Y',$_USER['usr_dob_timestamp'] )?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Username</b></td>
                                                    <td>
                                                   <?php echo ($_USER['lum_username'] )?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end profile-desk -->
                                </div> <!-- about-me -->


                                <!-- Activities -->
                                <div id="user-activities" class="tab-pane">
                                    <div class="timeline-2">
                                    
                                        <?php
$getlogssql = "SELECT * FROM page_views where pg_visit_hash = '".$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']."' and 
pg_v_valid =1";
$getlogsres= $conn->query($getlogssql);
if ($getlogsres->num_rows > 0) {
    // output data of each row
    while($getlogsrw = $getlogsres->fetch_assoc()) {
        echo '
		<div class="time-item">
                                            <div class="item-info">
                                                <div class="text-muted">'.
												time_elapsed_string($getlogsrw['pg_dnt']).'</div>
                                                <p>You visited <a href="#" class="text-info">'.$getlogsrw['pg_name'].'</a> .</p>
                                            </div>
											</div>

		';
    }
} else {
    
}
 ?> 
                                        
                                        
                                        
                                    </div>
                                </div>

                                <!-- settings -->
                                <div id="edit-profile" class="tab-pane">
                                    <div class="user-profile-content">
                                    
                                    
                                     <div class="row">
                                     
                                     
					<div class="col-md-4">
                        <div style="cursor:pointer" data-toggle="modal" data-target="#chDet" class="mini-stat clearfix">
                            <span class="mini-stat-icon bg-info"><i class="fa fa-list"></i></span>
                            <div class="mini-stat-info text-right">
                              <h3>  Change Details</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div style="cursor:pointer" data-toggle="modal" data-target="#chPass" class="mini-stat clearfix">
                            <span class="mini-stat-icon bg-info"><i class="fa fa-asterisk "></i></span>
                            <div class="mini-stat-info text-right">
                             <h3> Change Password</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="cursor:pointer" data-toggle="modal" data-target="#chProfPic" class="mini-stat clearfix">
                            <span class="mini-stat-icon bg-info"><i class="fa fa-file-image-o"></i></span>
                            <div class="mini-stat-info text-right">
                              <h3>  Change Profile Picture</h3>
                            </div>
                        </div>
                    </div>
                   
                    
                </div> <!-- end row -->
                                    <script>
									function GotoPg( a){
										window.location = a;
									}
</script>
                                    
                                    
                                    
                                        
                                    </div>
                                </div>


                                <!-- profile -->
                                <div id="projects" class="tab-pane">
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="portlet"><!-- /primary heading -->
                                                <div id="portlet2" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>MUN Name</th>
                                                                        <th>Start Date</th>
                                                                        <th>End Date</th>
                                                                        <th>Status</th>
                                                                        <th>MUN Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   <?php
$getmunssql = "SELECT * FROM `mun_attend` ma left join mun_rec rc on
	ma.at_rel_mun_id = rc.mun_id
  where at_rel_usr_id = '".$_SESSION['MUNC_USR_DB_ID']."' and at_valid =1 and mun_valid =1";
$getmunsres= $conn->query($getmunssql);
if ($getmunsres->num_rows > 0) {
    // output data of each row
	$rrt = 1;
    while($getmunsrw = $getmunsres->fetch_assoc()) {
		
        echo '
		<tr>
                                                                        <td>'.$rrt.'</td>
                                                                        <td>'.ucwords($getmunsrw['mun_shortname']).'</td>
                                                                        <td>'.date('d/m/y',trim($getmunsrw['mun_from'])).'</td>
                                                                        <td>'.date('d/m/y',trim($getmunsrw['mun_till'])).'</td>
                                                                        <td>&nbsp;<span class="label label-success">&nbsp; &nbsp; &nbsp;</span></td>';
                                                                      
																		
																		if(time()> $getmunsrw['mun_till']){
																			#mun over
																			echo '  <td><span class="label label-danger">MUN Finshed</span></td>';
																		}
																		else if((time() > $getmunsrw['mun_from']) and (time() <$getmunsrw['mun_till'])){
																			#on goinf
																			echo '  <td><span class="label label-info">MUN Ongoing</span></td>';
																		
																		} else if((time() < $getmunsrw['mun_from'])){
																			#upcming
																			echo '  <td><span class="label label-primary">MUN Upcoming </span></td>';
																		}
																		echo '
                                                                        
                                                                    </tr>

		';
    
	$rrt++;}
} else {
    
}
 ?> 
                       
                                                                    
                                                                  
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /Portlet -->
                                        </div>
                                    </div>
                                </div>
                            </div>
             
                        </div> 
                    </div>
                </div>
            </div>

            

            


        </div>

        <!-- Page Content Ends -->
        <!-- ================== -->

        <!-- Footer Start -->
        <footer class="footer">
          <?php auto_copyright(); // Current year?>

 The MUN Circuit.
        </footer>
        <!-- Footer Ends -->



    </section>
    <!-- Main Content Ends -->
        

<div id="chDet" class="modal fade" role="dialog" >
                                    <div class="modal-dialog modal-full">
                                    <form action="master_action.php" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="full-width-modalLabel">Change Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                            <div class="form-group">
                                                <label for="unn">Full Name</label>
                                                <input type="text" value="<?php echo $_USER['usr_name'] ?>" id="unn" name="ch_usr_name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input type="email" disabled value="<?php echo $_USER['lum_email'] ?>" id="Email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="Username">Username</label>
                                                <input type="text" value="<?php echo $_USER['lum_username'] ?>" id="Username" class="form-control">
                                            </div>
                                          <div class="form-group">
                                                <label for="datepicker">Date of Birth</label>
                                                 <div class="input-group">
                                    <input name="usr_dob" type="text" class="form-control" placeholder="mm/dd/yyyy" value="<?php echo date('m/d/Y',$_USER['usr_reg_dnt'])?>" id="datepicker">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div><!-- input-group -->
                                            </div>
<input type="hidden" name="ch_det" value="<?php echo md5(sha1(time()).uniqid().md5('Hola')) ?>" />                                           
                                           
                                        </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                        </form>
                                    </div><!-- /.modal-dialog -->
                                </div>
                                
                                
                                <div id="chPass" class="modal fade" role="dialog" >
                                    <div class="modal-dialog modal-full">
                                    <script type="text/javascript" language="JavaScript">
function checkMe(theForm) {
    if (theForm.pw.value != theForm.npw.value)
    {
        alert('Those passwords don\'t match!');
        return false;
    } else {
        return true;
    }
}
//-->

</script> 

                                      <form action="master_action.php" method="post" id="gromf" onsubmit="return checkMe(this);">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="full-width-modalLabel">Change Password</h4>
                                            </div>
                                            <div class="modal-body">
                                              
                                            
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input name="pw" type="password" required placeholder="Enter new Password" id="Password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="RePassword">Re-Password</label>
                                                <input name="npw" type="password" required placeholder="Re enter New Password" id="RePassword" class="form-control">
                                            </div>
                                       
                                            </div>
                                            <div class="modal-footer">
                                            <input type="hidden" name="ch_pw" value="<?php echo md5(uniqid().uniqid()) ?>"/>
                                                <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    
                                        </form>
                                    </div><!-- /.modal-dialog -->
                                </div>
                                
                                
                                <div id="chProfPic" class="modal fade" role="dialog" >
                                    <div class="modal-dialog modal-full">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="full-width-modalLabel">Profile Picture</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                    <div class="col-md-12 portlets">
                        <!-- Your awesome content goes here -->
                        <div class="m-b-30">
                            <form  action="master_action.php" method="post" enctype="multipart/form-data" >
                              <div class="fallback">
                                  <label class="btn btn-default btn-file">
        Browse <input name="ch_imgg" type="file" accept="image/*" onchange="loadFile(event)" style="display: none;">
    </label>
    
    <br><br>
<br>

<input id="upld_i" class="hidden btn btn-sucess" type="submit" name="ch_img" value="Click to Upload" />
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4">
        	<img class="img-responsive" id="output"/>
        </div>
    </div>
    <script>
	  var loadFile = function(event) {
		var reader = new FileReader();
		reader.onload = function(){
		  var output = document.getElementById('output');
		  output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
		$('#upld_i').removeClass('hidden');
		
	  };
    </script>                           

			
                              </div>
                             
                              
                             
                            </form>
                        </div>
                    </div>
                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                                
                                
                                


   <?php  
	  get_end_script();
	  ?>
<?php /*
       <!-- google maps api -->
               <!-- Page Specific JS Libraries -->
           <script>
	
 function initMap() {


var myLatLng = {lat: <?php echo $_USER['usr_lat'] ?>, lng: <?php echo $_USER['usr_long'] ?>};

        var map = new google.maps.Map(document.getElementById('googleMap'), {
          zoom: 1,
          center: myLatLng
        });

       var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    draggable:true,
    title:"Choose Location!"
});

//get marker position and store in hidden input
google.maps.event.addListener(marker, 'dragend', function (evt) {
    document.getElementById("latInput").value = evt.latLng.lat().toFixed(3);
    document.getElementById("lngInput").value = evt.latLng.lng().toFixed(3);
});

 }
</script>
        <script async defer src="http://maps.google.com/maps/api/js?key=AIzaSyBcrfT9j4-LebvmWHyc27iKL0d13EbBObQ&callback=initMap"></script>
        */
        ?>
<?php /*
 <script src="assets/timepicker/bootstrap-datepicker.js"></script> */ ?>


      <script>

            $(document).ready(function() {
                    
        
                $('#datepicker').datepicker({
    
});
				
				

			});
			
      </script>
 
  </body>

<!-- the manprofile.htmlby ayan ahmad 07:31:23 GMT -->
</html>
