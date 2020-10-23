<?php 

include('include.php');
?>
<?php 
include('page_that_has_to_be_included_for_every_user_visible_page.php');
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
	die('Login to View this page <a href="login.php"><button>Login</button></a>');
}


if($admin == 0){
	die('<h1>503 </h1><br>
Access Denied');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>
    <link href="assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />

        
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
            <div class="page-title"> 
                    <h3 class="title">Welcome <?php echo ucwords($_USER['usr_name'])?> !</h3> 
                </div>



                 <!-- end row -->

                <div class="row">
                    

                    <div class="col-lg-12	">

                        <div class="panel panel-default"><!-- /primary heading -->
                            <div class="portlet-heading">
      
                            <div class="panel-heading">
                                <h3 class="panel-title">Mun(s)</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                   
                                    <br>


                                    
                                    <div class="row">
                                        <!-- -->
                                         <?php

$boxsql = "SELECT * FROM `mun_rec`";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		if((($cc-1) > 0) and (($cc-1) % 2) == 0){
			echo '</div><div class="row">';
		}
		$clmun = $conn->query("select * from mun_claim_requests a left join mun_logins b  on a.cl_rel_lum_id = b.lum_id where lum_valid =1 and cl_granted =1 and cl_valid =1 and cl_rel_mun_id = ".$boxrw['mun_id']."");

if ($clmun->num_rows > 0) {
    // output data of each row
	$amount = array();
    while($cls = $clmun->fetch_assoc()) {
		$amount[] = $cls['lum_id'].':'.$cls['lum_username'].'-_-'.$cls['lum_email'];
	}
	
	$munsclaimed = implode(', ',$amount);
}else{
	
	$munsclaimed = 'None';
}
		
		echo '
<div class="col-md-6">
	<div ';
			if($boxrw['mun_valid']==1){
				echo '
style="border:5px solid green" ';
			}else{
				echo'
style="border:4px solid red" ';
			}
			
			
			
			
			echo' class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">'.$boxrw['mun_shortname'].$boxrw['mun_year'].'<span style="float:right">
			<a data-toggle="modal" data-target="#'.md5(md5(sha1($boxrw['mun_id'].'hfrjeidi'))).'" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<p><button type="button" class="btn btn-md btn-danger pull-right" data-toggle="modal" data-target="#chImg'.md5(md5(sha1($boxrw['mun_id']))).'" href="#"><i class="fa fa-pencil pull-right"></i></button></p>
	
	<img style="width:100%" src="'.$boxrw['mun_img_src'].'" alt="'.$boxrw['mun_fullname'].'" />
	</div>
	</div>
	<br>


			<h2 align="center">'.$boxrw['mun_shortname'].''.$boxrw['mun_year'].'</h2> 
			<h3 align="center">'.$boxrw['mun_fullname'].'</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> '.$boxrw['mun_hostedat'].'</p>
<p><strong>Hosted At Address:</strong> '.$boxrw['mun_hosted_addr'].'</p>
<p><strong>Website: </strong>'.$boxrw['mun_website'].'</p>
<p><strong>Email:</strong> '.$boxrw['mun_email'].'</p>
<p><strong>Country: </strong>'.$boxrw['mun_country'].'</p>
<p><strong>Latitude(Hosted):</strong> '.$boxrw['mun_lat'].'</p>
<p><strong>Longitude(Hosted):</strong> '.$boxrw['mun_long'].'</p>
<p><strong>From: </strong>'.date('D, jS M Y @ H:i:s a',$boxrw['mun_from']).'</p>
<p><strong>Till: </strong>'.date('D, jS M Y @ H:i:s a',$boxrw['mun_till']).'</p>
<p><strong>Contact Number:</strong> '.$boxrw['mun_contact_no'].'</p>
<p><strong>Claimed By:</strong> '.$munsclaimed.'</p>
<p>
	<strong>Identification Colour:</strong>
	'.$boxrw['mun_iden_color'].'
	<i class="fa fa-circle pull-right" style="color:'.$boxrw['mun_iden_color'].'"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	'.$boxrw['mun_text_color'].'
	<i class="fa fa-circle pull-right" style="color:'.$boxrw['mun_text_color'].'"></i>
</p>
			<p>
			';
			if($boxrw['mun_valid']==1){
				echo '
<hr style="border-bottom:6px solid green;border-radius:5px">';
			}else{
				echo'
<hr style="border-bottom:6px solid red;border-radius:5px">';
			}
			echo'
			</p>

			<p>
			';
			if($boxrw['mun_valid']==1){
				echo '
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['mun_id'].'egkjtnr newsdnjjenfkv ijfkorkvnkorvfk')))))).'" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>
';
			}else{
				echo'
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['mun_id'].'jijnfiirjfnirokijfkorkvnkorvfk')))))).'" />
		<input type="submit" class="btn btn-success" name="com_make_ac" value="Make Active" />
		</form>';
			}
			echo'
			</p>
		</div> 
	</div>
