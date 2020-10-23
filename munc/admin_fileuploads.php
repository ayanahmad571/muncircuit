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
        <link href="assets/dropzone/dropzone.css" rel="stylesheet" type="text/css" />

        
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
                                <h3 class="panel-title">Manage FileUploads</h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
<div class="wraper container-fluid">

                <div class="row">
                    <div class="col-md-12 portlets">
                        <!-- Your awesome content goes here -->
                        <div class="m-b-30">
                            <form action="master_action.php" method="post" class="dropzone" id="dropzone">
                              <div class="fallback">
                                <input name="file_action" type="file" multiple />
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
        <script src="assets/dropzone/dropzone.min.js"></script>
      
           </body>

</html>
