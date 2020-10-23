<?php 

include('include.php');
?>
<?php 
include('page_that_has_to_be_included_for_every_user_visible_page.php');
?>
<?php


$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
if(($ip=='::1') or (strpos($ip,'192.168.1.40') === true)){
	
}
$ip="122.177.159.179";
$url = "http://freegeoip.net/json/".$ip;
$ch  = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);

if ($data) {
    $location = json_decode($data);

    $lat = $location->latitude;
    $lon = $location->longitude;

    $sun_info = date_sun_info(time(), $lat, $lon);
}else{
	die('Please Reload');
}
##
$dist = 25;
##
?>
<?php 
if(isset($_POST['mun_search'])){
	
	$iehgvuebgujveijtbiuhrijbtiuediutjbiurhtdj =1;
	##
	
	$sql = "SELECT *, 
    ( 6371 * acos( cos( radians(".$lat.") ) 
                   * cos( radians( `mun_lat` ) ) 
                   * cos( radians( `mun_long` ) 
                       - radians(".$lon.") ) 
                   + sin( radians(".$lat.") ) 
                   * sin( radians( `mun_lat` ) ) 
                 )
   ) AS distance 
FROM mun_rec 
where 
(mun_shortname sounds like '%".$_POST['mun_search']."%') or (mun_fullname sounds like '%".$_POST['mun_search']."%') and 
 mun_year > ".(date('Y',time())-3)." and 
 mun_year < ".(date('Y',time())+3)." and 
 mun_country='".strtolower($location->country_name)."'

ORDER BY distance,mun_from LIMIT 1000";
	##
	
}else if(isset($_GET['mun_int'])){
			$sql = "SELECT *, 
    ( 6371 * acos( cos( radians(".$lat.") ) 
                   * cos( radians( `mun_lat` ) ) 
                   * cos( radians( `mun_long` ) 
                       - radians(".$lon.") ) 
                   + sin( radians(".$lat.") ) 
                   * sin( radians( `mun_lat` ) ) 
                 )
   ) AS distance 
FROM mun_rec 
where mun_year > ".(date('Y',time())-3)." and mun_year < ".(date('Y',time())+3)." and mun_country !='".strtolower($location->country_name)."'
ORDER BY distance,mun_from LIMIT 1000";

}else{
	$sql = "SELECT *, 
    ( 6371 * acos( cos( radians(".$lat.") ) 
                   * cos( radians( `mun_lat` ) ) 
                   * cos( radians( `mun_long` ) 
                       - radians(".$lon.") ) 
                   + sin( radians(".$lat.") ) 
                   * sin( radians( `mun_lat` ) ) 
                 )
   ) AS distance 
FROM mun_rec 
where mun_year > ".(date('Y',time())-3)." and mun_year < ".(date('Y',time())+3)." and mun_country='".strtolower($location->country_name)."'
ORDER BY distance,mun_from LIMIT 1000";
}


$result = $conn->query($sql);
$muns = array();
if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		$muns[] = $row;
    }
} else {
    /*
 $muns[] = array('mo_id'=>'948755492537429837545293764',
	'mun_shortname'=>'None',
	'mun_year'=>'0000',
	'mun_img_src'=>'../',
	'mun_fullname'=>'No Muns Found',
	'mun_hostedat'=>'-',
	'mun_hosted_addr'=>'-',
	'mun_website'=>'-',
	'mun_country'=>'-',
	'mun_lat'=>'0',
	'mun_long'=>'0',
	'mun_from'=>'0',
	'mun_till'=>'0',
	'mun_contact_no'=>'0',
	'mun_iden_color'=>'white',
	'mun_text'=>'white',
	'mun_valid'=>'1',);

 */ }

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
               <link href="assets/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <link href="assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">
        
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
                    <h2 class="title">It's <?php echo date('dS M, Y',time()); ?></h2> 
                </div>


<?php
$mun_closed = array(0=>'ongoingmun',1=>'upcomingmun',2=>'nearmun',3=>'pastmun');
$pastmun=array();
$ongoingmun=array();
$upcomingmun=array();
$nearmun=array();
$jsvar = array();
if(!count($muns) >0){
	die('Nothing to show here <br><a href="index.php"><button class="btn btn-info">Go Back</button></a');
}
foreach($muns as $mun){
	
	if((time() <= $mun['mun_till']) and (time() >= $mun['mun_from'])){
		$ongoingmun[] = $mun;
	}else{
		if(time() >= $mun['mun_till']){
			#past
			$pastmun[] = $mun;

		}else if(time() <= $mun['mun_from']){
			#upcoming
			$upcomingmun[] = $mun;
					}
		
		
		
	}
	
	if(($mun['distance'] <35.1) and ((time() <= $mun['mun_till']) and (time() >= $mun['mun_from']))){
		$nearmun[] = $mun;
	}
	
	
	
	$jsvar[] ="    {
                        title: '".$mun['mun_fullname']."',
                        start: new Date(".date('Y',trim($mun['mun_from'])).", ".(date('n',trim($mun['mun_from']))-1).", ".date('j',trim($mun['mun_from'])).",".(1*date('H',trim($mun['mun_from']))).",".(1*date('i',trim($mun['mun_from'])))."),
						
                        end: new Date(".date('Y',trim($mun['mun_till'])).", ".(date('n',trim($mun['mun_till']))-1).", ".date('j',trim($mun['mun_till'])).",".(1*date('H',trim($mun['mun_till']))).",".(1*date('i',trim($mun['mun_till'])))."),
                        url: 'amun.php?mun=".md5(sha1($mun['mun_id'].'HGYURBVFRBRGWIOGRU92UWHFGOIWHTOGIUEO8HG384IWGOIRHWGIUHREJFGKN'))."',
						color:'".$mun['mun_iden_color']."'
                    }
					
					";
	
	
}

 /*
var_dump($pastmun);
var_dump($ongoingmun);
var_dump($upcomingmun);
var_dump($nearmun	);
 */ 


