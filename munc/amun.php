
<?php 

include('include.php');
?>
<?php 
include('page_that_has_to_be_included_for_every_user_visible_page.php');
?>
<?php 
if(!isset($_GET['mun'])){
	die('Invalid Request');
}
?>
<?php

$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
if(($ip=='::1') or (strpos($ip,'192.168.1.40') === true)){
	
}
$ip="122.177.159.179";
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


$mun_iid = $_GET['mun'];
if(!ctype_alnum($mun_iid)){
	die('Invalid ID');
}

$getmun_data_sql = "SELECT *, 
    ( 6371 * acos( cos( radians(".trim($lat).") ) 
                   * cos( radians( `mun_lat` ) ) 
                   * cos( radians( `mun_long` ) 
                       - radians(".trim($lon).") ) 
                   + sin( radians(".trim($lat).") ) 
                   * sin( radians( `mun_lat` ) ) 
                 )
   ) AS distance  FROM `mun_rec` where 


md5(sha1(concat(mun_id,'HGYURBVFRBRGWIOGRU92UWHFGOIWHTOGIUEO8HG384IWGOIRHWGIUHREJFGKN'))) ='".$mun_iid."' and  mun_valid=1 ";

$MUN = array();
$getmun_data_res = $conn->query($getmun_data_sql);

if ($getmun_data_res->num_rows ==1) {
    // output data of each row
    while($getmun_data_rw = $getmun_data_res->fetch_assoc()) {
		foreach($getmun_data_rw as $sdl =>$sdr){
				 $MUN[$sdl] = trim($sdr);
			}
		
    }
} else {
	#header('Location: home.php');
   die('Invalid MUN');
}
?>
<?php

