





<!DOCTYPE html>
<html lang="en">

<head>

         <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Find all the Muns around the globe">
        <meta name="author" content="Ayan Ahmad">

        <link rel="shortcut icon" href="img/munc_logo.png">

        <title>The MUN Circuit</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/morris/morris.css">

        <!-- sweet alerts -->
        <link href="assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->               <link href="assets/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <link href="assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">
        
    </head>


    <body>

        <!-- Aside Start-->
        <aside class="left-panel">

            
        <!-- brand -->
            <div class="logo">
                
				<a href="#" class="logo-expanded">
                    <img style="align-self:center"  src="img/munc_logo@2.png" class="img-responsive" />
                </a>
            </div>
            <!-- / brand -->            <!-- Navbar Start -->
            <nav class="navigation">
                <ul class="list-unstyled">
<li ><a href="home.php"><i class="ion-home"></i> <span class="nav-label">Dashboard</span></a></li>
<li ><a href="myca.php"><i class="ion-person"></i> <span class="nav-label">My Account</span></a></li>
<li ><a href="contact.php"><i class="ion-email"></i> <span class="nav-label">Contact Us</span></a></li><li ><a href="reports.php"><i class="ion-flag"></i> <span class="nav-label">MUN Reports</span><span class="badge bg-success">0</span></a></li>
					
					
		
		<li ><a href="enquire.php"><i class="ion-help"></i> <span class="nav-label">Enquiries</span><span class="badge bg-purple">0</span></a></li>
					
					
		
		
<li ><a href="mymuns.php"><i class="fa fa-briefcase "></i> <span class="nav-label">My MUN'S</span></a></li>
<li ><a href="instructions.php"><i class="fa fa-list"></i> <span class="nav-label">Getting Started</span></a></li>
<li class="active"><a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Manage MUNs</span>
</a></li>
<li ><a href="admin_user.php"><i class="fa fa-users"></i> <span class="nav-label">Manage Users</span></a></li>
<li ><a href="admin_mods.php"><i class="fa fa-link"></i> <span class="nav-label">Manage Modules</span></a></li></ul>
            </nav>                
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
                <form action="/muncircuit/munc/admin_mun.php" method="post" role="search" class="navbar-left app-search pull-left hidden-xs ">
                  <input name="mun_search" type="text" placeholder="Search MUNS..." class="form-control">
                  <a href="#"><i class="fa fa-search"></i></a>
                </form>
                
                <!-- Left navbar -->
                <nav class=" navbar-default" role="navigation">
                    

                    <!-- Right navbar -->
                    <ul class="nav navbar-nav navbar-right top-menu top-right-menu">  
                        <!-- mesages -->  
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="fa fa-envelope-o "></i>
                                <span class="badge badge-sm up bg-purple count">4</span>
                            </a>
                            <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5001">
                                <li>
                                    <p>Messages</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><img src="img/avatar-2.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                        <span class="block"><strong>John smith</strong></span>
                                        <span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 seconds ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><img src="img/avatar-3.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                        <span class="block"><strong>John smith</strong></span>
                                        <span class="media-body block">New tasks needs to be done<br><small class="text-muted">3 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><img src="img/avatar-4.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                        <span class="block"><strong>John smith</strong></span>
                                        <span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <p><a href="inbox.html" class="text-right">See all Messages</a></p>
                                </li>
                            </ul>
                        </li>
                        <!-- /messages -->
                        <!-- Notification -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge badge-sm up bg-pink count">3</span>
                            </a>
                            <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
                                <li class="noti-header">
                                    <p>Notifications</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><i class="fa fa-user-plus fa-2x text-info"></i></span>
                                        <span>New user registered<br><small class="text-muted">5 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><i class="fa fa-diamond fa-2x text-primary"></i></span>
                                        <span>Use animate.css<br><small class="text-muted">5 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span>
                                        <span>Send project demo files to client<br><small class="text-muted">1 hour ago</small></span>
                                    </a>
                                </li>
                                
                                <li>
                                    <p><a href="#" class="text-right">See all notifications</a></p>
                                </li>
                            </ul>
                        </li>
                        <!-- /Notification -->

                        <!-- user login dropdown start-->
                        <li class="dropdown text-center">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="Ahmad Ayan prof_pic" src="img/prof_pics/4f737cb597cbe71f39fa8a65a9171464_P_8c085ef21531915b3b258b56825cee0d256a874957b81a9aedcc91471683226IMG_0706.JPG" class="img-circle profile-img thumb-sm">
                                <span class="username">Ahmad Ayan </span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                                <li><a href="myca.php"><i class="fa fa-briefcase"></i>Profile</a></li>
                                <li><a href="myca.php#edit-profile"><i class="fa fa-cog"></i> Settings</a></li>
                                   <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->       
                    </ul>                    
                    <!-- End right navbar -->
                </nav>
                
            </header>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
