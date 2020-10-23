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
			die('<h1>ERR 503.</h1><br>
You are not authorized to access this page');

		$admin = 0;
	}
}else{
	$admin = 0;
	
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>

        <!--bootstrap-wysihtml5-->
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

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
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" role="search" class="navbar-left app-search pull-left hidden-xs ">
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
                    <h3 class="title">Reported MUN's</h3> 
                </div>

<?php
/*
SELECT * FROM `mun_reports` mr
left join mun_rec mm on mr.rpt_usr_rel_mun_id =  mm.mun_id 
WHERE mr.rpt_valid =1 and mm.mun_valid =1  */

?>
<?php 

$getreps = "SELECT * FROM `mun_reports` mr
left join mun_rec mm on mr.rpt_usr_rel_mun_id =  mm.mun_id 
WHERE mr.rpt_valid =1 and mm.mun_valid =1  and mr.rpt_resolved =0 order by rpt_added_dnt DESC";
$getreps = $conn->query($getreps);

if ($getreps ->num_rows > 0) {
    $hashercounter = 1;
    // output data of each row
    while($getreprow  = $getreps ->fetch_assoc()) {
 	?>
    <form action="master_action.php" method="post">
    <input type="hidden" name="resolves_report_hash" value="<?php echo md5(sha1(md5(md5($getreprow['rpt_id'].'inyc54u569tyi47ct74wv74g57t y74e5yt734y5t98vr7nti5veni7i ytv5r y8')))) ?>" />
    <input type="hidden" name="resolves_report_s" value="<?php echo '3'; ?>" />
    <div class="row">
                    <div class="col-sm-12">
                        

                        <!-- Message -->
                        <div class="panel panel-default m-t-20">
                            <div class="panel-heading"> 
                                <h3 class="panel-title"><?php echo 'From: '.$getreprow['rpt_usr_email']; ?></h3> 
                            </div>
                            <div class="panel-body">
                                <div class="media m-b-30 ">
                                    <a href="#" class="pull-left">
                                        <img alt="" src="img/avatar-2.jpg" class="media-object thumb-sm">
                                    </a>
                                    <div class="media-body">
                                        <span class="media-meta pull-right"><?php echo date('dS M, Y @ H:i:s',$getreprow['rpt_added_dnt']); ?></span>

                                        <h4 class="text-primary m-0"><?php echo $getreprow['rpt_usr_name']; ?></h4>
                                        <small class="text-muted"><?php echo 'From: '.$getreprow['rpt_usr_email']; ?></small>
                                    </div>
                                </div> <!-- media -->

                                <p>
                                <?php 
								echo $getreprow['rpt_usr_problem'];
							
								?>
                                </p>

                                <hr/>
<h3 align="center" >Add a reply</h3>
 <div class="media">
                                    <a href="#" class="pull-left">
                                        <img alt="" src="img/avatar-3.jpg" class="media-object thumb-sm">
                                    </a>
                                    <div class="media-body">
<textarea name="report_resolved_text" class="wysihtml5 form-control" style="resize:vertical" placeholder="Reply here..."></textarea>
                                    </div>
                                    
                                    <br>
<button type="submit" class="btn btn-success" >Send the  Email and resolve the Issue</button>
                                </div>
                              
                            
                            </div> <!-- panel-body -->
                        </div> <!-- End panel -->
                        <!-- End message -->

                      
                    </div> <!-- Col-->
                
                </div>
                </form>
	
	<?php
	
	$hashercounter++;
    }
} else {
    echo "No reports found";
}
?>

                <!-- End row -->

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
	  get_end_script();
	  ?>
      
            
              <!--form validation-->
        <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

        <script>
            jQuery(document).ready(function(){
                $('.wysihtml5').wysihtml5();
            });
        </script>
 
        

    </body>

</html>