</div>
                                        
	';
	
	$cc++;
	#first loop ends
	$munsclaimed = 'None';

    }
} else {
    echo "0 results";
}
 ?> 

 
                                        
                                 
                                        <!-- -->
                                    </div> 
                                    
                                    
                                    
                                    
                                    
                                    
                                     <form enctype="multipart/form-data" action="master_action.php" method="post" enctype="multipart/form-data">
 <div class="col-xs-12">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title"><input class="form-control" required  name="a_mun_shrtname" type="text" placeholder="MUN Short Name eg:ABCMUN" /></h3> 
		</div> 
		<div class="panel-body"> 
            <p>MUN Fullname: <input class="form-control" required  name="a_mun_flnme" type="text" placeholder="Aerio Boiwrsn Model United Nations" /></p>
            <p>MUN Year: <input class="form-control" required  name="a_mun_year" type="number" min="<?php echo (3 - date('Y' , time())); ?>"  placeholder="<?php echo date('Y', time()); ?>" value="<?php echo date('Y', time()); ?>" /></p>
            <p>Img Src: <input class="form-control"   name="mun_img" required accept="image/*" type="file" placeholder="Img Src" /></p>
            <p>Hosted at: <input class="form-control" required  name="a_mun_hosted" type="text" placeholder="Institution Name" /></p>
            <p>Hosted at address: <input class="form-control" required  name="a_mun_hostedaddr" type="text" placeholder="Institution's Address" /></p>
            <p>Latitude of Institution: <input class="form-control" required  name="a_mun_lat" type="text" placeholder="22.342" /></p>
            <p>Longitide of Institution: <input class="form-control" required  name="a_mun_long" type="text" placeholder="72.122" /></p>
            <p>MUN's Website: <input class="form-control" required  name="a_mun_website" type="text" placeholder="without http:// eg:'abcmun.com'" /></p>
            <p>MUN's Email: <input class="form-control" required  name="a_mun_email" type="email" placeholder="master@abcmun.com" /></p>
            <p>Country : <input class="form-control" required  name="a_mun_country" type="text" value="india" placeholder="india" /></p>
            <p>Contact Number : <input class="form-control" required  name="a_mun_contctno" type="tel" placeholder="9876543210" /></p>
            <p>Start Date: <input class="datepicker form-control" required  name="a_mun_stdt" type="text"  placeholder="Click To select" /></p>
            <p>End Date: <input class="datepicker form-control" required  name="a_mun_etdt" type="text"  placeholder="Click To select" /></p>
            <p>Identification BackGroud Color : <input class="form-control" required  name="a_mun_idenbg" type="text"  placeholder="#fff" /></p>
           <p>Identification Font Color: <input class="form-control" required  name="a_mun_idenfnt" type="text" placeholder="rgb(1,2,3)" /></p>
          
           
            <p class="col-xs-4">Is Valid: <input class="form-control"  name="a_mun_valid" type="number" min="0" max="1" placeholder="0 or 1" /></p>
            </div>
			<p><input class="btn btn-success " name="a_mun_add" type="submit" value="Add Mun"/></p> 
		</div> 
	</div>