<pre class='xdebug-var-dump' dir='ltr'>
<b>array</b> <i>(size=22)</i>
  'lum_id' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'1'</font> <i>(length=1)</i>
  'lum_email' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'ayanzcap@hotmail.com'</font> <i>(length=20)</i>
  'lum_username' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'ydyaahah9'</font> <i>(length=9)</i>
  'lum_password' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'981b8673baa41f3506514b8c4b9662a0'</font> <i>(length=32)</i>
  'lum_hash_mix' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'d5eb5d7d28b41a5b9a942cad2b019980'</font> <i>(length=32)</i>
  'lum_ad' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'1'</font> <i>(length=1)</i>
  'lum_ad_level' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'10'</font> <i>(length=2)</i>
  'lum_valid' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'1'</font> <i>(length=1)</i>
  'usr_id' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'1'</font> <i>(length=1)</i>
  'usr_rel_lum_id' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'1'</font> <i>(length=1)</i>
  'usr_name' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'Ahmad Ayan'</font> <i>(length=10)</i>
  'usr_prof_pic' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'img/prof_pics/4f737cb597cbe71f39fa8a65a9171464_P_8c085ef21531915b3b258b56825cee0d256a874957b81a9aedcc91471683226IMG_0706.JPG'</font> <i>(length=124)</i>
  'usr_back_pic' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'img/circuit_def.jpg'</font> <i>(length=19)</i>
  'usr_dob_timestamp' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'994271400'</font> <i>(length=9)</i>
  'usr_iv' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'1098541894947705'</font> <i>(length=16)</i>
  'usr_reg_dnt' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'1469808108'</font> <i>(length=10)</i>
  'usr_reg_ip' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'::1'</font> <i>(length=3)</i>
  'usr_reg_country' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'india'</font> <i>(length=5)</i>
  'usr_lat' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'139.092'</font> <i>(length=7)</i>
  'usr_long' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'77.2167'</font> <i>(length=7)</i>
  'usr_validtill' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'0'</font> <i>(length=1)</i>
  'usr_valid' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'1'</font> <i>(length=1)</i>
</pre>                <div class="page-title"> 
                    <h3 class="title">Welcome Ahmad Ayan !</h3> 
                </div>



                 <!-- end row -->

                <div class="row">
                    

                    <div class="col-lg-12	">

                        <div class="panel panel-default"><!-- /primary heading -->
                            <div class="portlet-heading">
      
                            <div class="panel-heading">
                                <h3 class="panel-title">Mun(s)</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                   
                                    <br>


                                    
                                    <div class="row">
                                        <!-- -->
                                         
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">SBSMUN2016<span style="float:right">
			<a data-toggle="modal" data-target="#390154f2881922ec3bf905dfdba35b0b" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/sbsmun.png" alt="Step by Step Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">SBSMUN2016</h2> 
			<h3 align="center">Step by Step Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Step by Step School</p>