if($login == 1){
$usr_id = $_SESSION['MUNC_USR_DB_ID'];

$attono = getdatafromsql($conn,"select * from mun_attend where at_rel_usr_id= '".$usr_id."' and at_rel_mun_id = '".trim($MUN['mun_id'])."' and at_valid =1");
if(is_string($attono)){
	$attending = 0;
}else{
	$attending = 1;
}
}
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
                        <div class="bg-picture" style="background-image:url('img/AMUN_DEF.jpg')">
                          <span class="bg-picture-overlay"></span><!-- overlay -->
                          <!-- meta -->
                          <div class="box-layout meta bottom">
                            <div class="col-sm-6 clearfix">
                             
                              <div class="media-body">
                                <h3 class="text-white mb-2 m-t-10 ellipsis"><?php echo ucwords($MUN['mun_fullname'] )?></h3>
                                <h5 class="text-white"><?php echo $MUN['mun_shortname'] ?></h5>
                              </div>
                            </div>
                            <div class="col-sm-6">

                              <div class="pull-right">
                                 <?php
                    if($login==1){
					?>
                    
                    
                      
                    <?php 
					if($attending == 0){
						?>
                         <form
                                             name="accept-form"
                                             id="accept-form"
                                             action="master_action.php" method="post"> <input type="hidden" name="accept_like" value="<?php echo md5(md5(sha1(sha1($MUN['mun_id'].'oworgreijoiwnriw utki5t hkeuduiehdkhuejd1254345t')))) ?>"/>   </form>
                                    
                        <?php
					}else if ($attending == 1){
						?>
                         <form
                                             name="accept-form"
                                             id="accept-form"
                                             action="master_action.php" method="post"> <input type="hidden" name="accept_unlike" value="<?php echo md5(md5(sha1(sha1($MUN['mun_id'].'oworgreijoiwnriw utki5t hkeuduiehdkhuejd1254345t')))) ?>"/>   </form>
                        <?php
					}
					?>
                    
                    
                    
                    <div class="dropdown">
                    
                    
                    <?php 
					if($attending == 0){
						?>
                          <a data-toggle="dropdown" class="dropdown-toggle btn btn-danger" href="#">Attend it <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li>
                                            
                                            	<a onClick='document.forms["accept-form"].submit();'>Attend</a>
                                         
                                        </li>
                                       
                                    </ul>
                                    
                        <?php
					}
					 if ($attending == 1){
						?>
                          <a data-toggle="dropdown" class="dropdown-toggle btn btn-success" href="#"><i class="ion-checkmark-round"></i>Attending<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li>
                                            
                                            	<a onClick='document.forms["accept-form"].submit();'>Un Attend</a>
                                         
                                        </li>
                                       
                                    </ul>
                        <?php
					}
					?>
                                  
                                  
                                </div>
                    <?php
					}
					?>
                                
                              </div>
                            </div>
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
                                    <li class="active"><a data-toggle="tab" href="#aboutmun">About <?php echo 
									$MUN['mun_shortname'] ?></a></li>
 <li class=""><a data-toggle="tab" href="#munset">Settings</a></li>
                         </ul>

                                <div class="tab-content m-0"> 

                                    <div id="aboutmun" class="tab-pane active">
                                    <div class="profile-desk">
                                    
                                     
                                       <div class="row">
                                       	<div class="col-md-2 col-xs-6 col-xs-offset-3 col-md-offset-5">
                                        <div align="center"><img class="img-responsive" src="<?php echo $MUN['mun_img_src'] ?>" />
                                        </div>
                                        </div>
                                       </div>
                                       
                                       <br>

                                       <div class="row">
                                        <div class="col-xs-6">
                                        <div class="panel panel-color panel-inverse">
                            <div class="panel-heading"> 
                                <h3 class="panel-title"><?php echo date('jS M, Y',trim($MUN['mun_from'])); ?></h3> 
                            </div> 
                        </div>
                                        </div>
                                        
                                        <div class="col-xs-6">
                                        <div class="panel panel-color panel-inverse">
                            <div class="panel-heading"> 
                                <h3 class="panel-title"><?php echo date('jS M, Y',trim($MUN['mun_till'])); ?></h3> 
                            </div> 
                        </div>
                                        </div>
                                        </div>
                                       
									  
                                     

                                       <div class="row">
                                           <div class="col-md-6">
                                           </div>
                                           
                                           <div class="col-md-6">
                                           </div>
                                       </div>
                                        <table class="table table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td><b>Hosted At</b></td>
                                                    <td>
                                                        <?php echo ucwords($MUN['mun_hostedat'] )?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Address</b></td>
                                                    <td>
                                                        <?php echo ($MUN['mun_hosted_addr'] )?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Website</b></td>
                                                    <td><u><i><a href="<?php echo $MUN['mun_website'] ?>">
													<?php echo $MUN['mun_website']?>
                                                    </a></i></u>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Contact Number</b></td>
                                                    <td>
                                                   <?php echo ($MUN['mun_contact_no'] )?>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td><b>View on Google Maps</b></td>
                                                    <td><u><i><a target="_blank" href="https://www.google.co.in/maps/@<?php echo $MUN['mun_lat'] ?>,<?php echo $MUN['mun_long'] ?>,17z">
													<button class="btn btn-success">See in Google Maps  (approx <?php echo round($MUN['distance'],2) ?> Kms far)</button>
                                                    </a></i></u>
                                                   
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end profile-desk -->
                                </div> <!-- about-me -->


 <!-- Activities -->
                                <div id="munset" class="tab-pane">
                                    <div class="profile-desk">
                                    
                                        <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                       <?php

