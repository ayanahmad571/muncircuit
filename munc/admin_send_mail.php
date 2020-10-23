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



                 <!-- end row -->

                <div class="row">
                    
                    <!-- Left sidebar -->
                    
                    <!-- Left sidebar -->
                    
                    <!-- Right Sidebar -->
                                                    <form action="master_action.php" method="post" role="form">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="btn-toolbar" role="toolbar">
                                    <h3 class="pull-left m-t-5 m-b-0">Compose Mail</h3>
                                    <div class="pull-right">
                                        <button type="reset" class="btn btn-danger m-r-5"><i class="fa fa-trash-o"></i></button>
                                        <button type="submit" class="btn btn-purple"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-default m-t-20">
                            <div class="panel-body p-t-10">
                                <p class="text-muted">You will be sent a copy of this Email (Bcc)</p>
                                    <div class="form-group">
                                        <input name="ml_s_to" required type="email" class="form-control" placeholder="To">
                                    </div>
                                    <div class="form-group">
                                        <input name="ml_s_subj" required type="text" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="ml_s_txt" required class="wysihtml5 form-control" placeholder="Message body" style="height: 200px"></textarea>
                                    </div>
                            </div> <!-- panel -body -->
                        </div> <!-- panel -->
                    </div> <!-- End Rightsidebar -->
                    </form>
                
                </div> <!-- End row -->


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            
            
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
