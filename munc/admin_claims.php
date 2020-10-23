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
                                <h3 class="panel-title">Claims</h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <!-- -->
                                         <?php

$boxsql = "SELECT * FROM `mun_claim_requests` cl 

left join mun_logins ml on
cl.cl_rel_lum_id = ml.lum_id

left join mun_users mu on
cl.cl_rel_lum_id = mu.usr_rel_lum_id

left join mun_rec mr on
cl.cl_rel_mun_id = mr.mun_id

";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		echo '
		<div class="col-sm-6">
                        <div ';
		if($boxrw['cl_valid']==1){
				echo '
style="border:5px solid green" ';
			}else{
				echo'
style="border:4px solid red" ';
			}
			
		echo' class="panel">
                            <div class="panel-body p-t-10">
                                <div class="media-main">
                                    <a class="pull-left" href="#">
                                        <img class="thumb-lg img-circle bx-s" src="'.$boxrw['mun_img_src'].'" alt="'.$boxrw['mun_shortname'].' Image">
                                    </a>
                                    <div class="pull-right btn-group-sm">
                                        <a  data-toggle="modal" data-target="#'.md5(md5(sha1($boxrw['cl_id']))).'" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        
                                    </div>
                                    <div class="info">
                                        <h4>'.strtoupper($boxrw['mun_shortname']).' '.$boxrw['mun_year'].'</h4>
                                        <p class="text-muted">'.ucwords($boxrw['usr_name']).'</p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>';

								echo'
                                <hr/>
                                <p><strong>Mun Id:</strong> '.$boxrw['mun_id'].'</p>
                                <p><strong>User Lum id:</strong>: '.$boxrw['lum_id'].'</p>
                                <p><strong>Claim Valid:</strong>: '.$boxrw['cl_valid'].'</p>
                                <p><strong>Claim Id:</strong>: '.$boxrw['cl_id'].'</p>
                                <p><strong>Is User Admin:</strong>: '.$boxrw['lum_ad'].'</p>
      	                        <p><strong>Claim Granted:</strong>: '.$boxrw['cl_granted'].'</p>
                                <p><strong>Owner\'s Claim:</strong>: '.$boxrw['cl_mun_owned'].'</p>
<!--                                 <p><strong>mun_id:</strong>: '.$boxrw['mun_id'].'</p>
                                <p><strong>mun_id:</strong>: '.$boxrw['mun_id'].'</p> -->
								<div class="row">
			';
			if($boxrw['cl_valid']==1){
				echo '
<hr style="border-bottom:6px solid green;border-radius:5px">';
			}else{
				echo'
<hr style="border-bottom:6px solid red;border-radius:5px">';
			}
			
			if($boxrw['cl_valid']==1){
				echo '
		<form action="master_action.php" method="post">
		<input name="cl_mk_inac_ha" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['cl_id'].'egkjtnr newsdnjjenfkv ijfkorkvnkorvfk')))))).'" />
			<input type="submit" class="btn btn-danger" name="cl_mk_inac" value="Make InActive" />
		</form>
';
			}else{
				echo'
		<form action="master_action.php" method="post">
		<input name="cl_mk_ac_ha" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['cl_id'].'jijnfiirjfnirokijfkorkvnkorvfk')))))).'" />
		<input type="submit" class="btn btn-success" name="cl_mk_ac" value="Make Active" />
		</form>';
			}
			echo'</div>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div>
					
					
                                        
	';
	if(($cc % 2) == 0){
		echo '</div><div class="row">';
	}
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?> 
 </div><div class="row">
 <form action="master_action.php" method="post" >
 <div class="col-md-4">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">Add Claim(No Email is sent)</h3> 
		</div> 
		<div class="panel-body"> 
			<p>User Id: 
            <select class="form-control" name="add_claim_lumid">
            	<?php
					$addcllum = $conn->query("select * from mun_logins left join mun_users on lum_id = usr_rel_lum_id");

if ($addcllum->num_rows > 0) {
    // output data of each row
    while($adlu = $addcllum->fetch_assoc()) {
		echo '<option class="form-control" value="'.md5(md5(sha1(md5($adlu['lum_id'].'ekrshuihnji0uiu4uewrgv3wsrd')))).'">'.$adlu['lum_id'].'->'.$adlu['lum_username'].'->'.$adlu['usr_name'].'</option>';
	}
}else{
	echo '<option>No Users</option>';
}
				?>
            </select>
            </p> 
			<p>Mun Id:
			<select class="form-control" name="add_claim_munid">
            <?php
					$addcllum = $conn->query("select * from mun_rec");