<p><strong>Hosted At Address:</strong> A-18 SECTOR 132 Noida</p>
<p><strong>Website: </strong>http://sbsmun.in</p>
<p><strong>Email:</strong> com.aa.ay@gmail.com</p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> 28.511652</p>
<p><strong>Longitude(Hosted):</strong> 77.3759523</p>
<p><strong>From: </strong>Sat,6th Aug 2016 @ 00:00:00 am</p>
<p><strong>Till: </strong>Wed,31st Aug 2016 @ 00:00:00 am</p>
<p><strong>Contact Number:</strong> 9818662200</p>
<p>
	<strong>Identification Colour:</strong>
	#000
	<i class="fa fa-circle pull-left" style="color:#000"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="2300674b86385f3aa2a75a005f32d8bb" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">ABCMUN2014<span style="float:right">
			<a data-toggle="modal" data-target="#5db6131eae1b1f00cb7152f2a96d05dd" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/sbsmun.png" alt="ABC Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">ABCMUN2014</h2> 
			<h3 align="center">ABC Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Step by Step School</p>
<p><strong>Hosted At Address:</strong> A-18 SECTOR 132 Noida</p>
<p><strong>Website: </strong>http://sbsmun.in</p>
<p><strong>Email:</strong> </p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> 28.64</p>
<p><strong>Longitude(Hosted):</strong> 77.16846845</p>
<p><strong>From: </strong>Thu,20th Mar 2014 @ 12:00:00 pm</p>
<p><strong>Till: </strong>Tue,25th Mar 2014 @ 12:00:00 pm</p>
<p><strong>Contact Number:</strong> 1204351362</p>
<p>
	<strong>Identification Colour:</strong>
	orange
	<i class="fa fa-circle pull-left" style="color:orange"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="e733fabb59fbe62d7b1020d17a94fa00" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	</div><div class="row">
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">DEFMUN2014<span style="float:right">
			<a data-toggle="modal" data-target="#867bca8e5aaf0b014edd91d5091f1555" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/sbsmun.png" alt="DEF  Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">DEFMUN2014</h2> 
			<h3 align="center">DEF  Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Step by Step School</p>
<p><strong>Hosted At Address:</strong> A-18 SECTOR 132 Noida</p>
<p><strong>Website: </strong>http://sbsmun.in</p>
<p><strong>Email:</strong> </p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> 26.43463462</p>
<p><strong>Longitude(Hosted):</strong> 77.12468654165</p>
<p><strong>From: </strong>Sun,20th Jul 2014 @ 12:00:00 pm</p>
<p><strong>Till: </strong>Fri,25th Jul 2014 @ 12:00:00 pm</p>
<p><strong>Contact Number:</strong> 1204351362</p>
<p>
	<strong>Identification Colour:</strong>
	red
	<i class="fa fa-circle pull-left" style="color:red"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="001fadfe6e4f7dde8981bb6ce604b4db" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">GHIMUN2015<span style="float:right">
			<a data-toggle="modal" data-target="#4f114bde07da0ace9300eae5b1cea6f8" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/e8234857445c89127624cece282a00c957b819cb7bb57_53355e7fad4a753f1920a78dfb4fff44.jpg" alt="GHI  Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">GHIMUN2015</h2> 
			<h3 align="center">GHI  Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Avengers Internation's</p>
<p><strong>Hosted At Address:</strong> Calafornina bay 5 'g //@!#$%^&*(</p>
<p><strong>Website: </strong>nadie.com</p>
<p><strong>Email:</strong> </p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> United States</p>
<p><strong>Longitude(Hosted):</strong> 77.185458</p>
<p><strong>From: </strong>Tue,20th Jan 2015 @ 00:00:00 am</p>
<p><strong>Till: </strong>Sun,25th Jan 2015 @ 00:00:00 am</p>
<p><strong>Contact Number:</strong> 1234567890</p>
<p>
	<strong>Identification Colour:</strong>
	yellow
	<i class="fa fa-circle pull-left" style="color:yellow"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="82bbd172ad71cfbca121e68a6e9d5418" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	</div><div class="row">
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">JKLMUN2011<span style="float:right">
			<a data-toggle="modal" data-target="#941778187fa09047f9af4f9c9dd053d3" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/sbsmun.png" alt="jkl Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">JKLMUN2011</h2> 
			<h3 align="center">jkl Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Step by Step School</p>
