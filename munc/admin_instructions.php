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

                <script src="js/jquery.js"></script>

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
                                <h3 class="panel-title">Manage Instructions/Getting Started</h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <!-- -->
                                         <?php

$boxsql = "SELECT *,(select count(*) from mun_ins_rel where inr_rel_in_id = in_id) as sum_count
 FROM `mun_instrcs_master`";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		echo '
		<div class="col-xs-12">
                        <div ';
		if($boxrw['in_valid']==1){
				echo '
style="border:5px solid green" ';
			}else{
				echo'
style="border:4px solid red" ';
			}
			
		echo' class="panel">
                            <div class="panel-body p-t-10">
                                <div class="media-main">
                                    
                                    <div class="pull-right btn-group-sm">
                                        <a  data-toggle="modal" data-target="#'.md5(md5(sha1($boxrw['in_id']))).'" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        
                                    </div>
                                    <div class="info">
                                        <h4>'.($boxrw['in_name']).'</h4>
                                        <p class="text-muted">
											Total Valid Instructions: '.$boxrw['sum_count'].'<br>
											Is Valid: '.$boxrw['in_valid'].'
										</p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
								<ol style="list-style-type:upper-roman">
								';
$inssql = "SELECT * from mun_ins_rel where inr_rel_in_id = ".$boxrw['in_id']."";
$insres = $conn->query($inssql);

if ($insres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($insrw = $insres->fetch_assoc()) {
		if($insrw['inr_valid'] == 1){
			echo '<li style="margin:10px;border-radius:10px; border:green 5px solid">';
		}else{
			echo '<li style="margin:10px;border-radius:10px; border:red 5px solid"">';

		}
		echo '<h3 class="'.$insrw['inr_link_icon'].'"></h3>
		
		<p>	'.$insrw['inr_text'].'</p>';
			
			if($insrw['inr_valid']==1){
				echo '
		<form action="master_action.php" method="post">
		<input name="inr_mk_inac_ha" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($insrw['inr_id'].
		'egkjtnr newsdnjjennjwhuirb3gjwfsn23qw@$%Tfkvijwsardvnkorvfk')))))).'" />
			<input type="submit" class="btn btn-danger" name="inr_mk_inac" value="Remove" />
		</form>
';
			}else{
				echo'
		<form action="master_action.php" method="post">
		<input name="inr_mk_ac_ha" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($insrw['inr_id'].'jijnfiirj3woi#esrgujrvoiejs4rijfkvnkorvfk')))))).'" />
		<input type="submit" class="btn btn-success" name="inr_mk_ac" value="Revive" />
		</form>';
			}
			echo'
			<img class="img-rounded img-responsive" src="'.$insrw['inr_image_src'].'" />
			<br>

			</li>';
			
		
	}
	
}else{
	echo '<li>No Instructions Added to this topic</li>';
}
								echo'
								</ol>
								<div class="row">
			';
			if($boxrw['in_valid']==1){
				echo '
<hr style="border-bottom:6px solid green;border-radius:5px">';
			}else{
				echo'
<hr style="border-bottom:6px solid red;border-radius:5px">';
			}
			
			if($boxrw['in_valid']==1){
				echo '
		<form action="master_action.php" method="post">
		<input name="in_mk_inac_ha" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['in_id'].
		'egkjtnr newsdnjjenfkvijfkorkvnkorvfk')))))).'" />
			<input type="submit" class="btn btn-danger" name="in_mk_inac" value="Make InActive" />
		</form>
';
			}else{
				echo'
		<form action="master_action.php" method="post">
		<input name="in_mk_ac_ha" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['in_id'].'jijnfiirjfnirokijfkvnkorvfk')))))).'" />
		<input type="submit" class="btn btn-success" name="in_mk_ac" value="Make Active" />
		</form>';
			}
			echo'</div>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div>
					
					
                                        
	
</div><div class="row">';
	
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?> 
</div>

