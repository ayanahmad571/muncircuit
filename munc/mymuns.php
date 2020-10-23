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

?>
<!DOCTYPE html>
<html lang="en">
    
<!-- the manprofile.htmlby ayan ahmad 07:31:23 GMT -->
<head>
        <?php get_head(); ?>
    <!-- Dropzone css -->
    <link href="assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />

        <script src="js/jquery.js"></script>

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
                

                <div class="row m-t-30">
                    <div class="col-sm-12">
                    <div class="row">
                    

<?php

$getdistsql = "
SELECT * FROM mun_claim_requests mc left join mun_rec ml on mc.cl_rel_mun_id = ml.mun_id
where cl_rel_lum_id = ".$_SESSION['MUNC_USR_DB_ID']."
and mc.cl_granted = 1 
and mc.cl_valid =1
and ml.mun_valid =1
and mc.cl_mail_sent =1";
$getdistres = $conn->query($getdistsql);

if ($getdistres->num_rows > 0) {
    // output data of each row
	$eo = 0;
    while($getdist = $getdistres->fetch_assoc()) {
		if(($eo !==0) and (($eo % 2) == 0)){
			echo '</div><div class="row">';
		}
		?>
        <div class="col-lg-6">
                        <div class="panel panel-color panel-inverse">
                            <div class="panel-heading"> 
                                <h3 class="panel-title"><?php echo strtoupper($getdist['mun_shortname']).$getdist['mun_year'] ; ?>
                                <button type="button" class="btn btn-md btn-info pull-right" data-toggle="modal" data-target="#chDet<?php echo md5(md5(sha1($getdist['mun_id']))) ?>" href="#"><i class="fa fa-pencil pull-right"></i>
                                </button></h3>
                            </div> 
                            <div class="panel-body"> 
                                <div class="col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2">
                                <p><button type="button" class="btn btn-md btn-danger pull-right" data-toggle="modal" data-target="#chImg<?php echo md5(md5(sha1($getdist['mun_id']))) ?>" href="#"><i class="fa fa-pencil pull-right"></i></button></p>
                                    <p><img class="img-responsive" src="<?php echo $getdist['mun_img_src']; ?>" alt="<?php echo strtoupper($getdist['mun_shortname']).$getdist['mun_year'].'_IMG' ; ?>" /></p> 
                                </div>
                                <div class="col-xs-12">
                                <h3 align="center"><?php echo strtoupper($getdist['mun_shortname']).$getdist['mun_year'] ; ?></h3>
                                <h4 align="center"><?php echo ucwords($getdist['mun_fullname']) ; ?></h4>
                                </div>
                                
                                <div class="col-xs-12">
                                	<div class="row">
                                    	<div class="col-lg-6 col-xs-6">
                                        	<div align="left" style="width:100px; height:80px;
                                             background-color:#EFE3B0; border-right:solid black 1px;">
                                                 
                                                <div style="width:100%; height:40px; background-color:#0022A7;color:white">
                                                    <h4 style="padding-top:10px" align="center"><?php echo 
													date('M',trim($getdist['mun_from'])) ?></h4>
                                                </div>
                                                <div style="width:100%; height:40px;">
                                                    <h4  style="color:black" align="center"><?php echo 
													date('jS',trim($getdist['mun_from'])) ?></h4>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    	
                                        <div class="col-lg-6 col-xs-6">
                                        	<div align="right" style="width:100px; height:80px;
                                             background-color:#EFE3B0; border-left:solid black 1px">
                                                 
                                                <div style="width:100%; height:40px; background-color:#0022A7;color:white">
                                                    <h4 style="padding-top:10px" align="center"><?php echo 
													date('M',trim($getdist['mun_till'])) ?></h4>
                                                </div>
                                                <div style="width:100%; height:40px;">
                                                    <h4  style="color:black" align="center"><?php echo 
													date('jS',trim($getdist['mun_till'])) ?></h4>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="col-xs-12">
                                	<br>
<table class="table ">
                                            <tbody>
                                                <tr>
                                                    <th>Hosted at</th>
                                                    <td><?php echo $getdist['mun_hostedat'] ?></td>
                                                </tr>
                                           <tr>
                                                    <th>Hosted at address</th>
                                                    <td><?php echo $getdist['mun_hosted_addr'] ?></td>
                                                </tr>
                                           
                                           <tr>
                                                    <th>Mun's Website</th>
                                                    <td><?php echo $getdist['mun_website'] ?></td>
                                                </tr>
                                                
                                                 <tr>
                                                    <th>Contact Number</th>
                                                    <td><?php echo $getdist['mun_contact_no'] ?></td>
                                                </tr>
                                                
                                           <tr>
                                                    <th>Hosting Country</th>
                                                    <td><?php echo $getdist['mun_country'] ?></td>
                                                </tr>
                                           <tr>
                                                    <th>Location's Latitude</th>
                                                    <td><?php echo $getdist['mun_lat'] ?></td>
                                                </tr>


                                           <tr>
                                                    <th>Location's Longitude</th>
                                                    <td><?php echo $getdist['mun_long'] ?></td>
                                                </tr>
                                            
                                               
                                            </tbody>
                                        </table>
                                </div>
                          </div> 
                        </div>
                    </div>
                    
                    
                    
                    
                    <?php /*
 */ ?>

                    
<div id="chDet<?php echo md5(md5(sha1($getdist['mun_id']))) ?>" class="modal fade" role="dialog" >
                                    <div class="modal-dialog modal-full">
                                    <form action="master_action.php" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="full-width-modalLabel">
                                                Change Details of <?php 
												echo strtoupper($getdist['mun_shortname']).$getdist['mun_year'] ; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                            <div class="form-group">
                                                <label for="unn">MUN Short-Name (without year)</label>
                                                <input type="text" value="<?php echo strtoupper($getdist['mun_shortname']) ?>" id="unn" name="mun_cl_ch_shrtname" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="unn2">MUN Long-Name (without year)</label>
                                                <input type="text" value="<?php echo $getdist['mun_fullname'] ?>" id="unn2" name="mun_cl_ch_lngnme" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="unn">MUN Hosted at </label>
                                                <input type="text" value="<?php echo $getdist['mun_hostedat'] ?>" id="unn" name="mun_cl_ch_hostat" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="unn">MUN Hosted at Address</label>
                                                <input type="text" value="<?php echo $getdist['mun_hosted_addr'] ?>" id="unn" name="mun_cl_ch_hstdaddr" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="unn">MUN's Website</label>
                                                <input type="text" value="<?php echo $getdist['mun_website'] ?>" id="unn" name="mun_cl_ch_website" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="unn">Contact No.</label>
                                                <input type="text" value="<?php echo $getdist['mun_contact_no'] ?>" id="unn" name="mun_cl_ch_contc" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="Email">Email(not editable)</label>
                                                <input type="email" disabled value="<?php echo $getdist['mun_email'] ?>" id="Email" class="form-control">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="Username">MUN Country</label>
                                                <input name="mun_cl_ch_loc_country" type="text" value="<?php echo $getdist['mun_country'] ?>" id="Username" class="form-control">
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="Username">Location's Latitude</label>
                                                <input name="mun_cl_ch_loc_lat" type="text" value="<?php echo $getdist['mun_lat'] ?>" id="Username" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="Username">Location's Longitude</label>
                                                <input name="mun_cl_ch_loc_long" type="text" value="<?php echo $getdist['mun_long'] ?>" id="Username" class="form-control">
                                            </div>
                                            
                                            
                                          <div class="form-group">
                                                <label for="datepicker">Start day</label>
                                                 <div class="input-group">
                                    <input name="mun_cl_ch_start_day" type="text" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php echo date('m/d/Y',trim($getdist['mun_from']))?>" id="datepicker">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div><!-- input-group -->
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="datepicker">Till Day</label>
                                                 <div class="input-group">
                                    <input name="mun_cl_ch_end_day" type="text" class="form-control datepicker2" placeholder="mm/dd/yyyy" value="<?php echo date('m/d/Y',trim($getdist['mun_till']))?>" id="datepicker2">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div><!-- input-group -->
                                            </div>
                                            
                                            
<input type="hidden" name="mun_cl_ch" value="<?php echo md5(sha1(time()).uniqid().md5('Hola')) ?>" />                                           
<input type="hidden" name="mun_cl_ch_h" value="<?php echo md5(sha1(md5($getdist['cl_id'].'u4hbrjijnrn gjgbnnrggnbnrgioknjrgrijnbjrn jgjrngnbjjgrodfijg 45u hgoiu5trg1654851584135468 64 64 864684 354 8651 0410351054 6504 6840 864 0864'))) ?>" />                                           
                                           
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
                                
                                <?php /*

 */ ?>



<div id="chImg<?php echo md5(md5(sha1($getdist['mun_id']))) ?>" class="modal fade" role="dialog" >
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
                            <input type="hidden"  name="mun_cl_ch_img" value="<?php echo uniqid()  ?>"/>
                            <input type="hidden"  name="mun_cl_ch_img_h" 
value="<?php echo 
md5(sha1(md5(md5($getdist['cl_id'].'2415972129601522 65 65468 405405834 534086409844 8604y8r64hg68y 4t9jgnh5348t 5f3y4vj1n 89e4y6e4908t04 8tyj'))))  ?>"/>
                              <div class="fallback">
                                  <label id="ch_img_mun_br<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>" class="btn btn-default btn-file">
        Browse <input  name="mun_ch_img" type="file" accept="image/*" onchange="loadFile<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>(event)" style="display: none;">
        
        
       
    </label>
    
    <br><br>
<br>

<input id="ch_img_mun_cl<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>" class="hidden btn btn-sucess" type="submit" name="cl_ch_img" value="Click to Upload" />

<?php /*
 <input id="ch_img_mun_txt<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>" type="text" name="mun_ch_text_url" placeholder="Or just enter the image Url" class="form-control input-lg" /><br>

 <input id="ch_img_mun_bu<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>" class="btn btn-md btn-success" value="Upload Image from Url" type="submit">
 
 <script>
 $(document).ready(function(e) {
    $("#ch_img_mun_bu<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>").fadeOut();

 $("#ch_img_mun_txt<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>").keyup(function(e) {
	 if($("#ch_img_mun_txt<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>").val() == ''){
		 $("label #ch_img_mun_br<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>").fadeIn(); 
	 }else{
   $("#ch_img_mun_br<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>").fadeOut();
   $("#ch_img_mun_bu<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>").fadeIn();
   
	 }
});

});
 </script>
 */ ?>
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4">
        	<img class="img-responsive" id="output<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>"/>
        </div>
    </div>
    <script>
	  var loadFile<?php echo $getdist['cl_id'].$getdist['cl_id'] ?> = function(event) {
		var reader = new FileReader();
		reader.onload = function(){
		  var output = document.getElementById('output<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>');
		  output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
		$('#ch_img_mun_cl<?php echo $getdist['cl_id'].$getdist['cl_id'] ?>').removeClass('hidden');
		
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
                                
                                
                                
                                
                                
<?php /*
 */ ?>

        <?php
		$eo++;
    }
} else {
    echo "You have not claimed or added any MUNs to MUN Circuit";
}
 ?> 
                        
                   

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
        

                                
                                
                                
                                
                                
                                
                                
                                
                                


   <?php  
	  get_end_script_nojs();
	  ?>

 <script src="assets/timepicker/bootstrap-datepicker.js"></script>


      <script>

            $(document).ready(function() {
                    
        
                $('.datepicker').datepicker({
    
});
				
				  $('.datepicker2').datepicker({
    
});
				
				

			});
			
      </script>
      

  </body>

<!-- the manprofile.htmlby ayan ahmad 07:31:23 GMT -->
</html>