<p><strong>Hosted At Address:</strong> A-18 SECTOR 132 Noida</p>
<p><strong>Website: </strong>http://sbsmun.in</p>
<p><strong>Email:</strong> </p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> 28.51165252</p>
<p><strong>Longitude(Hosted):</strong> 77.1547845</p>
<p><strong>From: </strong>Mon,5th Dec 2011 @ 11:00:00 am</p>
<p><strong>Till: </strong>Sat,10th Dec 2011 @ 11:00:00 am</p>
<p><strong>Contact Number:</strong> 1204351362</p>
<p>
	<strong>Identification Colour:</strong>
	pink
	<i class="fa fa-circle pull-left" style="color:pink"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="bc88f5cc300766c45b06209d4708470b" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">MNOMUN2015<span style="float:right">
			<a data-toggle="modal" data-target="#e6e1d93e79379f6098ed16319b38ce8d" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/sbsmun.png" alt="mno Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">MNOMUN2015</h2> 
			<h3 align="center">mno Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Step by Step School</p>
<p><strong>Hosted At Address:</strong> A-18 SECTOR 132 Noida</p>
<p><strong>Website: </strong>http://sbsmun.in</p>
<p><strong>Email:</strong> </p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> 28.511652965</p>
<p><strong>Longitude(Hosted):</strong> 77.15454124200</p>
<p><strong>From: </strong>Mon,20th Jul 2015 @ 12:00:00 pm</p>
<p><strong>Till: </strong>Sat,25th Jul 2015 @ 12:00:00 pm</p>
<p><strong>Contact Number:</strong> 1204351362</p>
<p>
	<strong>Identification Colour:</strong>
	#000
	<i class="fa fa-circle pull-left" style="color:#000"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="3791535f3da30b7820ef98ee675b63c7" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	</div><div class="row">
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">PQRMUN2010<span style="float:right">
			<a data-toggle="modal" data-target="#ea398cfbbb7507a6793b3aac94eecfb7" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/sbsmun.png" alt="pqr Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">PQRMUN2010</h2> 
			<h3 align="center">pqr Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Step by Step School</p>
<p><strong>Hosted At Address:</strong> A-18 SECTOR 132 Noida</p>
<p><strong>Website: </strong>http://sbsmun.in</p>
<p><strong>Email:</strong> </p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> 29.9874512</p>
<p><strong>Longitude(Hosted):</strong> 77.94548745</p>
<p><strong>From: </strong>Wed,20th Jan 2010 @ 12:00:00 pm</p>
<p><strong>Till: </strong>Mon,25th Jan 2010 @ 12:00:00 pm</p>
<p><strong>Contact Number:</strong> 1204351362</p>
<p>
	<strong>Identification Colour:</strong>
	#000
	<i class="fa fa-circle pull-left" style="color:#000"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="53070e9ad6387021b8f23d9d890dca72" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">STUMUN2016<span style="float:right">
			<a data-toggle="modal" data-target="#c36c7313237b60d1db1d519ad7c696ac" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/sbsmun.png" alt="STU Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">STUMUN2016</h2> 
			<h3 align="center">STU Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Step by Step School</p>
<p><strong>Hosted At Address:</strong> A-18 SECTOR 132 Noida</p>
<p><strong>Website: </strong>http://sbsmun.in</p>
<p><strong>Email:</strong> </p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> 28.951</p>
<p><strong>Longitude(Hosted):</strong> 77.852</p>
<p><strong>From: </strong>Mon,1st Aug 2016 @ 17:30:00 pm</p>
<p><strong>Till: </strong>Sat,6th Aug 2016 @ 17:30:00 pm</p>
<p><strong>Contact Number:</strong> 1204351362</p>
<p>
	<strong>Identification Colour:</strong>
	blue
	<i class="fa fa-circle pull-left" style="color:blue"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="e7371d8ed7b26d714f3fd31ba40691e4" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	</div><div class="row">
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">VWXMUN2017<span style="float:right">
			<a data-toggle="modal" data-target="#d039860f0ed78f95742599d8a143d4d7" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/sbsmun.png" alt="WX Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">VWXMUN2017</h2> 
			<h3 align="center">WX Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Step by Step School</p>
