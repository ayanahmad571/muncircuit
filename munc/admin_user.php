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
                                <h3 class="panel-title">Users</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <!-- -->

                               <?php

$boxsql = "SELECT * FROM `mun_logins` a left join mun_users b on a.lum_id = b.usr_rel_lum_id ";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		if($boxrw['lum_valid'] == 1){
			$give = '
			<form action="master_action.php" method="post">
		<input name="yh_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['lum_id'].'hir39efnewsfejirjrjdnjjenfkv ijfkorkvnkorvfk')))))).'" />
			<input type="submit" class="btn btn-danger m-t-20" name="usr_make_inac" value="Disable" />
';			$bg = 'info';
		}else{
			$give = '<form action="master_action.php" method="post">
		<input name="yh_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['lum_id'].'hir39efnewsfejirjeofkvjrjdnjjenfkvkijonreij3nj')))))).'" />
			<input type="submit" class="btn btn-success m-t-20" name="usr_make_ac" value="Enable" />
			';
			$bg = 'danger';
		}
		
		if($boxrw['usr_validtill'] == 0){
			$adm = 'Never ';
		}else{
			$adm = date("D d M ,Y H:i:s",$boxrw['usr_validtill']);
		}
		
		if($boxrw['lum_ad'] == 0){
			$admi_p = 'Not Admin';
		}else{
			$admi_p= 'Admin';
		}
		
		if(($boxrw['lum_id'] == $_SESSION['MUNC_USR_DB_ID']) and ($boxrw['lum_id'] !== '1') ){
			$give .= '&nbsp;&nbsp;&nbsp;<a  data-toggle="tooltip" data-placement="top" title="You are logged in with this account. Log out to make any changes " class="btn btn-sm btn-danger m-t-20 ion-edit"></a></form>';
		}else{
			$give .= '&nbsp;&nbsp;&nbsp;<a data-toggle="modal" data-target="#'.md5(md5(sha1($boxrw['lum_id']))).'" class="btn btn-sm btn-warning m-t-20 ion-edit"></a></form>';
		}
		
		
		
$clmun = $conn->query("select * from mun_claim_requests a left join mun_rec b  on a.cl_rel_mun_id = b.mun_id where mun_valid =1 and cl_granted =1 and cl_valid =1 and cl_rel_lum_id = ".$boxrw['lum_id']."");

if ($clmun->num_rows > 0) {
    // output data of each row
	$amount = array();
    while($cls = $clmun->fetch_assoc()) {
		$amount[] = $cls['mun_id'].':'.$cls['mun_shortname'].$cls['mun_year'];
	}
	
	$munsclaimed = implode(', ',$amount);
}else{
	
	$munsclaimed = 'None';
}
		
		echo '
<div class="col-xs-12">
	<!-- Start Profile Widget -->
	<div style="border:1px grey solid" class="profile-widget text-center">
		<div class="bg-'.$bg.' bg-profile"></div>
		<img src="'.$boxrw['usr_prof_pic'].'" class="thumb-lg img-circle img-thumbnail" alt="img">
		<h3>'.$boxrw['usr_name'].'</h3>
		'.$give.'
		<ul class="list-inline widget-list clearfix">
			<li class="col-md-4"><span>'.date('M, Y',$boxrw['usr_reg_dnt']).'</span>Member Since</li>
			<li class="col-md-4"><span>'.$boxrw['lum_username'].'</span>Username</li>
			<li class="col-md-4"><span>'.date('jS, M Y',$boxrw['usr_dob_timestamp']).'</span>Date of Birth</li>
			<li class="col-md-4"><span>'.$admi_p.'</span>Admin</li>
			<li class="col-md-4"><span>'.$boxrw['lum_ad_level'].'</span>Admin Level</li>
			<li class="col-md-4"><span>'.$adm.'</span>Expires</li>
			<li class="col-md-12"><span>'.$boxrw['lum_email'].'</span>Email</li>
			<li class="col-md-6"><span>'.$boxrw['usr_reg_country'].'</span>Country</li>
			<li class="col-md-6"><span>'.$boxrw['usr_reg_ip'].'</span>Ip Registered</li>
			<li class="col-md-6"><span>'.$boxrw['usr_lat'].'</span>Registered Latitude</li>
			<li class="col-md-6"><span>'.$boxrw['usr_long'].'</span>Registered Longitude</li>
			<li class="col-md-12"><span>'.$munsclaimed.'</span>Claimed MUNs</li>
		</ul>
	</div>
	<!-- End Profile Widget -->
</div>

                                        
	';
	if(($cc % 1) == 0){
		echo '</div><div class="row">';
	}
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
                                    <div class="row">
                                    <form action="master_action.php" method="post">
                                     <div class="col-md-6">
	<div class="panel panel-color panel-inverse">
            <div class="panel-heading"> 
                <h3 class="panel-title">Normal User</h3> 
        </div>

		<div class="panel-body"> 
