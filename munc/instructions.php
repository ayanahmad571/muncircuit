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
           
           
                  
           <?php 
		   if(isset($_POST['ins_f'])){
			   if(ctype_alnum($_POST['ins_f'])){
##
$getins_top = "SELECT * FROM `mun_instrcs_master` WHERE in_valid =1 and md5(sha1(md5(sha1(md5(concat(in_id,'jrfneuguj3gbgjtjgutjj4jb4jhb chrhu ub thgu0 h3humh9t 5hu9 ghu')))))) ='".$_POST['ins_f']."'";
$getins_top = $conn->query($getins_top);

if ($getins_top->num_rows > 0) {
    // output data of each row

    $getinsr_m = $getins_top->fetch_assoc();
	
	$id_ins = $getinsr_m['in_id'];
	?>
     <div class="page-title"> 
                    <h3 class="title">Getting Started Instructions for <?php echo $getinsr_m['in_name'] ?> !! </h3> 
                <br>
                <a href="instructions.php"><button class="btn btn-lg btn-danger" type="button"><i class="fa fa-arrow-left"></i></button></a>
</div>
    <?php
	#######4444####
	
			$getins_down = "SELECT * FROM `mun_ins_rel` WHERE inr_valid =1 and inr_rel_in_id = ".$id_ins." ";
		$getins_down = $conn->query($getins_down);
		
		if ($getins_down->num_rows > 0) {
			// output data of each row
			$jjjh =1;
			while($getins_d = $getins_down->fetch_assoc()){
				if(($jjjh % 2 )== 0){
					$altcount = ' class="timeline-inverted"';
				}else{
					$altcount = '';
				}
				?>
                
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="timeline">
                            <li <?php echo $altcount ?>>
                                <div class="timeline-badge warning"><i class="<?php echo $getins_d['inr_link_icon']; ?>"></i>
                                </div>
                                <div class="timeline-panel">
                                    
                                    <div class="timeline-body">
                                        <p><?php echo $getins_d['inr_text']; ?></p>
                                        <p>
                                        <?php
										
										if(is_null($getins_d['inr_image_src'])){
											
										}else{
											echo '<div class="row">';
											echo '<div class="col-xs-10 col-xs-offset-1">';
											echo '<img onClick="window.location = \''.$getins_d['inr_image_src'].'\'" src="'.$getins_d['inr_image_src'].'" class="img-responsive"/>';
											echo '</div>';
											echo '</div>';
											}
?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            
                            
                           
                           
                            
                        </ul>
                    </div>
                </div>
                
                
                <?php
				$jjjh++;
			}
				
		}else{
			die('No Instruction\'s Found');
		}
	#######44443###
		
}else{
	die('No Instruction\'s Found');
}
##				   
			   }else{
				   die('Variable Passed invalid');
			   }
		   }else{
		   ?>
                <div class="page-title"> 
                    <h3 class="title">Getting Started Instructions !! </h3> 
                </div>
                  
                <div class="row">
                
                  <?php /*
  <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-body p-t-0">
                                <div class="input-group">
                                    <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                 */ ?>

                </div> <!-- End row -->

                <div class="row">
                <?php
$getins = "SELECT * FROM `mun_instrcs_master` WHERE in_valid =1 order by in_id asc";
$getins = $conn->query($getins);

if ($getins->num_rows > 0) {
    // output data of each row
	$jn = 0;
    while($getinsr = $getins->fetch_assoc()) {
		if(($jn % 2 )== 0){
			echo '</div><div class="row">';
		}
		?>
        
        <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <div class="media-main">
                                    
                                    <div class="info">
                                        <h4><?php echo $getinsr['in_name'] ?></h4>
<br>
<?php /*
                                        <p class="text-muted">Graphics Designer</p>
 */ ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <input name="ins_f" type="hidden" value="<?php echo md5(sha1(md5(sha1(md5($getinsr['in_id'].'jrfneuguj3gbgjtjgutjj4jb4jhb chrhu ub thgu0 h3humh9t 5hu9 ghu'))))) ?>" />
                                 <button type="submit" role="button"  class="btn btn-lg btn-info" >View</button>
                                </form>
                               
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div>
        
        <?php
		$jn++;
    }
} else {
    echo "No instruction's Available";
}
 ?> 

                     <!-- end col -->

                     <!-- end col -->

                     <!-- end col -->

                     <!-- end col -->


                </div> <!-- End row -->

              
<?php
		   }
?>

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