<p><strong>Hosted At Address:</strong> A-18 SECTOR 132 Noida</p>
<p><strong>Website: </strong>http://sbsmun.in</p>
<p><strong>Email:</strong> </p>
<p><strong>Country: </strong>australia</p>
<p><strong>Latitude(Hosted):</strong> 29.488452</p>
<p><strong>Longitude(Hosted):</strong> 77.6352</p>
<p><strong>From: </strong>Thu,5th Jan 2017 @ 12:00:00 pm</p>
<p><strong>Till: </strong>Tue,10th Jan 2017 @ 12:00:00 pm</p>
<p><strong>Contact Number:</strong> 1204351362</p>
<p>
	<strong>Identification Colour:</strong>
	#000
	<i class="fa fa-circle pull-left" style="color:#000"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="bcf2b9de47770370f03d657475a062b2" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">YZMUN2017<span style="float:right">
			<a data-toggle="modal" data-target="#2ddc3a96eb539e54d0d59441b95a8f05" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/eabd304df4002e527e238a2cba64484a57b8197e6f4de_b6b35f8613a8e3cac4804677ab9f8cdd.jpg" alt="YZ Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">YZMUN2017</h2> 
			<h3 align="center">YZ Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Step by Step School</p>
<p><strong>Hosted At Address:</strong> A-18 SECTOR 132 Noida</p>
<p><strong>Website: </strong>http://sbsmun.in</p>
<p><strong>Email:</strong> anonymous.code.anonymous@gmail.com</p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> 28.65314689</p>
<p><strong>Longitude(Hosted):</strong> 77.96453489</p>
<p><strong>From: </strong>Fri,20th Jan 2017 @ 12:00:00 pm</p>
<p><strong>Till: </strong>Wed,25th Jan 2017 @ 12:00:00 pm</p>
<p><strong>Contact Number:</strong> 1204351362</p>
<p>
	<strong>Identification Colour:</strong>
	#000
	<i class="fa fa-circle pull-left" style="color:#000"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="31d9d02e0034589d5c499f75cb94864b" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	</div><div class="row">
<div class="col-md-6">
	<div 
style="border:5px solid green"  class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">BVCMUN2016<span style="float:right">
			<a data-toggle="modal" data-target="#88bff23253a572e9a901dd247ae882bf" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
	<img style="width:100%" src="logos/sbsmun.png" alt="Bhavan Vidyalaya Model united Nation" />
	</div>
	</div>
	<br>


			<h2 align="center">BVCMUN2016</h2> 
			<h3 align="center">Bhavan Vidyalaya Model united Nation</h3> 
			
		<hr><br>
<p><strong>Hosted At:</strong> Bhavan Vidyalaya Chandigarh</p>
<p><strong>Hosted At Address:</strong> D.R.A. Bhavan Vidyalaya, Jaisukhlal Hathi Sadan, Sector - 27 B , Madhya Marg, Chandigarh/160019 </p>
<p><strong>Website: </strong>http://bvcmun.com</p>
<p><strong>Email:</strong> </p>
<p><strong>Country: </strong>india</p>
<p><strong>Latitude(Hosted):</strong> 29.65314689</p>
<p><strong>Longitude(Hosted):</strong> 80.96453489</p>
<p><strong>From: </strong>Wed,21st Dec 2016 @ 12:00:00 pm</p>
<p><strong>Till: </strong>Mon,26th Dec 2016 @ 12:01:20 pm</p>
<p><strong>Contact Number:</strong> 1204351362</p>
<p>
	<strong>Identification Colour:</strong>
	#000
	<i class="fa fa-circle pull-left" style="color:#000"></i>
