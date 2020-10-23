<?php 

include('include.php');
?>
<?php 
include('page_that_has_to_be_included_for_every_user_visible_page.php');
?>
<?php
$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
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
    
<!-- the manprofile.htmlby ayan ahmad 07:31:23 GMT -->
<head>
        <?php get_head(); ?>
    <!-- Dropzone css -->
    <link href="assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />

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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title">Form elements</h3>
                            <h6 class="text-muted" style="color:rgba(38,140,7,1.00)">Every mun added by you will be available to edit in the My Muns Tab</h6>
                            </div>
                            <div class="panel-body">
                                <form enctype="multipart/form-data" action="master_action.php" method="post" class="form-horizontal" role="form">                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">MUN Shortname</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_sn" placeholder="ABCMUN" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">MUN Logo</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_lo" type="file" accept="image/*" class="form-control file">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">MUN Fullname</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_ln" placeholder="Aeroi Biof Centro Model United Nations" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">MUN Year</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_yr" placeholder="2015" type="number" class="form-control" value="<?php echo date('Y',time()) ?>" min="<?php echo (date('Y',time()) - 4) ?>" max="<?php echo (date('Y',time()) +1) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">MUN Email</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_eml" placeholder="master@abcmun.com"  type="email" id="example-email" class="form-control" />
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-2 control-label">MUN Website</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_webs" placeholder="Without http:// eg:abcmun.com" type="text" class="form-control"><span class="help-block"><small>Enter the url without http:// or https:// fro example "abcmun.com".</small></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">MUN Contact Number</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_mobs" placeholder="9876543210" type="text" class="form-control"><span class="help-block"><small>Enter mobile Number with code for eg: <strong>0091</strong>9876543210 .</small></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">MUN Hostedat</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_hstdat" placeholder="Instution's Name" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">MUN Hostedat Address</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_hstdadd" placeholder="Instution's Address" type="text" class="form-control"><span class="help-block"><small>Enter full address of the institution or the place this MUN is being in eg A-12 SECTOR-9009, Noida, 201301.</small></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Latitude of Institution</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_ins_lat" placeholder="22.265" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Longitude of Institution</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_ins_lng" placeholder="72.522" type="text" class="form-control">
                                        </div>
                                    </div>
                                    
                                  
                                       <div class="form-group">
                                        <label class="col-md-2 control-label">Country</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_country" placeholder="india" type="text" class="form-control">
                                        </div>
                                    </div>
                                    
                                    
                                      
                                                                       
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Start Date</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_stdt" placeholder="Click to select" type="text" class="form-control datepicker">
                                        </div>
                                    </div>    
                                                                        
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">End Date</label>
                                        <div class="col-md-10">
                                            <input required name="u_add_m_m_endt" placeholder="Click to select" type="text" class="form-control datepicker">
                                        </div>
                                    </div>    
                                    
                                         
                                    
                                    <div class="form-group">
                                         <label class="col-md-2 control-label"></label>
<div class="col-md-10">
                                        
                                            <input required name="u_add_m" type="submit" class="btn btn-success" value="Add MUN"><br>
<span class="help-box"><small>By <strong>Clicking this Box</strong> you thereby agree to all the terms and conditions of Muncircuit and Muncircuit will not be responsible for any mishap.</small></span>
                                        </div>
                                    </div>    
                                    
                                                                    
                                    
                                                                                                            
                                

                                    
                   
                                </form>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->
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
	  get_end_script();
	  ?>
 <script src="assets/timepicker/bootstrap-datepicker.js"></script>

      <script>

            $(document).ready(function() {
                    
        
                $('.datepicker').datepicker({
    
});
				
				

			});
			
      </script>
 
  </body>

<!-- the manprofile.htmlby ayan ahmad 07:31:23 GMT -->
</html>