<div class="row">

<div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-body p-t-10">
                                <div class="media-main">
                                    <div class="info">
                                        <h4>Add Set of Instructions</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

<div class="row">
    <form action="master_action.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-md-2 control-label">Instruction's Topic:</label>
        <div class="col-md-10">
            <input type="text" name="add_ins_topic" required class="form-control" placeholder="Some topic...">
            <span class="help-block"><small>Eg: Siging in or Signing up </small></span>
        </div>
    </div>
 <div class="info">
 <hr />

  <h4>Add Instructions within this topic</h4>
 </div>    
    
  <hr>  
   <?php /*
 ###
    
    33
 */ ?>
<div id="dependants_entry1" class="clonedInput2">
                        
                        <div class="row">
                        	<div class="col-sm-1">
                            	<div class="form-group">
                            	  <label>SL.</label>
                                  <input disabled name="add_inr_topic_rel_id" id="add_inr_topic_rel_id" type="text"  value="1" class="add_inr_topic_rel_id disabled  form-control"  />
                                </div>
                            </div>
                            <div class="col-sm-3">
                            	<div class="form-group">
                            	  <label>Instruction*</label>
                                  <input required name="add_inr_inst" id="add_inr_inst" placeholder="Do this and then Do this" type="text" value="" class="add_inr_inst form-control"   />
                                </div>
                            </div>
                            <div class="col-sm-4">
                            	<div class="form-group">
                                    <label>Icon*</label>
                                    <input required name="add_inr_inst_ico" id="add_inr_inst_ico" type="text" placeholder="fa fa-dog" value="" class="add_inr_inst_ico form-control"  />
                                </div>
                            </div>
                            <div class="col-sm-3">
                            	<div class="form-group">
                                    <label>Image</label>
                                    <input name="add_inr_inst_img" id="add_inr_inst_img" type="file" accept="image/*" class="add_inr_inst_img form-control" />
                                </div>
                            </div>
                        </div>

</div>

<div class="row">
    <div align="left" class=" col-sm-4 ">
        <div id="addDelButtons2">
          <input style="border-radius:10px" type="button" id="btnAdd2" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel2" value="Remove" class="btn btn-danger">
        </div> 
    </div>
</div>  


<hr>
<input type="submit" class="btn btn-md btn-success" name="add_instruction" value="Add Instruction" />

    </form>
</div>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div>

 </div>   <!--SL ROW ENDS -->                                </div>
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

$msql = "SELECT *,(select count(*) from mun_ins_rel where inr_rel_in_id = in_id) as sum_count
 FROM `mun_instrcs_master`";
$mres = $conn->query($msql );
$ogive = 1;
if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		echo '
<div id="'.md5(md5(sha1($mrw['in_id']))).'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-full">

    <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editing <u><i><strong>'.$mrw['in_name'].'\'s</strong></i></u></h4>
      </div>
      <div class="modal-body">
	  <form action="master_action.php" method="post">
<br>
Currently there are '.$mrw['sum_count'].' Instructions.
<br>

    <div class="form-group">
        <label class="col-md-2 control-label">Instruction\'s Topic:</label>
        <div class="col-md-10">
            <input type="text" name="edit_ins_topic" required class="form-control" placeholder="Some topic..."
			value="'.$mrw['in_name'].'">
            <span class="help-block"><small>Eg: Siging in or Signing up </small></span>
        </div>
    </div>
 <div class="info">
 <hr />

  <h4>Edit Instructions within this topic</h4>
 </div>    
    
  <hr>  


	';
	$mures = $conn->query("SELECT * from mun_ins_rel where inr_rel_in_id = ".$mrw['in_id']."");