if ($addcllum->num_rows > 0) {
    // output data of each row
    while($adlu = $addcllum->fetch_assoc()) {
		echo '<option class="form-control" value="'.md5(md5(sha1(md5($adlu['mun_id'].'huihnji0uiu4uewrgv3wsrd')))).'">'.$adlu['mun_shortname'].$adlu['mun_year'].'</option>';
	}
}else{
	echo '<option>No Users</option>';
}
				?>
            </select>
            </p> 
			<p>Claim Granted: <input class="form-control"   required name="add_claim_granted" type="number" max="1" min="0" placeholder=" 1 or 0" value="1"/></p> 
			<p>Mail Sent: <input class="form-control"   required name="add_claim_mlsnt" type="number" max="1" min="0" placeholder=" 1 or 0" value="1" /></p> 
			<p>Owned: <input class="form-control" required   name="add_claim_owned" type="number" max="1" min="0" placeholder=" 1 or 0" value="0" /></p> 
			<p><input class="btn btn-success"   name="add_adm_claim" type="submit" value="Add Claim"/></p> 
		</div> 
	</div>
</div>
 </form>
 
                                        
                                 
                                        <!-- -->
                                    </div> </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    
                </div> <!-- End row -->


            </div> <!-- End row -->


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            
            <!-- Footer Start -->
            
 <?php

$msql = "SELECT * FROM `mun_claim_requests` cl 

left join mun_logins ml on
cl.cl_rel_lum_id = ml.lum_id

left join mun_users mu on
cl.cl_rel_lum_id = mu.usr_rel_lum_id

left join mun_rec mr on
cl.cl_rel_mun_id = mr.mun_id
";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		echo '
<div id="'.md5(md5(sha1($mrw['cl_id']))).'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-full">

    <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editing <u><i><strong>'.$mrw['usr_name'].'\'s</strong></i></u> Claim for <u><i><strong>'.$mrw['mun_shortname'].'</strong></i></u></h4>
      </div>
      <div class="modal-body">
        <form action="master_action.php" method="post">
		
<div class="form-group">
	<label>User: </label>
	<input type="text" class="form-control" disabled value="'.$mrw['lum_id'].'->'.$mrw['lum_username'].'->'.$mrw['usr_name'].'">
</div>

<div class="form-group">
	<label>MUN(Linked to) : (Current:'.$mrw['mun_shortname'].$mrw['mun_year'].' )</label>
	<select required class="form-control"  name="edit_claim_mun">
	';
	$mures = $conn->query('select * from mun_rec where mun_id not in (select cl_rel_mun_id from mun_claim_requests where cl_rel_lum_id = '.$mrw['lum_id'].' ) ');

if ($mures->num_rows > 0) {
    // output data of each row

    while($murw = $mures->fetch_assoc()) {
		if($murw['mun_id'] == $mrw['cl_rel_mun_id']){
		echo '<option class="form-control" selected value="'.md5(sha1(md5(md5($murw['mun_id'].'i9ujhu3birfviok3iojrwoiugueioutdrgoiuevoisur09giwjrsgiuejisxrg veoidrijgoieshrgjredf')))).'">'.$murw['mun_shortname'].$murw['mun_year'].'</option>';
	
		}else{
		echo '<option class="form-control" value="'.md5(sha1(md5(md5($murw['mun_id'].'i9ujhu3birfviok3iojrwoiugueioutdrgoiuevoisur09giwjrsgiuejisxrg veoidrijgoieshrgjredf')))).'">'.$murw['mun_shortname'].$murw['mun_year'].'</option>';

		}
	}
}else{
	echo '<option class="form-control">No Muns Found</option>';
}
	echo'
	<option class="form-control" selected  value="'.md5(sha1(md5(md5($mrw['mun_id'].'i9ujhu3birfviok3iojrwoiugueioutdrgoiuevoisur09giwjrsgiuejisxrg veoidrijgoieshrgjredf')))).'">'.$mrw['mun_shortname'].''.$mrw['mun_year'].'</option>
	</select>
</div>

<div class="form-group">
	<label>Claim Granted : </label>
	<input type="number" min="0" max="1" name="edit_claims_cl_granted_f" class="form-control" value="'.$mrw['cl_granted'].'">
</div>


<div class="form-group">
	<label>to Claim Mail Sent: </label>
	<input type="number" min="0" max="1" name="edit_claim_mlsent" class="form-control" value="'.$mrw['cl_mail_sent'].'">
</div>


<div class="row">
	<div class="col-xs-6">
	<input type="hidden" name="hash_cl_d" value="'.md5(md5(sha1(sha1(md5(md5($mrw['cl_id'].'lkoegnuifvh bnn njenjn')))))).'"></input>
		<input name="edit_claim" style="float:right" type="submit" class="btn btn-success" value="Save" />
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