if($login == 1) {

#big if starts

	$checkdupes = getdatafromsql($conn,"SELECT * FROM `mun_claim_requests` WHERE `cl_rel_lum_id` = ".$_SESSION['MUNC_USR_DB_ID']." and `cl_rel_mun_id`= ".$MUN['mun_id']." and cl_valid = 1 order by cl_gen_time DESC");
	if(is_array($checkdupes)){
				##inner if starts
			if(($checkdupes['cl_gen_time'] + 86400) > time()){
			?>
			<button disabled type="button" data-toggle="tooltip" title="You have already requested to claim this mun" class="btn btn-lg btn-danger">Claim this MUN</button>
			<?php
			}
			else{
			?>
			
			<form action="master_action.php" method="post" >
			<input type="hidden" name="claim_mun" value="<?php echo md5(sha1(md5(sha1($MUN['mun_id'].'creation983ygh8t4eg8t9hg9u4eh5thr9g48etjg894je8tdjg489ejtg894je589thj84h5teh')))) ?>" />
			<button type="submit" class="btn btn-lg btn-info">Claim this MUN</button>
			</form>
			
			<?php
			
			}
			##inner if starts
			
	}
	
	else{
	?>
	<form action="master_action.php" method="post" >
	<input type="hidden" name="claim_mun" value="<?php echo md5(sha1(md5(sha1($MUN['mun_id'].'creation983ygh8t4eg8t9hg9u4eh5thr9g48etjg894je8tdjg489ejtg894je589thj84h5teh')))) ?>" />
	<button type="submit" class="btn btn-lg btn-info">Claim this MUN</button>
	</form>
	
	<?php
	}
	
	


#big if ends

}else{
	?>
	<button disabled type="button" data-toggle="tooltip" title="You must be Logged in to Claim this MUN" class="btn btn-lg btn-danger">Claim this MUN</button>
	<?php
}
										?>
                                        
                                        </div>
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        	
                                        <button data-toggle="modal" data-target="#repmun" type="submit" class="btn btn-lg btn-info">Report This MUN</button>
                                        
                                        </div>
                                        <?php /*
 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                         
                                         <?php if($login == 1) {
											 ?>
                                              <form action="master_action.php" method="post" >
                                        	<input type="hidden" name="req_mun" value="<?php echo md5(md5(md5(sha1($MUN['mun_id'].'creation983ygh8t4eg8t9hg9u4eh5thr9g48etjg894je8tdjg489ejtg894je589th')))) ?>" />
                                        <button type="submit" class="btn btn-lg btn-info">Request an Edit</button>
                                        </form>
                                             
                                             <?php
											 
										 }else{
											 ?>
                                              
                                        <button disabled type="button" data-toggle="tooltip" title="You must be Logged in to Request an edit" class="btn btn-lg btn-danger">Request an Edit</button>
                                       
                                             
                                             <?php
										 }
										 
										 ?>
                                       
                                        
                                        
                                        
                                        </div> */ ?>

                                        
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
        


                                
                                <div id="repmun" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <form id="formmodalrep" action="master_action.php" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Report this MUN</h4>
      </div>
      <div class="modal-body">
        
            	    <div class="row">
                        <div class="col-xs-6">
                            <input name="rep_usr_nm" class="form-control " type="text" required placeholder="Full Name">
                        </div>
                   
                        <div class="col-xs-6">
                            <input name="rep_usr_eml" class="form-control" type="email" required placeholder="Email">
                        </div>
                    </div>
                
                  <br>

                    <div class="row">
                  
                        <div class="col-xs-12">
                           
                                    <textarea style=" resize:vertical" name="rep_prob_dob" type="text" class="form-control" placeholder="Describe the problem" required></textarea>
                                  
                      
                             
                        </div>
                    </div>
                   <br>
<br>


                   
                    <input type="hidden" name="rep_mun" value="<?php echo md5(sha1(sha1(sha1($MUN['mun_id'].'creation983ygh8t4eg8t9hg9u4eh5thr9g48etjg894jtg894je589thj84h5teh')))) ?>" />
                    
                    
                
                 
        
        
      </div>
      <div class="modal-footer">
        <button type="reset" onClick="document.getElementById('formmodalrep').reset();" class="btn btn-default" data-dismiss="modal">Close</button>
         <button class="btn btn-success" type="submit">Report </button>
      </div>
                </form>
    </div>

  </div>
</div>
                                
                                
                                
                                
                                
                                
                                


   <?php  
	  get_end_script();
	  ?>

 
 
  </body>

<!-- the manprofile.htmlby ayan ahmad 07:31:23 GMT -->
</html>