if ($mures->num_rows > 0) {
    // output data of each row
$oeijg = 1;
$ove = 1;
    while($murw = $mures->fetch_assoc()) {
		if($oeijg == 1){
			$numm = '';
		}else{
			$numm = $oeijg;
		}
		echo '<div id="'.$ogive.'entry'.$ove.'" class="'.$ogive.'clonedInput">
                        
                        <div class="row">
                        	<div class="col-sm-1">
                            	<div class="form-group">
                            	  <label>SL.</label>
                                  <input disabled name="edit_inr_topic_rel_id" id="'.$ogive.'edit_inr_topic_rel_id'.$numm.'" type="text"  value="'.$ove.'" class="'.$ogive.'edit_inr_topic_rel_id disabled  form-control"  />
                                </div>
                            </div>
                            <div class="col-sm-3">
                            	<div class="form-group">
                            	  <label>Instruction*</label>
                                  <input required name="edit_inr_inst'.$numm.'" id="'.$ogive.'edit_inr_inst'.$numm.'" placeholder="Do this and then Do this" type="text" for="'.$ogive.'edit_inr_inst'.$numm.'" value="'.$murw['inr_text'].'" class="'.$ogive.'edit_inr_inst form-control"   />
                                </div>
                            </div>
                            <div class="col-sm-4">
                            	<div class="form-group">
                                    <label>Icon*</label>
                                    <input required name="edit_inr_inst_ico'.$numm.'" id="'.$ogive.'edit_inr_inst_ico'.$numm.'" type="text" placeholder="fa fa-dog" value="'.$murw['inr_link_icon'].'" class="'.$ogive.'edit_inr_inst_ico form-control" for="'.$ogive.'edit_inr_inst_ico'.$numm.'"  />
                                </div>
                            </div>
                            <div class="col-sm-3">
                            	<div class="form-group">
                                    <label>Image Src</label>
                                    <input required name="edit_inr_inst_img'.$numm.'" id="'.$ogive.'edit_inr_inst_img'.$numm.'" type="text" placeholder="Link Path" value="';
									if(is_null($murw['inr_image_src'])){
										echo 'NULL';
									}else{
										echo $murw['inr_image_src'];
									}
									
										
									echo '" class="'.$ogive.'edit_inr_inst_img form-control" for="'.$ogive.'edit_inr_inst_img'.$numm.'" />
                                </div>
                            </div>
                        </div>

</div>
';
	$oeijg++;	
	$ove++;
			}
}else{
	echo '<option class="form-control">No Muns Found</option>';
}
	echo'
	



<div class="row">
    <div align="left" class=" col-sm-4 ">
        <div id="'.$ogive.'addDelButtons">
          <input style="border-radius:10px" type="button" id="'.$ogive.'btnAdd" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="'.$ogive.'btnDel" value="Remove" class="btn btn-danger">
        </div> 
    </div>
</div>  



<div class="row">
	<div class="col-xs-6">
	<input type="hidden" name="hash_cl_d" value="'.md5(md5(sha1(sha1(md5(md5($mrw['in_id'].'jhoubih4wiuheuf8rhbu8ifbnn njenjn')))))).'"></input>
		<input name="edit_instructions" style="float:right" type="submit" class="btn btn-success" value="Save" />
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
	?>
    