?>

<?php
if(!isset($iehgvuebgujveijtbiuhrijbtiuediutjbiurhtdj)){
	?>
    <div class="row">
    <div class="col-xs-6"><form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
    <input align="left" value="Local MUN's" type="submit" name="mun_normal" class="btn btn-primary" />
    </form></div>
    <div align="right" class="col-xs-6"><form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
    <input align="right" value="International MUN's" type="submit" name="mun_int" class="btn btn-info" />
    </form></div>
    </div><br>
<br>

    <?php
}else{
?>
 <div class="row">
    <div class="col-xs-6">
    <a href="home.php" class="btn btn-lg btn-success">Go Back</a></div>
  
    </div>
<br>
<br>

<?php

}
?>



                
<?php
if(!isset($iehgvuebgujveijtbiuhrijbtiuediutjbiurhtdj)){
	?><div class="row">
              
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 white-bg">
                            <h2 class="m-0 counter"><?php echo count($pastmun) ?></h2>
                            <div>Past MUN's</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 white-bg">
                            <h2 class="m-0 counter"><?php echo count($ongoingmun) ?></h2>
                            <div>Ongoing</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 white-bg">
                            <h2 class="m-0 counter"><?php echo count($upcomingmun) ?></h2>
                            <div>Upcoming</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 white-bg">
                            <h2 class="m-0 counter"><?php echo count($nearmun) ?></h2>
                            <div>Ongoing and Upcoming Within 25kms</div>
                        </div>
                    </div>
                </div> <!-- end row -->
    <div class="row">
  <div id='calendar' class="visible-lg visible-md  col-xs-12"></div>
</div><br>
<br>
    <?php
}
?>


                 <!-- End row -->



                <div class="row">
                     <!-- end col -->
<?php 

foreach($mun_closed as $field){
if(count($$field) == 0){
	continue;
}
$xxx=1;	
$yyy=1;	
	?>
     <div class="col-lg-6">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    <?php echo strtoupper($field )?>
                                </h3>
                               
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Short Name</th>
                                                    <th>Long Name</th>
                                                    <th>From</th>
                                                    <th>Till</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
    
    <?php
	foreach($$field as $sub_mun){
		?>
         <tr>
                                                    <td><?php echo $xxx ?></td>
                                                    <td><?php echo $sub_mun['mun_shortname'] ?></td>
                                                    <td><?php echo $sub_mun['mun_fullname'] ?></td>
                                                    <td><?php echo date('d M, Y',trim($sub_mun['mun_from'])) ?></td>
                                                    <td><?php echo date('d M, Y',trim($sub_mun['mun_till'])) ?></td>
                                                    <td><u><i><a href="amun.php?mun=<?php echo md5(sha1($sub_mun['mun_id'].'HGYURBVFRBRGWIOGRU92UWHFGOIWHTOGIUEO8HG384IWGOIRHWGIUHREJFGKN')) ?>">
													<button class="btn btn-info">View</button>
                                                    </a></i></u></td>
                                                </tr>
        <?php
	$xxx++;}?>
    
    
         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
	<?php
	
	if($yyy%2 ==0){
		echo '</div><div class="row">';
	}
	
	$yyy++;
}
?>
                   
                                               

                                               
                                           

                    
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
      
            
         <script src="assets/fullcalendar/moment.min.js"></script>
        <script src="assets/fullcalendar/fullcalendar.min.js"></script>
        <!--dragging calendar event-->
<script>
!function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples 
    SweetAlert.prototype.init = function() {
        
<?php 

if(isset($_GET['mailsent'])){
	echo ' $(document).ready(function(){
        swal("Mail Sent!", "An Email regarding the issue has been sent . You will get a reply to the specified email within a few days", "success")
    });';
}
?>
    //Success Message
   


    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);
</script>

 
        <script>


!function($) {
    "use strict";

    var CalendarPage = function() {};

    CalendarPage.prototype.init = function() {

        //checking if plugin is available
        if ($.isFunction($.fn.fullCalendar)) {
            /* initialize the external events */
            $('#external-events .fc-event').each(function() {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });
            
            /* initialize the calendar */

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }

                },
                events: [
				
                  
                   
                    
                    <?php echo implode(',',$jsvar); ?>
					
					
					
					]
            });
            
             /*Add new event*/
            // Form to add new event

            $("#add_event_form").on('submit', function(ev) {
                ev.preventDefault();

                var $event = $(this).find('.new-event-form'),
                    event_name = $event.val();

                if (event_name.length >= 3) {

                    var newid = "new" + "" + Math.random().toString(36).substring(7);
                    // Create Event Entry
                    $("#external-events").append(
                        '<div id="' + newid + '" class="fc-event">' + event_name + '</div>'
                    );


                    var eventObject = {
                        title: $.trim($("#" + newid).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $("#" + newid).data('eventObject', eventObject);

                    // Reset draggable
                    $("#" + newid).draggable({
                        revert: true,
                        revertDuration: 0,
                        zIndex: 999
                    });

                    // Reset input
                    $event.val('').focus();
                } else {
                    $event.focus();
                }
            });

        }
        else {
            alert("Calendar plugin is not installed");
        }
    },
    //init
    $.CalendarPage = new CalendarPage, $.CalendarPage.Constructor = CalendarPage
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.CalendarPage.init()
}(window.jQuery);

		</script>
        



    </body>

</html>