</p>
<p>
	<strong>Text Colour: </strong>
	#111
	<i class="fa fa-circle pull-left" style="color:#111"></i>
</p>
			<p>
			
<hr style="border-bottom:6px solid green;border-radius:5px">
			</p>

			<p>
			
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="d0fdf0be333ce899d266d86909e08ea9" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>

			</p>
		</div> 
	</div>
</div>
                                        
	 

 
                                        
                                 
                                        <!-- -->
                                    </div> 
                                    
                                    
                                    
                                    
                                    
                                    
                                     <form enctype="multipart/form-data" action="master_action.php" method="post" enctype="multipart/form-data">
 <div class="col-xs-12">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title"><input class="form-control"  name="com_long_name" type="text" placeholder="Committee Name" /></h3> 
		</div> 
		<div class="panel-body"> 
			
            <p>Img Src: <input class="form-control"  name="com_img_src" type="file" placeholder="Img Src" /></p>
            <p>Background Guide Src: <input class="form-control"  name="com_bgg_src" type="text" placeholder="Background Guide Src" /></p>
          
            <br>
Description:
                                <textarea name="com_desc" class="form-control">-</textarea>
                    
			 <br>
             <div class="row">
  <p class="col-xs-4">Is on Home: <input class="form-control"  name="com_isonhome" type="number" min="0" max="1" placeholder="0 or 1" /></p>
            <p class="col-xs-4">Background Guide Visible: <input class="form-control"  name="com_bgg_vis" type="number" min="0" max="1" placeholder="0 or 1" /></p>
            <p class="col-xs-4">Is Valid: <input class="form-control"  name="com_is_valid" type="number" min="0" max="1" placeholder="0 or 1" /></p>
            </div>
			<p><input class="btn btn-success " name="com_add" type="submit" value="Add Committee"/></p> 
		</div> 
	</div>
</div>
 </form>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    
                </div> <!-- End row -->


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            
 <br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Trying to get property of non-object in C:\wamp\www\muncircuit\munc\admin_mun.php on line <i>294</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0018</td><td bgcolor='#eeeeec' align='right'>283080</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\wamp\www\muncircuit\munc\admin_mun.php' bgcolor='#eeeeec'>..\admin_mun.php<b>:</b>0</td></tr>
</table></font>
0 results 
            
                  <!-- Footer Start -->
            <footer class="footer">
&copy; 2016
  The MUN Circuit.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
  


      
   <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="assets/chat/moment-2.2.1.js"></script>

        <!-- Counter-up -->
        <script src="js/waypoints.min.js" type="text/javascript"></script>
        <script src="js/jquery.counterup.min.js" type="text/javascript"></script>

        <!-- EASY PIE CHART JS -->
        <script src="assets/easypie-chart/easypiechart.min.js"></script>
        <script src="assets/easypie-chart/jquery.easypiechart.min.js"></script>
        <script src="assets/easypie-chart/example.js"></script>


        <!--C3 Chart-->
        <script src="assets/c3-chart/d3.v3.min.js"></script>
        <script src="assets/c3-chart/c3.js"></script>

        <!--Morris Chart-->
        <script src="assets/morris/morris.min.js"></script>
        <script src="assets/morris/raphael.min.js"></script>

        <!-- sparkline --> 
        <script src="assets/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="assets/sparkline-chart/chart-sparkline.js" type="text/javascript"></script> 

        <!-- sweet alerts -->
        <script src="assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="assets/sweet-alert/sweet-alert.init.js"></script>

        <script src="js/jquery.app.js"></script>
        <!-- Chat -->
        <script src="js/jquery.chat.js"></script>
        <!-- Dashboard -->
        <script src="js/jquery.dashboard.js"></script>

        <!-- Todo -->
        <script src="js/jquery.todo.js"></script>


        <script type="text/javascript">
        /* ==============================================
             Counter Up
             =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
			
			
        </script>
		
 
           </body>

</html>