<script type="text/javascript">
    $(function () {
    $('#<?php echo $ogive ;?>btnAdd').click(function () {
        var num     = $('.<?php echo $ogive ;?>clonedInput').length, // Checks to see how many "duplicatable" input fields we currently have
             newNum  = new Number(num + 1),      // The numeric ID of the new input field being added, increasing by 1 each time
            newElem = $('#<?php echo $ogive ;?>entry' + num).clone().attr('id', '<?php echo $ogive ;?>entry' + newNum).fadeIn('slow'); 
			
			   
			
			// create the new element via clone(), and manipulate it's ID using newNum value
    
    /*  This is where we manipulate the name/id values of the input inside the new, cloned element
        Below are examples of what forms elements you can clone, but not the only ones.
        There are 2 basic structures below: one for an H2, and one for form elements.
        To make more, you can copy the one for form elements and simply update the classes for its label and input.
        Keep in mind that the .val() method is what clears the element when it gets cloned. Radio and checkboxes need .val([]) instead of .val('').
    */
  // dependants_name - text

        newElem.find('.<?php echo $ogive ;?>edit_inr_topic_rel_id').attr('id', '<?php echo $ogive ;?>edit_inr_topic_rel_id' + newNum).attr('value', 'edit_inr_topic_rel_id' + newNum).val(newNum);



        newElem.find('.<?php echo $ogive ;?>edit_inr_inst').attr('for', '<?php echo $ogive ;?>edit_inr_inst' + newNum);
        newElem.find('.<?php echo $ogive ;?>edit_inr_inst').attr('id', '<?php echo $ogive ;?>edit_inr_inst' + newNum).attr('name', 'edit_inr_inst' + newNum).val('');


        // dependants_dob - text
        newElem.find('.<?php echo $ogive ;?>edit_inr_inst_ico').attr('for', '<?php echo $ogive ;?>edit_inr_inst_ico' + newNum);
        newElem.find('.<?php echo $ogive ;?>edit_inr_inst_ico').attr('id', '<?php echo $ogive ;?>edit_inr_inst_ico' + newNum).attr('name', 'edit_inr_inst_ico' + newNum).val('');

        // dependants_relationship - text
        newElem.find('.<?php echo $ogive ;?>edit_inr_inst_img').attr('for', '<?php echo $ogive ;?>edit_inr_inst_img' + newNum);
        newElem.find('.<?php echo $ogive ;?>edit_inr_inst_img').attr('id', '<?php echo $ogive ;?>edit_inr_inst_img' + newNum).attr('name', 'edit_inr_inst_img' + newNum).val('NULL');
		 /* AYAN AHAD AIS A NEW ATAB 
		 */
		

		
		


    // Insert the new element after the last "duplicatable" input field
        $('#<?php echo $ogive ;?>entry' + num).after(newElem);
        $('#ID' + newNum + '_title').focus();

    // Enable the "remove" button. This only shows once you have a duplicated section.
        $('#<?php echo $ogive ;?>btnDel').attr('disabled', false);

    // Right now you can only add 4 sections, for a total of 5. Change '5' below to the max number of sections you want to allow.
        if (newNum == 30)
        $('#<?php echo $ogive ;?>btnAdd').attr('disabled', true).prop('value', "You've reached the limit"); // value here updates the text in the 'add' button when the limit is reached 
    });

    $('#<?php echo $ogive ;?>btnDel').click(function () {
    // Confirmation dialog box. Works on all desktop browsers and iPhone.
        if (confirm("Are you sure you wish to remove this section? This cannot be undo."))
            {
                var num = $('.<?php echo $ogive ;?>clonedInput').length;
                // how many "duplicatable" input fields we currently have
                $('#<?php echo $ogive ;?>entry' + num).slideUp('slow', function () {$(this).remove();
                // if only one element remains, disable the "remove" button
                    if (num -1 === 1)
                $('#<?php echo $ogive ;?>btnDel').attr('disabled', true);
                // enable the "add" button
                $('#<?php echo $ogive ;?>btnAdd').attr('disabled', false).prop('value', "Add More");});
            }
        return false; // Removes the last section you added
    });
    // Enable the "add" button
    $('#<?php echo $ogive ;?>btnAdd').attr('disabled', false);
    // Disable the "remove" button
    $('#<?php echo $ogive ;?>btnDel').attr('disabled', true);
});




</script>
    <?php
	#first loop ends

$ogive++;    }
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
	  get_end_script_nojs();
	  ?>   
       <script src="assets/timepicker/bootstrap-datepicker.js"></script>
       <script src="js/clone-form-td.js"></script>


<script>
$(document).ready(function() {
	$('.datepicker').datepicker();		
});
</script>
      
           </body>

</html>
