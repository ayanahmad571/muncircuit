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
		var_dump($boxrw);
		continue;
		#firts loop begins
		echo '
<div class="col-md-4">
	<div ';
			if($boxrw['mo_valid']==1){
				echo '
style="border:5px solid green" ';
			}else{
				echo'
style="border:4px solid red" ';
			}
			echo' class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">'.$boxrw['mo_name'].'<span style="float:right">
			<a data-toggle="modal" data-target="#'.md5(md5(sha1($boxrw['mo_id']))).'" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body"> 
			<p>Linked to: <em style="color:blue">'.$boxrw['mo_href'].'</em></p> 
			<p>Icon: '.$boxrw['mo_icon'].' -> <i class=" '.$boxrw['mo_icon'].' "></i></p> 
			<p>Sub Menu: ' ; if($boxrw['mo_sub_mod'] == 1){echo '<i style="font-size:15px;color:green">Yes</i>';}else{echo '<i style=" font-size:15px;color:red">No</i>';} echo '</p> 
			<p>If Admin Login : '; if($boxrw['mo_ifadmin'] == 1){echo '<i style="font-size:15px;color:green">Visible</i>';}else{echo '<i style=" font-size:15px;color:red">In-Visible</i>';} echo' </p>
			<p>If Not-Admin Login : '; if($boxrw['mo_ifnoadmin'] == 1){echo '<i style="font-size:15px;color:green">Visible</i>';}else{echo '<i style=" font-size:15px;color:red">In-Visible</i>';} echo' </p>
			<p>If Not Logged in: '; if($boxrw['mo_if_no_log_in'] == 1){echo '<i style="font-size:15px;color:green">Visible</i>';}else{echo '<i style=" font-size:15px;color:red">In-Visible</i>';} echo' </p>
			<p>If Logged in : '; if($boxrw['mo_if_log_in'] == 1){echo '<i style="font-size:15px;color:green">Visible</i>';}else{echo '<i style=" font-size:15px;color:red">In-Visible</i>';} echo' </p>
			<p>Badge: '.$boxrw['mo_badge_info'].'</p> 
			<p>
			';
			if($boxrw['mo_valid']==1){
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
			if($boxrw['mo_valid']==1){
				echo '
		<form action="master_action.php" method="post">
		<input name="hash_inc" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['mo_id'].'hbujeio03ir94urghnjefr 309i4wef')))))).'" />
			<input type="submit" class="btn btn-danger" name="tab_inact" value="Make InActive" />
		</form>
';
			}else{
				echo'
		<form action="master_action.php" method="post">
		<input name="hash_ac" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['mo_id'].'njhifverkof2njbivjwj bfurhib2jw')))))).'" />
		<input type="submit" class="btn btn-success" name="tab_act" value="Make Active" />
		</form>';
			}
			echo'
			</p>
		</div> 
	</div>
</div>
                                        
	';
	if(($cc % 3) == 0){
		echo '</div><div class="row">';
	}
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?> 
 <form action="master_action.php" method="post" >
 <div class="col-md-4">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title"><input class="form-control"  required   name="mod_a_long_name" type="text" placeholder="Module Name" /></h3> 
		</div> 
		<div class="panel-body"> 
			<p>Linked to: <input class="form-control" required name="mod_a_href" type="text" placeholder="Href" /></p> 
			<p>Icon: <input class="form-control" required name="mod_a_icon" type="text" placeholder="ion-plus or fa fa-home" /></p> 
			<p>Sub Menu: <input class="form-control"   required name="mod_a_sub_menu" type="number" max="1" min="0" placeholder=" 1 or 0" /></p> 
			<p>If Admin Login: <input class="form-control"   required name="mod_a_ifadmin" type="number" max="1" min="0" placeholder=" 1 or 0" /></p> 
			<p>If Not Admin Login: <input class="form-control" required   name="mod_a_ifnotadmin" type="number" max="1" min="0" placeholder=" 1 or 0" /></p> 
			<p>If Not Logged in: <input class="form-control" required   name="mod_a_ifnotlogin" type="number" max="1" min="0" placeholder=" 1 or 0" /></p> 
			<p>If Logged in: <input class="form-control"  required  name="mod_a_iflogin" type="number" max="1" min="0" placeholder=" 1 or 0" /></p> 
			<p>Module Valid: <input class="form-control"  required  name="mod_a_valid" type="number" max="1" min="0" placeholder=" 1 or 0" /></p> 
			<p><input class="btn btn-success "   name="mod_add" type="submit" value="Add Tab"/></p> 
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

$msql = "SELECT * FROM `mun_modules` ";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		echo '
<div id="'.md5(md5(sha1($mrw['mo_id']))).'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-full">

    <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editing '.$mrw['mo_name'].'</h4>
      </div>
      <div class="modal-body">
        <form action="master_action.php" method="post">
		
<div class="form-group">
	<label>Long Name : </label>
	<input type="text" name="edit_mod_lngnme" class="form-control" value="'.$mrw['mo_name'].'">
</div>

<div class="form-group">
	<label>Identification Name/ Short Name (Linked to) : </label>
	<input type="text" name="edit_mod_shrtnme" class="form-control" value="'.$mrw['mo_href'].'">
</div>

<div class="form-group">
	<label>Icon : </label>
	<input type="text" name="edit_mod_icon" class="form-control" value="'.$mrw['mo_icon'].'">
</div>


<div class="form-group">
	<label>Sub Module: </label>
	<input type="text" name="edit_mod_sub" class="form-control" value="'.$mrw['mo_sub_mod'].'">
</div>

<div class="form-group">
	<label>If No Admin:</label>
	<input type="text" name="edit_ifnoadmin" class="form-control" value="'.$mrw['mo_ifnoadmin'].'">
</div>

<div class="form-group">
	<label>If Admin: </label>
	<input type="text" name="edit_ifadmin" class="form-control" value="'.$mrw['mo_ifadmin'].'">
</div>

<div class="form-group">
	<label>If Logged In: </label>
	<input type="text" name="edit_iflogin" class="form-control" value="'.$mrw['mo_if_log_in'].'">
</div>

<div class="form-group">
	<label>If not Logged out: </label>
	<input type="text" name="edit_ifnologin" class="form-control" value="'.$mrw['mo_if_no_log_in'].'">
</div>



<div class="row">
	<div class="col-xs-6">
	<input type="hidden" name="hash_emmp__1i" value="'.md5(md5(sha1(sha1(md5(md5($mrw['mo_id'].'lkoegnuifvh bnn njenjn')))))).'"></input>
		<input name="edit_mod" style="float:right" type="submit" class="btn btn-success" value="Save" />
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