<p>Name:<input required class="form-control "  name="usr_f_name" type="text" placeholder="First Name" /></p>
<p>Email: <input required  class="form-control" name="usr_email" type="email" placeholder="example@muncircuit.com"  /></p> 
<p>Password: (Changable) <input required  class="form-control" name="usr_pw" type="text" placeholder="Password" value="<?php echo uniqid(); ?>"/></p> 
<p>Admin: <input  required  class="form-control" name="usr_acc" type="number" min="0" max="1" placeholder="1 or 0" /></p> 
<p>Access Level: <input required  class="form-control" name="usr_acc_l" type="number" min="0" max="10" placeholder="0 to 10"/></p> 
<p>Expires: <input required  class="form-control" name="usr_validtill" type="number" placeholder='Minutes from now, eg:10' /></p> 

<p><input class="btn btn-success " name="add_user" type="submit" value="Add User"/></p> 
		</div> 
	</div>
</div>

</form>

<form action="master_action.php" method="post">
                                     <div class="col-md-6">
	<div class="panel panel-color panel-inverse">
        <div class="panel-heading"> 
                <h3 class="panel-title">System Generated User</h3> 
        </div>
		<div class="panel-body"> 
<p>Access Level: <input class="form-control" name="sys_usr_acc" type="number" min="0" max="10" placeholder="0 to 10" /></p> 
<p>Expires: <input class="form-control" name="sys_usr_validtill" type="number" placeholder='Minutes from now' /></p> 

<p><input class="btn btn-success " name="add_sys_user" type="submit" value="Add System Generated User"/></p> 
		</div> 
	</div>
    
    
</div>

</form>
                                    </div>
                                     </div>
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
            
       
 <?php
	$msql = "SELECT * FROM `mun_logins` a left join mun_users b on a.lum_id =  b.usr_rel_lum_id";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		foreach($mrw as $me=>$m){
			$mrw[$me] = trim($m);
		}
		echo '
<div id="'.md5(md5(sha1($mrw['lum_id']))).'" class="modal fade" role="dialog">
  <div class="modal-full modal-dialog">

    <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editing '.$mrw['usr_name'].'</h4>
      </div>
      <div class="modal-body">
        <form action="master_action.php" method="post">
		
<div class="form-group">
	<label>Email : </label>
	<input disabled type="email" class="form-control" value="'.$mrw['lum_email'].'"/>
</div>

<div class="form-group">
	<label>Username: </label>
	<input name="edit_us_username" type="text" class="form-control" value="'.$mrw['lum_username'].'"/>
</div>

<div class="form-group">
	<label>Password: (Leave Undisturbed for no Change)</label>
	<input name="edit_us_pw" type="text" class="form-control" value="-" placeholder="Leave undisturbed for no change"/>
</div>

<div class="form-group">
	<label>Admin: </label>
	<input name="edit_us_adm" type="number" min="0" max="1" class="form-control" value="'.$mrw['lum_ad'].'"/>
</div>

<div class="form-group">
	<label>Access Level: </label>
	<input name="edit_us_amdlvl" type="number" min="" max="10" class="form-control" value="'.$mrw['lum_ad_level'].'"/>
</div>

<div class="form-group">
	<label>User Name: </label>
	<input name="edit_us_nme" type="text" class="form-control" value="'.$mrw['usr_name'].'"/>
</div>

<div class="form-group">
	<label>Profile Picture (URL): </label>
	<input name="edit_us_prfpic" type="text" class="form-control" value="'.$mrw['usr_prof_pic'].'"/>
</div>

<div class="form-group">
	<label>Profile Background Picture (URL): </label>
	<input name="edit_us_prfbgpc" type="text" class="form-control" value="'.$mrw['usr_back_pic'].'"/>
</div>

<div class="form-group">
	<label>Date of Birth (timestamp): </label>
	<input name="edit_us_dob" type="text" class="form-control" value="'.$mrw['usr_dob_timestamp'].'"/>
</div>

<div class="form-group">
	<label>User Latitude: </label>
	<input name="edit_us_lat" type="text" class="form-control" value="'.$mrw['usr_lat'].'"/>
</div>

<div class="form-group">
	<label>User Longitude: </label>
	<input name="edit_us_lng" type="text" class="form-control" value="'.$mrw['usr_long'].'"/>
</div>

<div class="form-group">
	<label>Valid Till: </label>
	<input name="edit_us_till" type="text" class="form-control" value="'.$mrw['usr_validtill'].'"/>
</div>







<div class="row">
	<div class="col-xs-6">
	<input type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($mrw['lum_id'].'f2frbgbe 2fgtegrfr3gbter 24rfgr324frgtr3f 3gr32fgr32f4gr')))))).'" name="hash_chkr" />
		<input style="float:right" type="submit" class="btn btn-success" name="edit_user" value="Save">
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
