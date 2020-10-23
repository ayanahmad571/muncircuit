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
	
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>
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
                    <h2 class="title">It's <?php echo date('dS M, Y',time()); ?></h2> 
                </div>




                 <!-- end row -->


                 <!-- End row -->



                <div class="row">
                     <!-- end col -->
                     <form role="form" action="master_action.php" method="post">
                     
                     
                     <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="btn-toolbar" role="toolbar">
                                    <div class="pull-right">
                                      
                                        <button type="reset" class="btn btn-success m-r-5"><i class="fa fa-trash-o"></i></button>
                                        <button type="submit" class="btn btn-purple"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-default m-t-20">
                            <div class="panel-body p-t-10">
                                
                                
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <?php
											if($login == 1){
												$e_eml = $_USER['lum_email'];
												$e_nm = ucwords($_USER['usr_name']);
												
											}else{
												$e_eml ='';
												$e_nm = '';
											}
											?>
                                                <input name="from_email" type="email" class="form-control" value="<?php echo $e_eml ?>" placeholder="Your Email ">
                                            </div>
                                            <div class="col-md-6">
                                                <input name="from_name" type="text" class="form-control" value="<?php echo $e_nm ?>" placeholder="Your Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="subj_ml" type="text" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message_ml" class="form-control" placeholder="Message body" style="height: 200px"></textarea>
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
      
      
    </body>

</html>