</div>
 </form>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    
                </div> <!-- End row -->


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            
 <?php

$msql = "SELECT * FROM `mun_rec` ";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		
		echo '
<div id="'.md5(md5(sha1($mrw['mun_id'].'hfrjeidi'))).'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-full">

    <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editing '.$mrw['mun_shortname'].$mrw['mun_year'].'</h4>
      </div>
      <div class="modal-body">
	 
        <form action="master_action.php" method="post">

<div class="form-group">
	<label>MUN Shortname (With out Year)</label>
	<input type="text" name="mun_edit_shrtnme" class="form-control" value="'.$mrw['mun_shortname'].'">
</div>



<div class="form-group">
	<label>MUN Fullname (With out Year)</label>
	<input type="text" name="mun_edit_fullnme" class="form-control" value="'.$mrw['mun_fullname'].'">
</div>


<div class="form-group">
	<label>MUN Year:</label>
	<input type="text" name="mun_edit_year" class="form-control" value="'.$mrw['mun_year'].'">
</div>


<div class="form-group">
	<label>Hosted at </label>
	<input type="text" name="mun_edit_hosat" class="form-control" value="'.$mrw['mun_hostedat'].'">
</div> 
 

<div class="form-group">
	<label>Hosted at address:</label>
	<input type="text" name="mun_edit_hosaddr" class="form-control" value="'.$mrw['mun_hosted_addr'].'">
</div>

<div class="form-group">
	<label>Latitide of Institution</label>
	<input type="text" name="mun_edit_lat" class="form-control" value="'.$mrw['mun_lat'].'">
</div>

<div class="form-group">
	<label>Longitide of Institution</label>
	<input type="text" name="mun_edit_long" class="form-control" value="'.$mrw['mun_long'].'">
</div>

<div class="form-group">
	<label>Website</label>
	<input type="text" name="mun_edit_web" class="form-control" value="'.$mrw['mun_website'].'">
</div>

<div class="form-group">
	<label>Email</label>
	<input type="text" name="mun_edit_eml" class="form-control" value="'.$mrw['mun_email'].'">
</div>

<div class="form-group">
	<label>Country</label>
	<input type="text" name="mun_edit_country" class="form-control" value="'.$mrw['mun_country'].'">
</div>

<div class="form-group">
	<label>Contact Number</label>
	<input type="text" name="mun_edit_contcno" class="form-control" value="'.$mrw['mun_contact_no'].'">
</div>
<div class="form-group">
	<label>Identification  Background Colour</label>
	<input type="text" name="mun_edit_idenbg" class="form-control" value="'.$mrw['mun_iden_color'].'">
</div>

<div class="form-group">
	<label>Identification Font Colour</label>
	<input type="text" name="mun_edit_idenfc" class="form-control" value="'.$mrw['mun_text_color'].'">
</div>

 
<div class="form-group">
	<label>Start Date</label>
	<input type="text" name="mun_edit_startdate" class="form-control datepicker" value="'.date('m',$mrw['mun_from']).'/'.date('d',$mrw['mun_from']).'/'.date('Y',$mrw['mun_from']).'">
</div>


<div class="form-group">
	<label>End Date</label>
	<input type="text" name="mun_edit_enddate" class="form-control datepicker" value="'.date('m',$mrw['mun_till']).'/'.date('d',$mrw['mun_till']).'/'.date('Y',$mrw['mun_till']).'">
</div>
 





<div class="row">
	<div class="col-xs-6">
		<input name="h_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($mrw['mun_id'].'9irbfheierifhe3 4r3r04 j49i4u49igrhru9git')))))).'" />
		<input name="edit_com" style="float:right" type="submit" class="btn btn-success" value="Save" />
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>


  </div>
