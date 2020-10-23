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
                    <h3 class="title">Enquires from Contact us Section</h3> 
                </div>

<?php
/*
SELECT * FROM `mun_reports` mr
left join mun_rec mm on mr.rpt_usr_rel_mun_id =  mm.mun_id 
WHERE mr.rpt_valid =1 and mm.mun_valid =1  */

?>
<?php 

$getconts = "SELECT * FROM `mun_mails` where ml_read = 0 and ml_valid = 1 order by mun_time DESC";
$getconts  = $conn->query($getconts);

if ($getconts ->num_rows > 0) {
    $hashercounter = 1;
    // output data of each row
    while($contactm= $getconts->fetch_assoc()) {
 	?>
    <form action="master_action.php" method="post">
    <input type="hidden" name="resolved_contact_hash" value="<?php echo md5(sha1(md5(md5($contactm['ml_id'].'inyc54u569tyi47ct74wv74g57t y74e5yt734y5t98vr7nti5veni7i')))) ?>" />
    <input type="hidden" name="resolved_contact_t" value="<?php echo '3'; ?>" />
    <div class="row">
                    <div class="col-sm-12">
                        

                        <!-- Message -->
                        <div class="panel panel-default m-t-20">
                            <div class="panel-heading"> 
                                <h3 class="panel-title"><?php echo $contactm['ml_subject']; ?></h3> 
                            </div>
                            <div class="panel-body">
                                <div class="media m-b-30 ">
                                    <a href="#" class="pull-left">
                                        <img alt="" src="img/avatar-2.jpg" class="media-object thumb-sm">
                                    </a>
                                    <div class="media-body">
                                        <span class="media-meta pull-right"><?php echo date('dS M, Y @ H:i:s',$contactm['mun_time']); ?></span>

                                        <h4 class="text-primary m-0"><?php echo $contactm['ml_from_name']; ?></h4>
                                        <small class="text-muted"><?php echo 'From: '.$contactm['ml_from_email']; ?></small>
                                    </div>
                                </div> <!-- media -->

                                <p>
                                <?php 
								echo $contactm['ml_body'];
							
								?>
                                </p>

                                <hr/>
<h3 align="center" >Add a reply</h3>
 <div class="media">
                                   
                                    <div class="media-body">
<textarea name="resolved_contact_text" class="wysihtml5 form-control" style="resize:vertical" placeholder="Reply here..."></textarea>
                                    </div>
                                    
                                    <br>
<button type="submit" class="btn btn-success" >Send an Email for the Enquiry</button>
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
    echo "No Enquiries found";
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