</div>
		
	';
	?>
    
    <div id="chImg<?php echo md5(md5(sha1($mrw['mun_id']))) ?>" class="modal fade" role="dialog" >
                                    <div class="modal-dialog modal-full">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="full-width-modalLabel">Mun Image</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                    <div class="col-md-12 portlets">
                        <!-- Your awesome content goes here -->
                        <div class="m-b-30">
                            <form  action="master_action.php" method="post" enctype="multipart/form-data" >
                            <input type="hidden"  name="mun_admin_ch_img" value="<?php echo uniqid()  ?>"/>
                            <input type="hidden"  name="mun_admin_ch_img_h" 
value="<?php echo 
md5(sha1(md5(md5($mrw['mun_id'].'2415972129601522 65 65468 405405834 534086409844 8604y8r64hg68y 4t9jgnh5348t 5f3y4vj1n 89e4y6e4908t04 8tyj'))))  ?>"/>
                              <div class="fallback">
                                  <label id="ch_img_mun_br<?php echo $mrw['mun_id'].$mrw['mun_valid'] ?>" class="btn btn-default btn-file">
        Browse <input  name="mun_admin_img_chd" type="file" accept="image/*" onchange="loadFile<?php echo $mrw['mun_id'].$mrw['mun_valid'] ?>(event)" style="display: none;">
        
        
       
    </label>
    
    <br><br>
<br>

<input id="ch_img_mun_cl<?php echo $mrw['mun_id'].$mrw['mun_valid'] ?>" class="hidden btn btn-sucess" type="submit" name="mun_admin_ch_cl" value="Click to Upload" />

<?php /*
 <input id="ch_img_mun_txt<?php echo $mrw['cl_id'].$mrw['cl_id'] ?>" type="text" name="mun_ch_text_url" placeholder="Or just enter the image Url" class="form-control input-lg" /><br>

 <input id="ch_img_mun_bu<?php echo $mrw['cl_id'].$mrw['cl_id'] ?>" class="btn btn-md btn-success" value="Upload Image from Url" type="submit">
 
 <script>
 $(document).ready(function(e) {
    $("#ch_img_mun_bu<?php echo $mrw['cl_id'].$mrw['cl_id'] ?>").fadeOut();

 $("#ch_img_mun_txt<?php echo $mrw['cl_id'].$mrw['cl_id'] ?>").keyup(function(e) {
	 if($("#ch_img_mun_txt<?php echo $mrw['cl_id'].$mrw['cl_id'] ?>").val() == ''){
		 $("label #ch_img_mun_br<?php echo $mrw['cl_id'].$mrw['cl_id'] ?>").fadeIn(); 
	 }else{
   $("#ch_img_mun_br<?php echo $mrw['cl_id'].$mrw['cl_id'] ?>").fadeOut();
   $("#ch_img_mun_bu<?php echo $mrw['cl_id'].$mrw['cl_id'] ?>").fadeIn();
   
	 }
});

});
 </script>
 */ ?>
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4">
        	<img class="img-responsive" id="output<?php echo $mrw['mun_id'].$mrw['mun_valid'] ?>"/>
        </div>
    </div>
    <script>
	  var loadFile<?php echo $mrw['mun_id'].$mrw['mun_valid'] ?> = function(event) {
		var reader = new FileReader();
		reader.onload = function(){
		  var output = document.getElementById('output<?php echo $mrw['mun_id'].$mrw['mun_valid'] ?>');
		  output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
		$('#ch_img_mun_cl<?php echo $mrw['mun_id'].$mrw['mun_valid'] ?>').removeClass('hidden');
		
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
	
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?> 
            
                  <!-- Footer Start -->
            <footer class="footer">
<?php auto_copyright(); // Current year?>

  The MUN Circuit.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
  


      <?php  
	  get_end_script();
	  ?>   
       <script src="assets/timepicker/bootstrap-datepicker.js"></script>


<script>
$(document).ready(function() {
	$('.datepicker').datepicker();		
});
</script>
      
           </body>

</html>
