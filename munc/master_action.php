<?php
if(include('include.php')){
}else{
die('##errMASTERofUSErERROR');
}

if((count($_POST) > 0)  or (count($_GET) > 0)){
	if((count($_POST) > 0)){
		if(isset($_SERVER['HTTP_REFERER'])){
		}else{
			die('Refferer Not Found');
		}
		if((strpos($_SERVER['HTTP_REFERER'],'http://ahmadanonymous.ddns.net') == '0') or (strpos($_SERVER['HTTP_HOST'],'http://localhost/') == '0') or (strpos($_SERVER['HTTP_REFERER'],'http://192.168.1.') == '0'))
	{
	  //only process operation here
	}else{
		die('Only tld process are allowed');
	}
	}

}else{
	
	die(header('Location: master-action.php'));
	
}

if(isset($_POST['from_email']) and isset($_POST['from_name']) and isset($_POST['subj_ml']) and isset($_POST['message_ml'])){
	
	$email = $_POST['from_email'];
	$name = $_POST['from_name'];
	$subject = $_POST['subj_ml'];
	$message = $_POST['message_ml'];
	$hash = md5(sha1($_SERVER['REMOTE_ADDR']));
	$ip = $_SERVER['REMOTE_ADDR'];
	$timest = time();	
	
	
$sql = "INSERT INTO `mun_mails`(`ml_from_email`, `ml_from_name`, `ml_subject`, `ml_body`, `ml_hash`, `ml_from_ip`, `mun_time`) VALUES (
'".$email."',
'".$name."',
'".$subject."',
'".$message."',
'".$hash."',
'".$ip."',
'".$timest."'
)";

if ($conn->query($sql) === TRUE) {
    header('Location: home.php?mailsent');
} else {
  die('#ERRMASTACT1');
}

	
}
#
#
if(isset($_POST['ok'])){
if(!isset($_POST['usr_nm']) or !isset($_POST['usr_pass']) or !isset($_POST['usr_eml']) or !isset($_POST['usr_dob'])){
	die('Please Enter all the data');
}


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

$email = $_POST['usr_eml'];
$name =  $_POST['usr_nm'];

$dob = strtotime($_POST['usr_dob']);
$pw = md5(md5(sha1($_POST['usr_pass'])));

########################################################################################################3
$ui = explode(' ',$name);
$fn = str_split($ui[0]);
$ln = str_split(end($ui));
$fncount = count($fn)-1;
$lncount = count($ln)-1;
$ujl=array();
for($sa=0;$sa<9;$sa++){
	$fr = rand(1,2);
	if($fr==1){
		$sr = rand(0,$fncount);
		$ujl[]=$fn[$sr];
	}else if($fr==2){
		$tr = rand(0,$lncount);
		$ujl[]=$ln[$tr];
	}else{
		die('ERROR#MA3');
	}
	
}
#######################################################################################################3


$usr = strtolower($ujl[0].$ujl[1].$ujl[3].$ujl[4].$ujl[5].$ujl[6].$ujl[7].$ujl[8].rand(1,10));

$iv = 1098541894 .rand(100000,999999);
$regtm = time();
$regip = $_SERVER['REMOTE_ADDR'];
$reg_loc = strtolower($location->country_name);
$reg_lat = $lat;
$reg_lon = $lon;

$hash = gen_hash($pw,$email);
#pass and email and secret md5(sha1())


$sqla = "
INSERT INTO `mun_logins`(`lum_email`, `lum_username`, `lum_password`, `lum_hash_mix`) VALUES (
'".$email."',
'".$usr."',
'".$pw."',
'".$hash."'
)
";


if ($conn->query($sqla) === TRUE) {
	
	$ltid = $conn->insert_id;
	$sqlb = "INSERT INTO `mun_users`(`usr_name`, `usr_rel_lum_id`, `usr_dob_timestamp`,  `usr_iv`, `usr_reg_dnt`, `usr_reg_ip`, `usr_reg_country`, `usr_lat`, `usr_long`) VALUES (
'".$name."',
'".$ltid."',
'".$dob."',
'".$iv."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."',
'".$reg_loc."',
'".$reg_lat."',
'".$reg_lon."'
)";

	if ($conn->query($sqlb) === TRUE) {
	
    header('Location: login.php');
} else {
    echo "Error##ma55";
}
	
    } else {
    echo "Error###maa4";
}


}
#
#
if(isset($_POST['lo_eml']) and isset($_POST['lo_pass'])){
	$eml=$_POST['lo_eml'];
	$pas=md5(md5(sha1($_POST['lo_pass'])));
	$hash = gen_hash($pas,$eml);
	
	if(is_email($eml)){
	}else{
		die("Invalid Email");
	}
	 
	
	if(ctype_alnum($hash.$pas)){
	}else{
		die("Credentials Not valid");
	}
	
$selectusersfromdbsql = "SELECT * FROM mun_logins where 
lum_email= '".$eml."' and
lum_password = '".$pas."' and
lum_hash_mix= '".$hash."' and
lum_valid = 1

";
$usrres = $conn->query($selectusersfromdbsql);
if ($usrres->num_rows == 1) {
    // output data of each row
    while($usrrw = $usrres->fetch_assoc()) {
        session_regenerate_id();
		
		$selectusersdatafromdbsql = "
SELECT * FROM mun_users where 
usr_rel_lum_id = '".$usrrw['lum_id']."'

";
$dataobbres = $conn->query($selectusersdatafromdbsql);

if ($dataobbres->num_rows == 1) {
    // output data of each row
    while($dataobbrw = $dataobbres->fetch_assoc()) {
		###
        session_regenerate_id();
		
		$_SESSION['MUNCIRCUIT_SESS_ID'] = md5(sha1(md5(md5(sha1('SecretBall')).uniqid().time()).time()).uniqid());
		$_SESSION['MUNC_USR_DB_ID'] = $dataobbrw['usr_rel_lum_id'];
		session_write_close();
			header('Location: home.php');
		
		###
	}
}
		
		
		###big en
    }
} else {
	header('Location: login.php?notss');
    die();
}
	
		
}
#
#
 /*
var_dump($_POST);
var_dump($_FILES);
 */
 

	
	/**//**//**//**/ 
	$serverdir = 'http://localhost/muncircuit/';
	#$serverdir = 'http://ahmadanonymous.ddns.net/muncircuit/';
if(isset($_POST['ch_img'])){
	 if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	 if(isset($_FILES['ch_imgg'])){
		 if(count($_FILES) == 1){
		 }else{
		 	die('Invalid Count');
		 }
		 ##
		 $target_dir = "img/prof_pics/";
$target_file = $target_dir .md5(time().uniqid().microtime()).'_'.
'P_'.sha1(time().uniqid()).uniqid().time(). basename($_FILES["ch_imgg"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["ch_img"])) {
    $check = getimagesize($_FILES["ch_imgg"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["ch_imgg"]["size"] > 3000000) {
	 
    die("Sorry, your file is too large only 3mb Allowed.");
    $uploadOk = 0;
}
// Allow certain file formats
if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
&& strtolower($imageFileType) != "gif" ) {
die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    die( "<br>Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["ch_imgg"]["tmp_name"], $target_file)) {
        
		

$sql = "UPDATE `mun_users` SET `usr_prof_pic`= '".$target_file."' 
WHERE usr_id=".$_SESSION['MUNC_USR_DB_ID'];

if ($conn->query($sql) === TRUE) {
			##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_users','update',$sql ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




    header('Location: myca.php');
} else {
    die("ErrorMAA909") ;
}


		
		
    } else {
        die( "<br>Sorry, there was an error uploading your file.");
    }
}
		 ##
	 }
 }
#
#
 /*
 var_dump($_POST);
var_dump($_FILES);
*/
if(isset($_POST['chng_latlng'])){
	 if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins ml left join mun_users mu on ml.lum_id = mu.usr_rel_lum_id where ml.lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and ml.lum_valid = 1 and mu.usr_valid = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	
	if(isset($_POST['usr_lat_new'])){
	}else{
		die("ERRRMAS54");
	}
	if(isset($_POST['usr_long_new'])){
	}else{
		die("ERRRMAS53");
	}
	
	$nlat = $_POST['usr_lat_new'];
	$nlng = $_POST['usr_long_new'];
	###
	$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($nlat).','.trim($nlng);
$json = file_get_contents($url);
$data= json_decode($json);
echo $data->results[0]->formatted_address;
	###
	die("$url");
	$sql = "UPDATE `mun_users` SET `usr_lat`= '".$nlat."', `usr_lat`='".$nlng."' 
WHERE usr_id=".$_SESSION['MUNC_USR_DB_ID'];

if ($conn->query($sql) === TRUE) {
			##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_users','update', $sql ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TG$WESDF');
		}
##### Insert Logs ##################################################################VV3###




    header('Location: myca.php');
} else {
    die("ErrorMAA909") ;
}
	
}
#
#
if(isset($_POST['accept_like'])){
	if(ctype_alnum(trim($_POST['accept_like']))){
		$fakecheck = getdatafromsql($conn,"
		select * from mun_rec where md5(md5(sha1(sha1(
		concat(mun_id,'oworgreijoiwnriw utki5t hkeuduiehdkhuejd1254345t'))))) = '".trim($_POST['accept_like'])."'");
		
		
		
	
	if(is_string($fakecheck)){
		die('Invlaid MUNID');
	}
	if(isset($_SESSION['MUNCIRCUIT_SESS_ID'])){
		$usr_id = trim($_SESSION['MUNC_USR_DB_ID']);
	}else{
		die('You Must be Logged in to add this mun');
	}
	
	$checkadded = getdatafromsql($conn,"
		select * from mun_attend where at_rel_usr_id= '".$usr_id."' and at_rel_mun_id = '".trim($fakecheck['mun_id'])."'");
		if(is_array($checkadded)){
			
		die('You have already added this mun');
	}
		
	
	$inssql = "INSERT INTO `mun_attend`(`at_rel_usr_id`, `at_rel_mun_id`) VALUES (
    '".$usr_id."',
    '".trim($fakecheck['mun_id'])."'
    )";
	
	
	if($conn->query($inssql)){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($fakecheck,$_SESSION['MUNC_USR_DB_ID'],'mun_attend','insert', $inssql ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRweafINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




		header('Location: amun.php?mun='.md5(sha1($fakecheck['mun_id'].'HGYURBVFRBRGWIOGRU92UWHFGOIWHTOGIUEO8HG384IWGOIRHWGIUHREJFGKN'))
		
		);
	}else{
		die("###ERRMA3344");
	}
	
	
	}
}
#
#
if(isset($_POST['accept_unlike'])){
	if(ctype_alnum(trim($_POST['accept_unlike']))){
		$fakecheck = getdatafromsql($conn,"
		select * from mun_rec where md5(md5(sha1(sha1(
		concat(mun_id,'oworgreijoiwnriw utki5t hkeuduiehdkhuejd1254345t'))))) = '".trim($_POST['accept_unlike'])."'");
		
		
		
	
	if(is_string($fakecheck)){
		die('Invlaid MUNID');
	}
	if(isset($_SESSION['MUNCIRCUIT_SESS_ID'])){
		$usr_id = trim($_SESSION['MUNC_USR_DB_ID']);
	}else{
		die('You Must be Logged in to add this mun');
	}
	
	$checkadded = getdatafromsql($conn,"
		select * from mun_attend where at_rel_usr_id= '".$usr_id."' and at_rel_mun_id = '".trim($fakecheck['mun_id'])."'");
		if(is_string($checkadded)){
		die('You Have not added this mun');
	}
		
	
	$upssql = "
	delete from  `mun_attend` WHERE `at_id`=".$checkadded['at_id']."
	
	
	";
	
	
	if($conn->query($upssql)){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($checkadded,$_SESSION['MUNC_USR_DB_ID'],'mun_attend','delete', $upssql ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




		header('Location: amun.php?mun='.md5(sha1($fakecheck['mun_id'].'HGYURBVFRBRGWIOGRU92UWHFGOIWHTOGIUEO8HG384IWGOIRHWGIUHREJFGKN'))
		
		);
	}else{
		die("###ERRMA3354");
	}
	
	
	}
}
#
#
if(isset($_POST['ch_det'])){
		 if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}


	if(!isset($_POST['ch_usr_name'])){
		die('Enter all fields');
	}
	if(!isset($_POST['usr_dob'])){
		die('Enter all fields');
	}
	
	$newusrnm = $_POST['ch_usr_name'];
	$br = explode('/',$_POST['usr_dob']);
	if(count($br) == 3){
		$dd = $br[1];
		$mm = $br[0];
		$yyyy = $br[2];
		
		$nd = strtotime($dd.'-'.$mm.'-'.$yyyy);

$upsql = "update `mun_users` set `usr_name` = '".$newusrnm."' , `usr_dob_timestamp` = '".trim($nd)."' where usr_rel_lum_id = ".$_SESSION['MUNC_USR_DB_ID'];

if($conn->query($upsql)){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_users','update', $upsql ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: myca.php');
}else{
	die('#ERRPMAIjisjA1');
}
	}else{
		die('#ERRRMA99j4');
	}
	
}
#
#
if(isset($_POST['ch_pw'])){
			 if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}


	
	if(!isset($_POST['pw'])){
		die('Enter all fields');
	}

	if(!isset($_POST['npw'])){
		die('Enter all fields');
	}
	
	if($_POST['pw'] == $_POST['npw']){
		$lum = getdatafromsql($conn,'select * from mun_logins where lum_id = '.$_SESSION['MUNC_USR_DB_ID']);
		if(is_string($lum)){
			die('#ERRRMA39UET05G8T');
		}
		$pw = md5(md5(sha1($_POST['pw'])));
		$hash = gen_hash($pw,trim($lum['lum_email']));
		
		
		if($pw== $lum['lum_password']){
			die('The new password cant be same as the old one!');
		}else{
			$upsql = "UPDATE `mun_logins` SET `lum_password`='".trim($pw)."',`lum_hash_mix`='".trim($hash)."' WHERE lum_id = ".$_SESSION['MUNC_USR_DB_ID'];
			if($conn->query($upsql)){
						##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_logins','update', $upsql ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%wsrhizuTGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




				session_destroy();
				if(count($_SESSION)>0){
					header('Location: login.php');
				}else{
					die('ERRMASESSND');
				}
			}else{
				die("#ERRRKJIOJTOJHB");
			}
			
		}
		
		
		
	}else{
		die('Passwords Dont Match');
	}


}
#
#
if(isset($_POST['claim_mun'])){
	
		
			if(isset($_SESSION['MUNC_USR_DB_ID'])){
	if(trim(ctype_alnum($_POST['claim_mun']))){
		$muner = getdatafromsql($conn,"select * from mun_rec where md5(sha1(md5(sha1(concat(mun_id,'creation983ygh8t4eg8t9hg9u4eh5thr9g48etjg894je8tdjg489ejtg894je589thj84h5teh'))))) = '".$_POST['claim_mun']."'");
		if(is_array($muner)){
	
	
	$checkdupes = getdatafromsql($conn,"SELECT * FROM `mun_claim_requests` WHERE `cl_rel_lum_id` = ".$_SESSION['MUNC_USR_DB_ID']." and `cl_rel_mun_id`= ".$muner['mun_id']." and cl_valid = 1 order by cl_gen_time DESC");
	if(is_array($checkdupes)){
		if(($checkdupes['cl_gen_time'] + 86400) > time()){
			die('You have already requested to claim this mun.<br>
Come back After 24hrs');
		}
	}else{
	}
	
	
	
				$acc_usr_id = $_SESSION['MUNC_USR_DB_ID'];
				$acc_mun_id = $muner['mun_id'];
				
		
				if($conn->query("INSERT INTO `mun_claim_requests`(`cl_rel_lum_id`, `cl_rel_mun_id`, `cl_mail_sent`, `cl_valid`) VALUES (
				'".$acc_usr_id."',
				'".$acc_mun_id."',
				'0',
				'0'
				
				)")){
					$donit = $conn->insert_id;
					$dading = getdatafromsql($conn,"select * from mun_claim_requests where cl_id = '".$donit."'");
					if(is_string($dading)){
						die('ERRMASJ3IOGJRTO3');
					}
					if($dading['cl_rel_lum_id'] == $_SESSION['MUNC_USR_DB_ID']){
					}else{
						die('ERRMAIU3HG94UGHJRV94YUERG <br>
Go Back');
					}
				}else{
					die('ERRMA398UWR9835HERGU');
				}
		
				
	##
	$message = "
<html>
<head>
<title>Claim ".$muner['mun_shortname']." at MUNCIRCUIT</title>
</head>
<body>
<p>To ".ucwords($muner['mun_hostedat']).",<br>
If you have requested to Claim ".strtoupper($muner['mun_shortname'])."".$muner['mun_year']." at MUN Circuit, Click this link 
<a href='".$serverdir."munc/master_action.php?claimmun_from_id=".md5(md5(sha1(sha1(md5($dading['cl_id'].'jufjei90gtuj 3tg3gtgit hygt gut3 egt90ug09u3g 9u3ug90j4tej')))))."&cl_df=jugv9j0i3e09jni99824U98J'><i style='color:blue;'><u>".$serverdir."munc/master_action.php?claimmun_from_id=".md5(md5(sha1(sha1(md5($dading['cl_id'].'jufjei90gtuj 3tg3gtgit hygt gut3 egt90ug09u3g 9u3ug90j4tej')))))."&cl_df=jugv9j0i3e09jni99824U98J</u></i></a>

<hr>
or else you can ignore this message
<hr>
This link is only valid for 24hrs.<br>
 
Please do not reply to this email.</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <do-not-reply@munc.com>' . "\r\n";
$headers .= 'Bcc: com.aa.ay@gmail.com' . "\r\n";

if(mail($muner['mun_email'],'Claiming '." ".' '.strtoupper($muner['mun_shortname'])."".$muner['mun_year'].' at MUN circuit ',$message,$headers)){
	
	if($conn->query("UPDATE `mun_claim_requests` SET `cl_mail_sent`=1,`cl_valid`=1,`cl_gen_time` = ".time()." , cl_ip = '".$_SERVER['REMOTE_ADDR']."' WHERE `cl_id` = '".$donit."'")){
	header('Location: amun.php?mun='.md5(sha1($muner['mun_id'].'HGYURBVFRBRGWIOGRU92UWHFGOIWHTOGIUEO8HG384IWGOIRHWGIUHREJFGKN')));
	}else{
		die("EERRMAjhenrviui3ijg");
	}
	
}else{
	echo 'Mail not sent';
}

	
	##					
		}else{
			die('Hash Not Valid');
		}
	}else{
		die('Hash Invalid');
	}



				}else{	die('You must be Logged in to Claim an MUN');		}
}


/* #### make new table for the editable session and give temprorary id for the editing to happen andthen give an option to edit the content and then hit save to edit it aftewards make an admin panel pending tab# to appprove the changes ###

*/

if(isset($_POST['rep_mun'])){
	if(isset($_POST['rep_usr_nm']) and isset($_POST['rep_usr_eml']) and isset($_POST['rep_prob_dob'])){
	}else{
		die('Enter all fields');
	}
	
	if(!is_email($_POST['rep_usr_eml'])){
		die('Email is not Valid');
	}
	if(trim(ctype_alnum($_POST['rep_mun']))){
		$muner = getdatafromsql($conn,"select * from mun_rec where md5(sha1(sha1(sha1(concat(mun_id,'creation983ygh8t4eg8t9hg9u4eh5thr9g48etjg894jtg894je589thj84h5teh'))))) = '".$_POST['rep_mun']."'");
		if(is_array($muner)){
			
			$rptusrnm = $_POST['rep_usr_nm'];
			$rptusreml = $_POST['rep_usr_eml'];
			$rptprob = $_POST['rep_prob_dob'];
			$munif = $muner['mun_id'];
			
			
			$inssq = "INSERT INTO `mun_reports`(`rpt_usr_name`, `rpt_usr_email`, `rpt_usr_problem`, `rpt_usr_rel_mun_id`, `rpt_added_dnt`) VALUES (
'".$rptusrnm."',
'".$rptusreml."',
'".$rptprob."',
'".$munif."',
'".time()."'			)";
			
			if($conn->query($inssq)){
						##### Insert Logs ##################################################################VV3###
		if(preplogs($muner,$_SESSION['MUNC_USR_DB_ID'],'mun_reports','insert', $inssq,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




				header('Location: amun.php?mun='.md5(sha1($muner['mun_id'].'HGYURBVFRBRGWIOGRU92UWHFGOIWHTOGIUEO8HG384IWGOIRHWGIUHREJFGKN')));
			}else{
				die("ERRMASIEHGU35HGR");
			}
		}else{
			die('Hash Not Valid');
		}
	}else{
		die('Hash Invalid');
	}
}
##
if(isset($_POST['req_mun'])){
	if(trim(ctype_alnum($_POST['req_mun']))){
		$muner = getdatafromsql($conn,"select * from mun_rec where md5(md5(md5(sha1(concat(mun_id,'creation983ygh8t4eg8t9hg9u4eh5thr9g48etjg894je8tdjg489ejtg894je589th'))))) = '".$_POST['req_mun']."'");
		if(is_array($muner)){
			die('You are now going to be sent to a page which allows you to edit the changes ');
		}else{
			die('Hash Not Valid');
		}
	}else{
		die('Hash Invalid');
	}
}
##
##
if(isset($_POST['re_pw'])){
	if(isset($_POST['rec_eml'])){
		if(is_email($_POST['rec_eml'])){
			$validemail = getdatafromsql($conn,"select * from mun_logins where lum_email = '".trim($_POST['rec_eml'])."'");
			
			if(is_array($validemail)){
				$hasho = gen_hash_pw('oi4jg9v 5g858r hgh587rhg85rhgvu85rht9gi vj98rjg984he98t hj4 9v8r hb9uirhbu');
			  $hasht = gen_hash_pw_2($validemail['lum_id'],'984j5t8gj48 g8 5hg085hr988rt09g409rhj 9borjh09oj58r hj094jh 98obh498toeihg');
			  
			  
			  
				$ins_pwrc = "INSERT INTO `mun_recover`(`rv_rel_lum_id`, `rv_hash`, `rv_valid_till`, `rv_hash_2`) VALUES (
'".$validemail['lum_id']."',
'".$hasho."',
'".(time()+10810)."',				
'".$hasht."'
)";
if($conn->query($ins_pwrc)){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($validemail,$_SESSION['MUNC_USR_DB_ID'],'mun_recover','insert', $ins_pwrc,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGweafTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	###eml
	$to = $validemail['lum_email'];
$subject = "MUN Circuit Password Recovery ";

$message = "
<html>
<head>
<title>Click on the Link below</title>
</head>
<body>
<h2>You have requested an option to recover your account's password</h2>
<p>You can either click on the link below or copy it and paste it in your browser to reset your accounts password</p>
<p>Remeber This link is only valid for 5hrs and is one time useable</p>
<a href='".$serverdir."munc/recover.php?id=".$hasho.$hasht."'>".$serverdir."munc/recover.php?id=".$hasho.$hasht."</a>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <anonymous.code.anonymous@gmail.com>' . "\r\n";

if(mail($to,$subject,$message,$headers)){
header('Location: recover.php?newmade');
}else{
	die('#ERRMAjuigtuj');
}
	###eml
}else{
	die('#ERRMA9309399JG');
}
				
				
				
				
			}else{
				echo 'Dont know';
			}
			
		}else{
			die('Enter a Valid Email');
		}
	}else{
		die('Enter All fields');
	}
}
#
#
if(isset($_POST['rec_action_pw'])){
	if(isset($_POST['recover_npw']) and isset($_POST['rec_pw_u'])){
		if(ctype_alnum(trim(strtolower($_POST['rec_pw_u'])))){
			$usrh = $_POST['rec_pw_u'];
			$newp = $_POST['recover_npw'];
			$user_det = getdatafromsql($conn,"select * from mun_logins where md5(sha1(concat(lum_id,'3oijg9i3u8uh'))) = '".$usrh."' and lum_valid = 1");
			
			if(is_array($user_det)){
				$new_pw=md5(md5(sha1($newp)));
				$new_hash = gen_hash($new_pw,$user_det['lum_email']);

	


if($conn->query("update mun_logins set lum_password = '".$new_pw."', lum_hash_mix ='".$new_hash."' where lum_id = ".$user_det['lum_id']."")){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($user_det,$_SESSION['MUNC_USR_DB_ID'],'mun_logins','update', "update mun_logins set lum_password = '".$new_pw."', lum_hash_mix ='".$new_hash."' where lum_id = ".$user_det['lum_id']."",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA-R$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	session_destroy();
	header('Location: login.php');
	
}else{
	die("ERRMAUSRPWCHOI03J4");
}
	
			}else{
				die('Invalid User');
			}
		}else{
			die("Invalid hash");
		}
	}else{
		die("Enter all Values");
	}
}
#
#
if(isset($_POST['resolves_report_s'])){
	if(isset($_POST['resolves_report_hash']) and ctype_alnum($_POST['resolves_report_hash'])){
	}else{
		die('Combination Invalid');
	}
	
	if(isset($_POST['report_resolved_text'])){
		
	}else{
		die('Invalid Combination');
	}
	
	$resolv = getdatafromsql($conn,"select * from mun_reports  WHERE md5(sha1(md5(md5(concat(rpt_id,'inyc54u569tyi47ct74wv74g57t y74e5yt734y5t98vr7nti5veni7i ytv5r y8'))))) = '".$_POST['resolves_report_hash']."' and rpt_resolved = 0 and rpt_valid =1");
	
	if(is_string($resolv)){
		die('Invalid Report');
	}else{
		$resolving_mun = getdatafromsql($conn,"select * from mun_rec where mun_id = ".$resolv['rpt_usr_rel_mun_id']." and mun_valid =1 ");
		$resolving_email = $resolv['rpt_usr_email'];
		$resolving_name = $resolv['rpt_usr_name'];
		$resolving_text = $_POST['report_resolved_text'];
		
		if(is_string($resolving_mun)){
			die('No MUN Found');	
		}
		
		#
		$message = "
<html>
<head>
<title>Complaint Resolved</title>
</head>
<body>
<p>Dear ".ucwords($resolving_name).",<br>
This email is to inform you about the status of your report against ".$resolving_mun['mun_shortname'].".
<br><br>

".$resolving_text."<br>
<br>

Please do not reply to this email.</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <anonymous.code.anonymous@gmail.com>' . "\r\n";
$headers .= 'Cc: com.aa.ay@gmail.com' . "\r\n";

if(mail($resolving_email,'MUN Report Status from MUN Circuit',$message,$headers)){
	
	if($conn->query("UPDATE `mun_reports` SET `rpt_resolved`= 1,`rpt_res_dnt`='".time()."' WHERE rpt_id = ".$resolv['rpt_id']." and rpt_valid =1 and rpt_resolved = 0")){
		
			
	
	
				##### Insert Logs ##################################################################VV3###
		if(preplogs($resolv,$_SESSION['MUNC_USR_DB_ID'],'mun_reports','update', "UPDATE `mun_reports` SET `rpt_resolved`= 1,`rpt_res_dnt`='".time()."' WHERE rpt_id = ".$resolv['rpt_id']." and rpt_valid =1 and rpt_resolved = 0" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	echo 'An email was sent to him <a href="reports.php"><button>Go Back</button></a> ';
	}
	
}else{
	echo 'Mail not sent';
}
		#
	}
}
##
##
if(isset($_POST['resolved_contact_t'])){
	if(isset($_POST['resolved_contact_hash']) and ctype_alnum(trim($_POST['resolved_contact_hash']))){
	}else{
		die('Hash Invalid');
	}
	
	if(isset($_POST['resolved_contact_text'])){
	}else{
		die('Fill out all fields');
	}
	
	$resolv = getdatafromsql($conn,"select * from mun_mails  WHERE 
	md5(sha1(md5(md5(concat(ml_id,'inyc54u569tyi47ct74wv74g57t y74e5yt734y5t98vr7nti5veni7i'))))) 
	= '".$_POST['resolved_contact_hash']."' and ml_read = 0 and ml_valid=1");
	
	if(is_string($resolv)){
		die('Invalid Enquiry');
	}else{
		$resolving_email = $resolv['ml_from_email'];
		$resolving_subject = $resolv['ml_subject'];
		$resolving_name = $resolv['ml_from_name'];
		$resolving_text = $_POST['resolved_contact_text'];
		
		
		
		#
		$message = "
<html>
<head>
<title>Re: ".$resolving_subject."</title>
</head>
<body>
<p>Dear ".ucwords($resolving_name).",<br>
This email is a reply of your Enquiry, on ".date('dS M, Y @ H:i:s',$resolv['mun_time']).".
<hr>
<h5 style='color:purple;'>
".$resolv['ml_body']."
</h5>
<hr>
<br><br>

".$resolving_text."<br>
<br>

Please do not reply to this email.</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <do-not-reply@munc.com>' . "\r\n";
$headers .= 'Bcc: com.aa.ay@gmail.com' . "\r\n";

if(mail($resolving_email,'Re: '.$resolving_subject.'',$message,$headers)){
	
	if($conn->query("UPDATE `mun_mails` SET `ml_read`= 1,`ml_resolved_dnt`='".time()."' WHERE ml_id = ".$resolv['ml_id']." and ml_valid =1 and ml_read = 0")){
		
		
				##### Insert Logs ##################################################################VV3###
		if(preplogs($editresolvmun,$_SESSION['MUNC_USR_DB_ID'],'mun_mails','update', "UPDATE `mun_mails` SET `ml_read`= 1,`ml_resolved_dnt`='".time()."' WHERE ml_id = ".$resolv['ml_id']." and ml_valid =1 and ml_read = 0" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TsdGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	echo 'An email was sent to the recipient <a href="enquire.php"><button>Go Back</button></a> ';
	}else{
		die("EERRMAjhenrviui3ijg");
	}
	
}else{
	echo 'Mail not sen1t';
}
		#
	}
	
	
	
	
	
	
}
##
#
if(isset($_GET['claimmun_from_id'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
	}else{
		die('You Must be logged in to Claim the MUN with the account that the request was made through<br>
<a href="login.php"><button>Click to Login</button></a>');
	}
	$chi = $_GET['claimmun_from_id'];
	if(ctype_alnum($chi)){
		#md5(md5(sha1(sha1(md5(concat(cl_id,'jufjei90gtuj 3tg3gtgit hygt gut3 egt90ug09u3g 9u3ug90j4tej'))))))
		$cl = getdatafromsql($conn, "SELECT * FROM mun_claim_requests where md5(md5(sha1(sha1(md5(concat(cl_id,'jufjei90gtuj 3tg3gtgit hygt gut3 egt90ug09u3g 9u3ug90j4tej')))))) = '".$chi."' and cl_valid =1 and cl_granted= 0");
		if(is_array($cl)){
			if(time() < ($cl['cl_gen_time'] + 86401)){
				if($cl['cl_rel_lum_id'] == $_SESSION['MUNC_USR_DB_ID']){
					if($conn->query("UPDATE `mun_claim_requests` SET `cl_granted`=1 ,
					`cl_ip`='".$_SERVER['REMOTE_ADDR']."'
					WHERE cl_id = ".$cl['cl_id']." and cl_valid =1")){
								##### Insert Logs ##################################################################VV3###
		if(preplogs($cl,$_SESSION['MUNC_USR_DB_ID'],'mun_claim_requests','update', "UPDATE `mun_claim_requests` SET `cl_granted`=1 ,`cl_ip`='".$_SERVER['REMOTE_ADDR']."' WHERE cl_id = ".$cl['cl_id']." and cl_valid =1" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




						header('Location: instructions.php?claimedmun');
					}else{
						die('##ERRMAIU3HG79HURT8UH');
					}
				}else{
					die('<h1>FAILED</h1><br>
You must be logged in with the account you requested the MUN');
				}
			}else{
				die('<h1>Link Expired</h1>');
			}
		}else{
			die('No Request Found');
		}
	}else{
		die('Invalid Hash');
	}
	#
}
#
#
if(isset($_POST['mun_cl_ch'])){
	if(isset($_POST['mun_cl_ch'])){
		if(ctype_alnum(trim($_POST['mun_cl_ch_h']))){
			$editmun = getdatafromsql($conn,"select * from mun_claim_requests where md5(sha1(md5(concat(cl_id,'u4hbrjijnrn gjgbnnrggnbnrgioknjrgrijnbjrn jgjrngnbjjgrodfijg 45u hgoiu5trg1654851584135468 64 64 864684 354 8651 0410351054 6504 6840 864 0864')))) = '".$_POST['mun_cl_ch_h']."' and cl_valid =1");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	if(isset($_POST['mun_cl_ch_shrtname'])){
		$shortname = trim($_POST['mun_cl_ch_shrtname']);
	}else{
		die('Enter all Values 1');
	}
	
	if(isset($_POST['mun_cl_ch_lngnme'])){
		$longname = trim($_POST['mun_cl_ch_lngnme']);
	}else{
		die('Enter all Values 2');
	}
	
	if(isset($_POST['mun_cl_ch_hostat'])){
		$hostedat = trim($_POST['mun_cl_ch_hostat']);
	}else{
		die('Enter all Values 3');
	}
	
	if(isset($_POST['mun_cl_ch_hstdaddr'])){
		$hostedataddr = trim($_POST['mun_cl_ch_hstdaddr']);
	}else{
		die('Enter all Values 4');
	}
	
	if(isset($_POST['mun_cl_ch_website'])){
		$website = trim($_POST['mun_cl_ch_website']);
	}else{
		die('Enter all Values 5');
	}
	
	if(isset($_POST['mun_cl_ch_contc'])){
		$contc = trim($_POST['mun_cl_ch_contc']);
	}else{
		die('Enter all Values 55');
	}
	
	
	if(isset($_POST['mun_cl_ch_loc_lat'])){
		$newlat = trim($_POST['mun_cl_ch_loc_lat']);
	}else{
		die('Enter all Values 6');
	}
	
		if(isset($_POST['mun_cl_ch_loc_country'])){
		$country = trim($_POST['mun_cl_ch_loc_country']);
	}else{
		die('Enter all Values 66');
	}
	
	if(isset($_POST['mun_cl_ch_loc_long'])){
		$newlong = trim($_POST['mun_cl_ch_loc_long']);
	}else{
		die('Enter all Values 7');
	}
	
	if(isset($_POST['mun_cl_ch_start_day'])){
		$startday = dtots(trim($_POST['mun_cl_ch_start_day']));
	}else{
		die('Enter all Values 8');
	}
	
	if(isset($_POST['mun_cl_ch_end_day'])){
		$endday = dtots(trim($_POST['mun_cl_ch_end_day']));
	}else{
		die('Enter all Values 9');
	}
	if($editmun['cl_mail_sent'] == 0){
		#You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes #
		die("You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes ");
	}else{
		if($conn->query("UPDATE `mun_rec` SET 
`mun_shortname`= '".$shortname."',
`mun_year`='".date('Y',trim($startday))."',
`mun_fullname`='".$longname."',
`mun_hostedat`='".$hostedat."',
`mun_hosted_addr`='".$hostedataddr."',
`mun_website`='".$website."',
`mun_country`='".$country."',
`mun_lat`='".$newlat."',
`mun_long`='".$newlong."',
`mun_contact_no` = '".$contc."',
`mun_from`='".trim($startday)."',
`mun_till`='".trim($endday)."'
where mun_id = ".trim($editmun['cl_rel_mun_id'])."")){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['MUNC_USR_DB_ID'],'mun_rec','update', "UPDATE `mun_rec` SET 
`mun_shortname`= '".$shortname."',
`mun_year`='".date('Y',trim($startday))."',
`mun_fullname`='".$longname."',
`mun_hostedat`='".$hostedat."',
`mun_hosted_addr`='".$hostedataddr."',
`mun_website`='".$website."',
`mun_country`='".$country."',
`mun_lat`='".$newlat."',
`mun_long`='".$newlong."',
`mun_contact_no` = '".$contc."',
`mun_from`='".trim($startday)."',
`mun_till`='".trim($endday)."'
where mun_id = ".trim($editmun['cl_rel_mun_id'])."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: mymuns.php');
		}else{
			die('ERRMAIUOHJ(I)(');
		}
	}

}
##
##
if(isset($_POST['mun_cl_ch_img'])){
	if(isset($_POST['mun_cl_ch_img_h']) and ctype_alnum($_POST['mun_cl_ch_img_h'])){
		##
$editmun = getdatafromsql($conn,"select * from mun_claim_requests where md5(sha1(md5(md5(concat(cl_id,'2415972129601522 65 65468 405405834 534086409844 8604y8r64hg68y 4t9jgnh5348t 5f3y4vj1n 89e4y6e4908t04 8tyj'))))) = '".$_POST['mun_cl_ch_img_h']."' and cl_valid =1");
	if(is_string($editmun)){
				die('Hash Not Found');
	}
	
	if((count($_FILES) == 0) and isset($_POST['mun_ch_text_url'])){
		if(strlen($_POST['mun_ch_text_url']) == 0){
			die('Nothing to Upload');
			}
	}
	
	if((count($_FILES['mun_ch_img']['tmp_name']) == 1) and (trim(strlen($_FILES['mun_ch_img']['tmp_name'])) > 2)){
	
	
	####################333
	$target_dir = "logos/";
	
$target_file = $target_dir .md5($_FILES["mun_ch_img"]["name"].$_FILES["mun_ch_img"]["tmp_name"].$_FILES["mun_ch_img"]["size"]).uniqid().'_'.md5(time()).'.'. extension($_FILES["mun_ch_img"]["name"]);
$uploadOk = 1;
$err_arr = array();

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["cl_ch_img"])) {
    $check = getimagesize($_FILES["mun_ch_img"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $err_arr[]="File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $err_arr[]= "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["mun_ch_img"]["size"] > 1200000) {
    $err_arr[]= "Sorry, your file is too large. (more than 1 mb)";
    $uploadOk = 0;
}
// Allow certain file formats
if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
&& strtolower($imageFileType) != "gif" ) {
    $err_arr[]= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	foreach($err_arr as $err){
		echo $err.'<br>';
	}
    die("Sorry, your file was not uploaded.");

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["mun_ch_img"]["tmp_name"], $target_file)) {
        #dbupdate
		if($conn->query("UPDATE `mun_rec` SET 
`mun_img_src`='".trim($target_file)."'
where mun_id = ".trim($editmun['cl_rel_mun_id'])."")){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['MUNC_USR_DB_ID'],'mun_rec','update', "UPDATE `mun_rec` SET 
`mun_img_src`='".trim($target_file)."'
where mun_id = ".trim($editmun['cl_rel_mun_id'])."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: mymuns.php');
		}else{
			die('ERRMAIUOHJ(jnfI)(');
		}
		
		#dbupdate
		
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}
	####################333
	}
	
	
	if(strlen($_POST['mun_ch_text_url']) > 0){


$ch = curl_init($_POST['mun_ch_text_url']);
$fp = fopen('logos/'.'.png', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);


	}
	
	
##
	}else{
		die('Invalid Hash');
	}
	
	
	
}
#
#
if(isset($_POST['mod_add'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['mod_a_long_name'])){
		$nm = $_POST['mod_a_long_name'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_href'])){
		$href = $_POST['mod_a_href'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_icon'])){
		$ico = $_POST['mod_a_icon'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_sub_menu']) and is_numeric($_POST['mod_a_sub_menu'])){
		if(in_range($_POST['mod_a_sub_menu'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$subm = $_POST['mod_a_sub_menu'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_ifadmin']) and is_numeric($_POST['mod_a_ifadmin'])){
		if(in_range($_POST['mod_a_ifadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 2');
		}
		$ifadm = $_POST['mod_a_ifadmin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_ifnotadmin']) and is_numeric($_POST['mod_a_ifnotadmin'])){
		if(in_range($_POST['mod_a_ifnotadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 3');
		}
		$ifnoadm = $_POST['mod_a_ifnotadmin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_ifnotlogin']) and is_numeric($_POST['mod_a_ifnotlogin'])){
		if(in_range($_POST['mod_a_ifnotlogin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 4');
		}
		$ifnlogin = $_POST['mod_a_ifnotlogin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_iflogin']) and is_numeric($_POST['mod_a_iflogin'])){
		if(in_range($_POST['mod_a_ifadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 5');
		}
		$iflogin = $_POST['mod_a_iflogin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_valid']) and is_numeric($_POST['mod_a_valid'])){
		if(in_range($_POST['mod_a_valid'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 6');
		}
		$vali_s = $_POST['mod_a_valid'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333

	if($conn->query("INSERT INTO `mun_modules`(`mo_name`, `mo_href`, `mo_icon`, `mo_ifadmin`, `mo_ifnoadmin`, `mo_if_no_log_in`, `mo_if_log_in`, `mo_sub_mod`, `mo_valid`) VALUES (
	'".$nm."',
	'".$href."',
	'".$ico."',
	".$ifadm.",
	".$ifnoadm.",
	".$ifnlogin.",
	".$iflogin.",
	".$subm.",
	".$vali_s."
	)")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_modules','insert', "INSERT INTO `mun_modules`(`mo_name`, `mo_href`, `mo_icon`, `mo_ifadmin`, `mo_ifnoadmin`, `mo_if_no_log_in`, `mo_if_log_in`, `mo_sub_mod`, `mo_valid`) VALUES (
	'".$nm."',
	'".$href."',
	'".$ico."',
	".$ifadm.",
	".$ifnoadm.",
	".$ifnlogin.",
	".$iflogin.",
	".$subm.",
	".$vali_s."
	)",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




		header('Location: admin_mods.php');
	}else{
		die('ERRMAGRTBRHR%Y$T%HTIEB(FD');
	}
}
##
##
if(isset($_POST['a_mun_add'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['a_mun_shrtname'])){
		$shrnm = $_POST['a_mun_shrtname'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_flnme'])){
		$flnm = $_POST['a_mun_flnme'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_year'])){
		if(is_numeric($_POST['a_mun_year']) and 
		(in_range($_POST['a_mun_year'],
		(date('Y',time()) - 3),(date('Y',time()) +3),true))){
		$year = $_POST['a_mun_year'];
		}
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_hosted'])){
		$hostedat = $_POST['a_mun_hosted'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_hostedaddr'])){
		$hostedataddr = $_POST['a_mun_hostedaddr'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_lat'])){
		$lat = $_POST['a_mun_lat'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_long'])){
		$long = $_POST['a_mun_long'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_website'])){
		$website = $_POST['a_mun_website'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_email'])){
		if(is_email($_POST['a_mun_email'])){
		}else{
			die("Invalid email");
		}
		$email = $_POST['a_mun_email'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_country'])){
		$country = $_POST['a_mun_country'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_idenbg'])){
		$idenc = $_POST['a_mun_idenbg'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_idenfnt'])){
		$fnt = $_POST['a_mun_idenfnt'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_contctno']) and is_numeric($_POST['a_mun_contctno'])){
		
		$contcno = $_POST['a_mun_contctno'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_stdt']) ){
		$startdate = strtotime($_POST['a_mun_stdt']);
		if(is_numeric($startdate)){
		}else{
			die("Invalid Start date");
		}
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_etdt']) ){
		$enddate = strtotime($_POST['a_mun_etdt']);
		if(is_numeric($enddate)){
			if($startdate > $enddate){
				die("End date should always be in Future");
			}
		}else{
			die("Invalid End date");
		}
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['a_mun_valid']) and is_numeric($_POST['a_mun_valid'])){
		if(in_range($_POST['a_mun_valid'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 6');
		}
		$vali_s = $_POST['a_mun_valid'];
	}else{
		die('Enter all Fields Correctly');
	}
	
	############################33333333
	if(isset($_FILES['mun_img'])){
		if(is_array($_FILES['mun_img']['name'])){
			
		}
	}else{
		die('Enter Please Upload an image too.');
	}
	############################33333333
	#####file upload
	
	
	$target_dir = "logos/";
	
$target_file = $target_dir .md5($_FILES["mun_img"]["name"].$_FILES["mun_img"]["tmp_name"].$_FILES["mun_img"]["size"]).uniqid().'_'.md5(time()).'.'. extension($_FILES["mun_img"]["name"]);
$uploadOk = 1;
$err_arr = array();

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["a_mun_add"])) {
    $check = getimagesize($_FILES["mun_img"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $err_arr[]="File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $err_arr[]= "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["mun_img"]["size"] > 1200000) {
    $err_arr[]= "Sorry, your file is too large. (more than 1 mb)";
    $uploadOk = 0;
}
// Allow certain file formats
if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
&& strtolower($imageFileType) != "gif" ) {
    $err_arr[]= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	foreach($err_arr as $err){
		echo $err.'<br>';
	}
    die("Sorry, your file was not uploaded.");

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["mun_img"]["tmp_name"], $target_file)) {
        #dbupdate
		if($conn->query("INSERT INTO `mun_rec`(`mun_shortname`, `mun_year`, `mun_img_src`, `mun_fullname`, `mun_hostedat`, `mun_hosted_addr`, `mun_website`, `mun_email`, `mun_country`, `mun_lat`, `mun_long`, `mun_from`, `mun_till`, `mun_contact_no`, `mun_iden_color`, `mun_text_color`, `mun_valid`) VALUES (
		'".$shrnm."','".$year."','".$target_file."','".$flnm."','".$hostedat."','".$hostedataddr."','".$website."','".$email."','".$country."','".$lat."','".$long."' ,'".$startdate."','".$enddate."','".$contcno."','".$idenc."','".$fnt."' , '".$vali_s."'	)
		")){
			
					##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_rec','insert', "INSERT INTO `mun_rec`(`mun_shortname`, `mun_year`, `mun_img_src`, `mun_fullname`, `mun_hostedat`, `mun_hosted_addr`, `mun_website`, `mun_email`, `mun_country`, `mun_lat`, `mun_long`, `mun_from`, `mun_till`, `mun_contact_no`, `mun_iden_color`, `mun_text_color`, `mun_valid`) VALUES (
		'".$shrnm."','".$year."','".$target_file."','".$flnm."','".$hostedat."','".$hostedataddr."','".$website."','".$email."','".$country."','".$lat."','".$long."' ,'".$startdate."','".$enddate."','".$contcno."','".$idenc."','".$fnt."' , '".$vali_s."'	)
		" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: admin_mun.php');
		}else{
			die('ERRMktjrgAIUOHJ(');
		}
		
		#dbupdate
		
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}


	
	####file upload ends

}
##
##
if(isset($_POST['add_user'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['usr_f_name'])){
		$nm = $_POST['usr_f_name'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['usr_email'])){
		if(is_email($_POST['usr_email'])){
		$eml = $_POST['usr_email'];
		}else{
			die('Email not Valid');
		}
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['usr_pw'])){
		$pw = md5(md5(sha1($_POST['usr_pw'])));
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['usr_acc']) and is_numeric($_POST['usr_acc'])){
		if(in_range($_POST['usr_acc'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 2');
		}
		$ad = $_POST['usr_acc'];
	}else{
		die('Enter all Fields Correctly 3');
	}
	############################33333333
	if(isset($_POST['usr_acc_l']) and is_numeric($_POST['usr_acc_l'])){
		if(in_range($_POST['usr_acc_l'],0,10,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 4');
		}
		$adlvl = $_POST['usr_acc_l'];
	}else{
		die('Enter all Fields Correctly 2');
	}
	############################33333333
	if(isset($_POST['usr_validtill']) and is_numeric($_POST['usr_validtill'])){
		$vldtll = $_POST['usr_validtill'];
		if(trim($vldtll) == 0){
			$valid_till = 0;
		}else{
			$valid_till = (time()+ $vldtll);
		}
	}else{
		die('Enter all Fields Correctly 1');
	}
	############################33333333
#########################
$ui = explode(' ',$nm);
$fn = str_split($ui[0]);
$ln = str_split(end($ui));
$fncount = count($fn)-1;
$lncount = count($ln)-1;
$ujl=array();
for($sa=0;$sa<9;$sa++){
	$fr = rand(1,2);
	if($fr==1){
		$sr = rand(0,$fncount);
		$ujl[]=$fn[$sr];
	}else if($fr==2){
		$tr = rand(0,$lncount);
		$ujl[]=$ln[$tr];
	}else{
		die('ERROR#MA3');
	}
	
}

#######################################################################################################3


$usr = strtolower($ujl[0].$ujl[1].$ujl[3].$ujl[4].$ujl[5].$ujl[6].$ujl[7].$ujl[8].rand(1,10));
$hash = gen_hash($pw,$eml);

$checkusrnm = getdatafromsql($conn,"select * from mun_logins where lum_username = '".trim($usr)."'");
if(is_array($checkusrnm)){
	die("Please refresh the Page and resend the post values .");
}
$iv = 1098541894 .rand(100000,999999);

#########################
	if($conn->query("INSERT INTO `mun_logins`(`lum_email`, `lum_username`, `lum_password`, `lum_hash_mix`, `lum_ad`, `lum_ad_level`) VALUES 
	('".trim($eml)."', '".trim($usr)."', '".trim($pw)."', '".trim($hash)."', '".trim($ad)."', '".trim($adlvl)."')")){





	##
		$ltid = $conn->insert_id;
		
						##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_logins','insert', "INSERT INTO `mun_logins`(`lum_email`, `lum_username`, `lum_password`, `lum_hash_mix`, `lum_ad`, `lum_ad_level`) VALUES 
	('".trim($eml)."', '".trim($usr)."', '".trim($pw)."', '".trim($hash)."', '".trim($ad)."', '".trim($adlvl)."')" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###



	$sqlb = "INSERT INTO `mun_users`(`usr_name`, `usr_rel_lum_id`, `usr_dob_timestamp`,  `usr_iv`, `usr_reg_dnt`, `usr_reg_ip`, `usr_reg_country`, `usr_lat`, `usr_long`) VALUES (
'".$nm."',
'".$ltid."',
'".time()."',
'".$iv."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."',
'india',
'28.6667',
'77.4333'
)";

	if ($conn->query($sqlb) === TRUE) {
				##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_users','insert', $sqlb ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	
    header('Location: admin_user.php');
} else {
    echo "Error##rujioma";
}
	

	##
	
	}else{
		die('ERRMAIGOTURG');
	}
}
##
##
if(isset($_POST['add_sys_user'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['sys_usr_acc']) and is_numeric($_POST['sys_usr_acc'])){
		if(in_range($_POST['sys_usr_acc'],0,10,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 4');
		}
		
		$adlvl = $_POST['sys_usr_acc'];
		if($adlvl == 0){
			$ad = 0;
		}else{
			$ad = 1;
		}
	}else{
		die('Enter all Fields Correctly 2');
	}
	############################33333333
	if(isset($_POST['sys_usr_validtill']) and is_numeric($_POST['sys_usr_validtill'])){
		$vldtll = $_POST['sys_usr_validtill'];
		if(trim($vldtll) == 0){
			$valid_till = 0;
		}else{
			$valid_till = (time()+ $vldtll);
		}
	}else{
		die('Enter all Fields Correctly 1');
	}
#########################

$email = uniqid().rand(2342,23432).'@mun.circuit';
$pw = md5(md5(sha1('commonpassword')));
$usr = strtolower(md5(time().sha1(uniqid().time()).uniqid().rand(234531,5643534)));

$hash = gen_hash($pw,$email);

$checkusrnm = getdatafromsql($conn,"select * from mun_logins where lum_username = '".trim($usr)."'");
if(is_array($checkusrnm)){
	die("Please refresh the Page and resend the post values .");
}
$iv = 1098541894 .rand(100000,999999);

#########################
	if($conn->query("INSERT INTO `mun_logins`(`lum_email`, `lum_username`, `lum_password`, `lum_hash_mix`, `lum_ad`, `lum_ad_level`) VALUES 
	('".trim($email)."', '".trim($usr)."', '".trim($pw)."', '".trim($hash)."', '".trim($ad)."', '".trim($adlvl)."')")){
	##
	




		$ltid = $conn->insert_id;
					##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_logins','insert', "INSERT INTO `mun_logins`(`lum_email`, `lum_username`, `lum_password`, `lum_hash_mix`, `lum_ad`, `lum_ad_level`) VALUES 
	('".trim($email)."', '".trim($usr)."', '".trim($pw)."', '".trim($hash)."', '".trim($ad)."', '".trim($adlvl)."')" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

	$sqlb = "INSERT INTO `mun_users`(`usr_name`, `usr_rel_lum_id`, `usr_dob_timestamp`,  `usr_iv`, `usr_reg_dnt`, `usr_reg_ip`, `usr_reg_country`, `usr_lat`, `usr_long`) VALUES (
'Mun Circuit User',
'".$ltid."',
'".time()."',
'".$iv."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."',
'india',
'28.6667',
'77.4333'
)";

	if ($conn->query($sqlb) === TRUE) {
			##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_users','insert', $sqlb ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###





    header('Location: admin_user.php');
} else {
    echo "Error##rujioma";
}
	

	##
	
	}else{
		die('ERRMAIGOTURG');
	}
}
#
#
#_______________________________START ADMINMUN_______________________
if(isset($_POST['hash_inc']) and isset($_POST['com_make_ac'])){
	if(ctype_alnum(trim($_POST['ha_com']))){
		$checkit = getdatafromsql($conn,"select * from mun_rec where md5(md5(sha1(sha1(md5(md5(concat(mun_id,'jijnfiirjfnirokijfkorkvnkorvfk'))))))) = '".$_POST['ha_com']."' and mun_valid =0");
		
		if(is_array($checkit)){
			if($conn->query("update mun_rec set mun_valid =1 where mun_id= ".$checkit['mun_id']."")){
								##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_rec','update', "update mun_rec set mun_valid =1 where mun_id= ".$checkit['mun_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_mun.php');
			}else{
				die('ERRRMA!JOINJFO');
			}
		}else{
			die("No Mun\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#
if(isset($_POST['ha_com']) and isset($_POST['com_make_inac'])){
	if(ctype_alnum(trim($_POST['ha_com']))){
		$checkit = getdatafromsql($conn,"select * from mun_rec where md5(md5(sha1(sha1(md5(md5(concat(mun_id,'egkjtnr newsdnjjenfkv ijfkorkvnkorvfk'))))))) = '".$_POST['ha_com']."' and mun_valid = 1");
		
		if(is_array($checkit)){
			if($conn->query("update mun_rec set mun_valid =0 where mun_id= ".$checkit['mun_id']."")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_rec','update', "update mun_rec set mun_valid =0 where mun_id= ".$checkit['mun_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_mun.php');
			}else{
				die('ERRRMA!JOINJFWFEAO');
			}
		}else{
			die("No Mun\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#_______________________________END ADMINMUN_______________________
#_______________________________START MODULES_______________________
if(isset($_POST['hash_ac']) and isset($_POST['tab_act'])){
	if(ctype_alnum(trim($_POST['hash_ac']))){
		$checkit = getdatafromsql($conn,"select * from mun_modules where md5(md5(sha1(sha1(md5(md5(concat(mo_id,'njhifverkof2njbivjwj bfurhib2jw'))))))) = '".$_POST['hash_ac']."' and mo_valid =0");
		
		if(is_array($checkit)){
			if($conn->query("update mun_modules set mo_valid =1 where mo_id= ".$checkit['mo_id']."")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_modules','update', "update mun_modules set mo_valid =1 where mo_id= ".$checkit['mo_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_mods.php');
			}else{
				die('ERRRMA!JOIrfedNJFO');
			}
		}else{
			die("No Modules\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#
if(isset($_POST['hash_inc']) and isset($_POST['tab_inact'])){
	if(ctype_alnum(trim($_POST['hash_inc']))){
		$checkit = getdatafromsql($conn,"select * from mun_modules where md5(md5(sha1(sha1(md5(md5(concat(mo_id,'hbujeio03ir94urghnjefr 309i4wef'))))))) = '".$_POST['hash_inc']."' and mo_valid =1");
		
		if(is_array($checkit)){
			if($conn->query("update mun_modules set mo_valid =0 where mo_id= ".$checkit['mo_id']."")){				
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_modules','update', "update mun_modules set mo_valid =0 where mo_id= ".$checkit['mo_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


								header('Location: admin_mods.php');
			}else{
				die('ERRRMAjn4rifJOINJFWFEAO');
			}
		}else{
			die("No Modules\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#_______________________________END MODULES_______________________
#_______________________________START USER_______________________
if(isset($_POST['yh_com']) and isset($_POST['usr_make_ac'])){
	if(ctype_alnum(trim($_POST['yh_com']))){
		$checkit = getdatafromsql($conn,"select * from mun_logins where 
		md5(md5(sha1(sha1(md5(md5(concat(lum_id,'hir39efnewsfejirjeofkvjrjdnjjenfkvkijonreij3nj'))))))) = '".$_POST['yh_com']."' and lum_valid = 0");
		
		if(is_array($checkit)){
			if($checkit['lum_email'] == 'ayanzcap@hotmail.com'){
				die('Super user can\'t be modified');
			}
			if($conn->query("update mun_logins set lum_valid =1 where lum_id= ".$checkit['lum_id']."")){
								
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_logins','update', "update mun_logins set lum_valid =1 where lum_id= ".$checkit['lum_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_user.php');
			}else{
				die('ERRMA3jonkj34oirvfingj');
			}
		}else{
			die("No User Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#
if(isset($_POST['yh_com']) and isset($_POST['usr_make_inac'])){
	if(ctype_alnum(trim($_POST['yh_com']))){
		$checkit = getdatafromsql($conn,"select * from mun_logins where 
		md5(md5(sha1(sha1(md5(md5(concat(lum_id,'hir39efnewsfejirjrjdnjjenfkv ijfkorkvnkorvfk'))))))) = '".$_POST['yh_com']."' and lum_valid = 1");
		
		if(is_array($checkit)){
			if($checkit['lum_email'] == 'ayanzcap@hotmail.com'){
				die('Super user can\'t be deleted');
			}
			if($conn->query("update mun_logins set lum_valid =0 where lum_id= ".$checkit['lum_id']."")){
				
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_logins','update', "update mun_logins set lum_valid =0 where lum_id= ".$checkit['lum_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




				
								header('Location: admin_user.php');
			}else{
				die('ERRMA3joingj');
			}
		}else{
			die("No User Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#_______________________________END USER_______________________
##
##
if(isset($_POST['edit_com'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['h_com'])){
		if(ctype_alnum(trim($_POST['h_com']))){
			$editmun = getdatafromsql($conn,"select * from mun_rec where md5(md5(sha1(sha1(md5(md5(concat(mun_id,'9irbfheierifhe3 4r3r04 j49i4u49igrhru9git'))))))) = '".$_POST['h_com']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	if(isset($_POST['mun_edit_shrtnme'])){
		$shortname = trim($_POST['mun_edit_shrtnme']);
	}else{
		die('Enter all Values 1');
	}
	
	if(isset($_POST['mun_edit_fullnme'])){
		$longname = trim($_POST['mun_edit_fullnme']);
	}else{
		die('Enter all Values 2');
	}
	
	if(isset($_POST['mun_edit_hosat'])){
		$hostedat = trim($_POST['mun_edit_hosat']);
	}else{
		die('Enter all Values 3');
	}
	
	if(isset($_POST['mun_edit_hosaddr'])){
		$hostedataddr = trim($_POST['mun_edit_hosaddr']);
	}else{
		die('Enter all Values 4');
	}
	
	if(isset($_POST['mun_edit_web'])){
		$website = trim($_POST['mun_edit_web']);
	}else{
		die('Enter all Values 5');
	}
	
	if(isset($_POST['mun_edit_eml'])){
		if(is_email($_POST['mun_edit_eml'])){
			$neml = trim($_POST['mun_edit_eml']);
		}else{
			die('Invalid Email');
		}
	}else{
		die('Enter all Values 5.3');
	}
	
	if(isset($_POST['mun_edit_contcno'])){
		$contc = trim($_POST['mun_edit_contcno']);
	}else{
		die('Enter all Values 55');
	}
	
	if(isset($_POST['mun_edit_country'])){
		$ncountry = trim($_POST['mun_edit_country']);
	}else{
		die('Enter all Values 5.,5');
	}
	
	
	if(isset($_POST['mun_edit_lat'])){
		$newlat = trim($_POST['mun_edit_lat']);
	}else{
		die('Enter all Values 6');
	}	
	if(isset($_POST['mun_edit_long'])){
		$newlong = trim($_POST['mun_edit_long']);
	}else{
		die('Enter all Values 6');
	}
	
	if(isset($_POST['mun_edit_idenbg'])){
		$newidenbg= trim($_POST['mun_edit_idenbg']);
	}else{
		die('Enter all Values 6');
	}
	
	
	if(isset($_POST['mun_edit_idenfc'])){
		$newidenfc= trim($_POST['mun_edit_idenfc']);
	}else{
		die('Enter all Values 6');
	}
	
	if(isset($_POST['mun_edit_startdate'])){
		$startday = dtots(trim($_POST['mun_edit_startdate']));
	}else{
		die('Enter all Values 8');
	}
	
	if(isset($_POST['mun_edit_enddate'])){
		$endday = dtots(trim($_POST['mun_edit_enddate']));
	}else{
		die('Enter all Values 9');
	}
	
	
	if(1==0){
		#You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes #
		die("You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes ");
	}else{
		if($conn->query("UPDATE `mun_rec` SET 
`mun_shortname`= '".$shortname."',
`mun_year`='".date('Y',trim($startday))."',
`mun_fullname`='".$longname."',
`mun_hostedat`='".$hostedat."',
`mun_hosted_addr`='".$hostedataddr."',
`mun_website`='".$website."',
`mun_country`='".$ncountry."',
`mun_email` = '".$neml."',
`mun_lat`='".$newlat."',
`mun_long`='".$newlong."',
`mun_contact_no` = '".$contc."',
`mun_from`='".trim($startday)."',
`mun_till`='".trim($endday)."',
`mun_iden_color`='".trim($newidenbg)."',
`mun_text_color`='".trim($newidenfc)."'
where mun_id = ".trim($editmun['mun_id'])."")){
		##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['MUNC_USR_DB_ID'],'mun_rec','update',"UPDATE `mun_rec` SET 
`mun_shortname`= '".$shortname."',
`mun_year`='".date('Y',trim($startday))."',
`mun_fullname`='".$longname."',
`mun_hostedat`='".$hostedat."',
`mun_hosted_addr`='".$hostedataddr."',
`mun_website`='".$website."',
`mun_country`='".$ncountry."',
`mun_email` = '".$neml."',
`mun_lat`='".$newlat."',
`mun_long`='".$newlong."',
`mun_contact_no` = '".$contc."',
`mun_from`='".trim($startday)."',
`mun_till`='".trim($endday)."',
`mun_iden_color`='".trim($newidenbg)."',
`mun_text_color`='".trim($newidenfc)."'
where mun_id = ".trim($editmun['mun_id'])."",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

	header('Location: admin_mun.php');
		}else{
			die('ERRMAers');
		}
	}

}
##
##
if(isset($_POST['edit_mod'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_emmp__1i'])){
		if(ctype_alnum(trim($_POST['hash_emmp__1i']))){
			$editmun = getdatafromsql($conn,"select * from mun_modules where md5(md5(sha1(sha1(md5(md5(concat(mo_id,'lkoegnuifvh bnn njenjn'))))))) = '".$_POST['hash_emmp__1i']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	############################33333333
	if(isset($_POST['edit_mod_lngnme'])){
		$nm = $_POST['edit_mod_lngnme'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_shrtnme'])){
		$href = $_POST['edit_mod_shrtnme'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_icon'])){
		$ico = $_POST['edit_mod_icon'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_sub']) and is_numeric($_POST['edit_mod_sub'])){
		if(in_range($_POST['edit_mod_sub'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$subm = $_POST['edit_mod_sub'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_ifadmin']) and is_numeric($_POST['edit_ifadmin'])){
		if(in_range($_POST['edit_ifadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 2');
		}
		$ifadm = $_POST['edit_ifadmin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_ifnoadmin']) and is_numeric($_POST['edit_ifnoadmin'])){
		if(in_range($_POST['edit_ifnoadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 3');
		}
		$ifnoadm = $_POST['edit_ifnoadmin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_ifnologin']) and is_numeric($_POST['edit_ifnologin'])){
		if(in_range($_POST['edit_ifnologin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 4');
		}
		$ifnlogin = $_POST['edit_ifnologin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_iflogin']) and is_numeric($_POST['edit_iflogin'])){
		if(in_range($_POST['edit_iflogin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 5');
		}
		$iflogin = $_POST['edit_iflogin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333

	
	if(1==0){
		#You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes #
		die("You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes ");
	}else{
		if($conn->query("UPDATE `mun_modules` SET 
`mo_name`= '".$nm."',
`mo_href`='".$href."',
`mo_icon`='".$ico."',
`mo_ifadmin`='".$ifadm."',
`mo_ifnoadmin`='".$ifnoadm."',
`mo_if_no_log_in`='".$ifnlogin."',
`mo_if_log_in`='".$iflogin."',
`mo_sub_mod`='".$subm."'
where mo_id = ".trim($editmun['mo_id'])."")){
	
	
	##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['MUNC_USR_DB_ID'],'mun_modules','update',"UPDATE `mun_modules` SET 
`mo_name`= '".$nm."',
`mo_href`='".$href."',
`mo_icon`='".$ico."',
`mo_ifadmin`='".$ifadm."',
`mo_ifnoadmin`='".$ifnoadm."',
`mo_if_no_log_in`='".$ifnlogin."',
`mo_if_log_in`='".$iflogin."',
`mo_sub_mod`='".$subm."'
where mo_id = ".trim($editmun['mo_id'])."",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: admin_mods.php');
		}else{
			die('ERRMAerskirore9njr3ei9jinj');
		}
	}

}
##
##
if(isset($_POST['edit_user'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_chkr'])){
		if(ctype_alnum(trim($_POST['hash_chkr']))){
			$editmun = getdatafromsql($conn,"select * from mun_logins where md5(md5(sha1(sha1(md5(md5(concat(lum_id,'f2frbgbe 2fgtegrfr3gbter 24rfgr324frgtr3f 3gr32fgr32f4gr'))))))) = '".$_POST['hash_chkr']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	if(isset($_POST['edit_us_username'])){
		$unm = trim($_POST['edit_us_username']);
	}else{
		die('Enter all Values 1');
	}
	
	if(isset($_POST['edit_us_nme'])){
		$nm = trim($_POST['edit_us_nme']);
	}else{
		die('Enter all Values 2');
	}
	
	if(isset($_POST['edit_us_pw'])){
		$pt = trim($_POST['edit_us_pw']);
		if(trim($pt) == '-'){
			$pw = $editmun['lum_password'];
			$hash = $editmun['lum_hash_mix'];
		}else{
			$pw = md5(md5(sha1(trim($_POST['edit_us_pw']))));
			$hash = gen_hash($pw,trim($editmun['lum_email']));
		}
	}else{
		die('Enter all Values 3');
	}
	
	if(isset($_POST['edit_us_adm']) and is_numeric($_POST['edit_us_adm'])){
		if(in_range($_POST['edit_us_adm'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$admer = $_POST['edit_us_adm'];
	}else{
		die('Enter all Fields Correctly');
	}
	
	if(isset($_POST['edit_us_amdlvl']) and is_numeric($_POST['edit_us_amdlvl'])){
		if(in_range($_POST['edit_us_amdlvl'],0,10,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$admlvl = $_POST['edit_us_amdlvl'];
	}else{
		die('Enter all Fields Correctly');
	}
	

	
	if(isset($_POST['edit_us_prfpic'])){
		$nprofpic = trim($_POST['edit_us_prfpic']);
	}else{
		die('Enter all Values 5.,5');
	}
	
	
	if(isset($_POST['edit_us_prfbgpc'])){
		$nprofbg = trim($_POST['edit_us_prfbgpc']);
	}else{
		die('Enter all Values 6');
	}	
	if(isset($_POST['edit_us_dob'])){
		if(is_numeric($_POST['edit_us_dob'])){
			$dob = trim($_POST['edit_us_dob']);
		}else{
			die("Invalid dob");
		}
	}else{
		die('Enter all Values 6d');
	}
	
	if(isset($_POST['edit_us_lat'])){
		$edit_us_lat= trim($_POST['edit_us_lat']);
	}else{
		die('Enter all Values 6w');
	}
	
	
	if(isset($_POST['edit_us_lng'])){
		$edit_us_lng= trim($_POST['edit_us_lng']);
	}else{
		die('Enter all Values 64');
	}
	
	if(isset($_POST['edit_us_till'])){
		$startday =trim($_POST['edit_us_till']);
		if(($startday == '0') or ($startday == 0)){
			$usrtill = 0;
		}else{
			$usrtill = time() + (60*$_POST['edit_us_till']);
		}
	}else{
		die('Enter all Values 8');
	}
		
	if(1==0){
		#You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes #
		die("You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes ");
	}else{
		$querytobeinserted = "
UPDATE 
	`mun_logins` a,
	`mun_users` b 
SET 
	a.lum_username= '".$unm."',
	a.lum_password='".trim($pw)."',
	a.lum_hash_mix='".$hash."',
	a.lum_ad='".$admer."',
	a.lum_ad_level='".$admlvl."',
	b.usr_name='".$nm."',
	b.usr_prof_pic='".$nprofpic."',
	b.usr_back_pic = '".$nprofbg."',
	b.usr_dob_timestamp='".$dob."',
	b.usr_lat='".$edit_us_lat."',
	b.usr_long= '".$edit_us_lng."',
	b.usr_validtill='".trim($usrtill)."'
WHERE
	a.lum_id = b.usr_rel_lum_id and 
	a.lum_id = ".trim($editmun['lum_id'])."";
		if($conn->query($querytobeinserted)){
		
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_logins','update',$querytobeinserted,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

	header('Location: admin_user.php');
		}else{
			die('EmrfuRRMAers');
		}
	}

}
##
##
if(isset($_POST['_wysihtml5_mode'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['ml_s_to'])){
		if(is_email($_POST['ml_s_to'])){
			
			$email = $_POST['ml_s_to'];
			if($_SESSION['MUNC_USR_DB_ID'] == 1){
			}else{
$etdatus = getdatafromsql($conn,"select * from mun_logins where lum_email = '".trim($email)."'");
		if(is_string($etdatus)){
			die('You can only send Emails to Mun Circuit Registered Accounts!');
		}
			}
			
		}else{
			die('Invalid Email');
		}
	}else{
		die('Invalid');
	}
	
	
#########################
	if(isset($_POST['ml_s_subj'])){
		$subject = $_POST['ml_s_subj'];
	}else{
		die('Invalid 1');
	}
#########################

	if(isset($_POST['ml_s_txt'])){
		$text = $_POST['ml_s_txt'];
	}else{
		die('Invalid');
	}
	#############
			
		#
		$message = "
<html>
<head>
<title>Re: ".$subject."</title>
</head>
<body>

<br><br>

".$text."<br>
<br>

Please do not reply to this email.</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <do-not-reply@munc.com>' . "\r\n";
$headers .= 'Bcc: com.aa.ay@gmail.com' . "\r\n";

if(mail($email,'Re: '.$subject.'',$message,$headers)){
	
	if($conn->query("INSERT INTO
	 `mun_send_email`(`eml_rel_usr_id`, `eml_to`, `eml_subj`, `eml_txt`, `eml_dnt`) VALUES (
	'".$getdatus['lum_id']."',
	'".$email."',
	'".$subject."',
	'".$text."',
	'".time()."'
	)")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_send_email','insert', "INSERT INTO
	 `mun_send_email`(`eml_rel_usr_id`, `eml_to`, `eml_subj`, `eml_txt`, `eml_dnt`) VALUES (
	'".$getdatus['lum_id']."',
	'".$email."',
	'".$subject."',
	'".$text."',
	'".time()."'
	)" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	echo 'An email was sent to the recipient <a href="admin_send_mail.php"><button>Go Back</button></a> ';
	}else{
		die("EERRMAjhenrviui3ijg");
	}
	
}else{
	echo 'Mail not sent';
}
		#
}
#########################
#
#
if(isset($_POST['mun_admin_ch_img']) and ctype_alnum(trim($_POST['mun_admin_ch_img']))){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}

	
	if(isset($_POST['mun_admin_ch_img_h']) and ctype_alnum($_POST['mun_admin_ch_img_h'])){
		##
$editmun = getdatafromsql($conn,"select * from mun_rec where md5(sha1(md5(md5(concat(mun_id,'2415972129601522 65 65468 405405834 534086409844 8604y8r64hg68y 4t9jgnh5348t 5f3y4vj1n 89e4y6e4908t04 8tyj'))))) = '".$_POST['mun_admin_ch_img_h']."'");
	if(is_string($editmun)){
				die('Hash Not Found');
	}
	
	if((count($_FILES) == 0)){
			die('Nothing to Upload');
	}
	
	if((count($_FILES['mun_admin_img_chd']['tmp_name']) == 1) and (trim(strlen($_FILES['mun_admin_img_chd']['tmp_name'])) > 2)){
	
	
	####################333
	$target_dir = "logos/";
	
$target_file = $target_dir .md5($_FILES["mun_admin_img_chd"]["name"].$_FILES["mun_admin_img_chd"]["tmp_name"].$_FILES["mun_admin_img_chd"]["size"]).uniqid().'_'.md5(time()).'.'. extension($_FILES["mun_admin_img_chd"]["name"]);
$uploadOk = 1;
$err_arr = array();

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["mun_admin_ch_img"])) {
    $check = getimagesize($_FILES["mun_admin_img_chd"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $err_arr[]="File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $err_arr[]= "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["mun_admin_img_chd"]["size"] > 1200000) {
    $err_arr[]= "Sorry, your file is too large. (more than 1 mb)";
    $uploadOk = 0;
}
// Allow certain file formats
if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
&& strtolower($imageFileType) != "gif" ) {
    $err_arr[]= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	foreach($err_arr as $err){
		echo $err.'<br>';
	}
    die("Sorry, your file was not uploaded.");

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["mun_admin_img_chd"]["tmp_name"], $target_file)) {
        #dbupdate
		if($conn->query("UPDATE `mun_rec` SET 
`mun_img_src`='".trim($target_file)."'
where mun_id = ".trim($editmun['mun_id'])."")){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['MUNC_USR_DB_ID'],'mun_rec','update', "UPDATE `mun_rec` SET 
`mun_img_src`='".trim($target_file)."'
where mun_id = ".trim($editmun['mun_id'])."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: admin_mun.php');
		}else{
			die('ERRMAIUOHJ(jnfI)(');
		}
		
		#dbupdate
		
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}
	####################333
	}
	
	
##
	}else{
		die('Invalid Hash');
	}
	
	
		#######
}
##
##
if(isset($_POST['u_add_m'])){
		if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}


	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		
	}else{
		die('Please login to continue <a href="index.php"><button>Login</button></a>');
	}
	
	if(count($_POST) == 14){
		if(isset($_POST['u_add_m'])){
		}else{
			die('Enter all Values 1');
		}
		
		if(isset($_POST['u_add_m_m_sn'])){
		}else{
			die('Enter all Values 2');
		}
		if(isset($_POST['u_add_m_m_ln'])){
		}else{
			die('Enter all Values 3');
		}
		if(isset($_POST['u_add_m_m_yr'])){
		}else{
			die('Enter all Values 4');
		}
		if(isset($_POST['u_add_m_m_eml'])){
		}else{
			die('Enter all Values 5');
		}
		if(isset($_POST['u_add_m_m_webs'])){
		}else{
			die('Enter all Values 6');
		}
		if(isset($_POST['u_add_m_m_mobs'])){
		}else{
			die('Enter all Values 7');
		}
		if(isset($_POST['u_add_m_m_hstdat'])){
		}else{
			die('Enter all Values 8');
		}
		if(isset($_POST['u_add_m_m_hstdadd'])){
		}else{
			die('Enter all Values 9');
		}
		if(isset($_POST['u_add_m_m_ins_lat'])){
		}else{
			die('Enter all Values 10');
		}
		if(isset($_POST['u_add_m_m_ins_lng'])){
		}else{
			die('Enter all Values 11');
		}
		if(isset($_POST['u_add_m_m_country'])){
		}else{
			die('Enter all Values 12');
		}
		if(isset($_POST['u_add_m_m_stdt'])){
		}else{
			die('Enter all Values 13');
		}
		if(isset($_POST['u_add_m_m_endt'])){
		}else{
			die('Enter all Values 14');
		}
		
	}else{
		die('Values Entered dont match field count');
	}
	
	if((count($_FILES) == 0)){
			die('Nothing to Upload');
	}
	if(isset($_FILES['u_add_m_m_lo'])){
	
	
	if((count($_FILES['u_add_m_m_lo']['tmp_name']) == 1) and (trim(strlen($_FILES['u_add_m_m_lo']['tmp_name'])) > 2)){
	}else{
		die('Only one image allowed to upload');
	}
	}
	else{
		die("Image to Upload not found");
	}
	if(is_numeric($_POST['u_add_m_m_yr'])){
		if(    (($_POST['u_add_m_m_yr'] -1 ) == date("Y",time()))  or (date("Y",time()) == date("Y",time())) or (date("Y",time()) > (date("Y",time()) -4) ) ){
		}else{
			die("Date can only be one year in future and 4 years in past");
		}
	}else{
		die('Invalid Year');
	}
	
	if(isset($_POST['u_add_m_m_stdt'])){
		$_POST['u_add_m_m_stdt'] = dtots(trim($_POST['u_add_m_m_stdt']));
	}else{
		die('Enter all Values 8');
	}
	
	if(isset($_POST['u_add_m_m_endt'])){
		$_POST['u_add_m_m_endt'] = dtots(trim($_POST['u_add_m_m_endt']));
	}else{
		die('Enter all Values 9');
	}
	
	
if(date("Y",$_POST['u_add_m_m_stdt']) == $_POST['u_add_m_m_yr']){
}else{
	die('Invalid Date and year combination');
}

if(date("Y",$_POST['u_add_m_m_endt']) <= $_POST['u_add_m_m_yr']){
}else{
	die('Invalid Date and year combination');
}
	
if($_POST['u_add_m_m_stdt'] >= $_POST['u_add_m_m_endt']){
	die('The Mun Should atleast last a day');
}
	
	
	###########3


		$target_dir = "logos/";
	
$target_file = $target_dir .md5($_FILES["u_add_m_m_lo"]["name"].$_FILES["u_add_m_m_lo"]["tmp_name"].$_FILES["u_add_m_m_lo"]["size"]).uniqid().'_'.md5(time()).'.'. extension($_FILES["u_add_m_m_lo"]["name"]);
$uploadOk = 1;
$err_arr = array();

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["u_add_m"])) {
    $check = getimagesize($_FILES["u_add_m_m_lo"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $err_arr[]="File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $err_arr[]= "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["u_add_m_m_lo"]["size"] > 1200000) {
    $err_arr[]= "Sorry, your file is too large. (more than 1 mb)";
    $uploadOk = 0;
}
// Allow certain file formats
if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
&& strtolower($imageFileType) != "gif" ) {
    $err_arr[]= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	foreach($err_arr as $err){
		echo $err.'<br>';
	}
    die("Sorry, your file was not uploaded.");

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["u_add_m_m_lo"]["tmp_name"], $target_file)) {
        #dbupdate
		if($conn->query("INSERT INTO `mun_rec`(`mun_shortname`, `mun_year`, `mun_img_src`, `mun_fullname`, `mun_hostedat`, `mun_hosted_addr`, `mun_website`, `mun_email`, `mun_country`, `mun_lat`, `mun_long`, `mun_from`, `mun_till`, `mun_contact_no`) VALUES (
		'".$_POST['u_add_m_m_sn']."',
		'".$_POST['u_add_m_m_yr']."',
		'".$target_file."',
		'".$_POST['u_add_m_m_ln']."',
		'".$_POST['u_add_m_m_hstdat']."',
		'".$_POST['u_add_m_m_hstdadd']."',
		'".$_POST['u_add_m_m_webs']."',
		'".$_POST['u_add_m_m_eml']."',
		'".$_POST['u_add_m_m_country']."',
		'".$_POST['u_add_m_m_ins_lat']."',
		'".$_POST['u_add_m_m_ins_lng']."',
		'".$_POST['u_add_m_m_stdt']."',
		'".$_POST['u_add_m_m_endt']."',
		'".$_POST['u_add_m_m_mobs']."'		)")){
					


			
			$mun_id = $conn->insert_id;
			##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_rec','insert', "INSERT INTO `mun_rec`(`mun_shortname`, `mun_year`, `mun_img_src`, `mun_fullname`, `mun_hostedat`, `mun_hosted_addr`, `mun_website`, `mun_email`, `mun_country`, `mun_lat`, `mun_long`, `mun_from`, `mun_till`, `mun_contact_no`) VALUES (
		'".$_POST['u_add_m_m_sn']."',
		'".$_POST['u_add_m_m_yr']."',
		'".$target_file."',
		'".$_POST['u_add_m_m_ln']."',
		'".$_POST['u_add_m_m_hstdat']."',
		'".$_POST['u_add_m_m_hstdadd']."',
		'".$_POST['u_add_m_m_webs']."',
		'".$_POST['u_add_m_m_eml']."',
		'".$_POST['u_add_m_m_country']."',
		'".$_POST['u_add_m_m_ins_lat']."',
		'".$_POST['u_add_m_m_ins_lng']."',
		'".$_POST['u_add_m_m_stdt']."',
		'".$_POST['u_add_m_m_endt']."',
		'".$_POST['u_add_m_m_mobs']."'		)" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


			$editmun = getdatafromsql($conn,"select * from mun_rec where mun_id = '".$mun_id."'");

			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
			
			if($conn->query("INSERT INTO `mun_claim_requests`(`cl_rel_lum_id`, `cl_rel_mun_id`, `cl_granted`, `cl_mail_sent`, `cl_gen_time`, `cl_ip`, `cl_mun_owned`, `cl_valid`) VALUES (
			'".$_SESSION['MUNC_USR_DB_ID']."',
			'".$mun_id."',
			'1',
			'1',
			'".time()."',
			'".$_SERVER['REMOTE_ADDR']."',
			'1',
			'1')
			
			")){
						##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_claim_requests','insert', "INSERT INTO `mun_claim_requests`(`cl_rel_lum_id`, `cl_rel_mun_id`, `cl_granted`, `cl_mail_sent`, `cl_gen_time`, `cl_ip`, `cl_mun_owned`, `cl_valid`) VALUES (
			'".$_SESSION['MUNC_USR_DB_ID']."',
			'".$mun_id."',
			'1',
			'1',
			'".time()."',
			'".$_SERVER['REMOTE_ADDR']."',
			'1',
			'1')
			
			" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###





			}else{
				die('Your Mun Could Not be Claimed ERRMAERDTGVERDTF');
			}
			
	header('Location: mymuns.php');
		}else{
			die('ERRMAIUOHJ(jnfI)(');
		}
		
		#dbupdate
		
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}

	###########3
	
	
	
	
}
##
##claim
if(isset($_POST['edit_claim'])){
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_cl_d'])){
		if(ctype_alnum(trim($_POST['hash_cl_d']))){
			$editclaim = getdatafromsql($conn,"select * from mun_claim_requests where md5(md5(sha1(sha1(md5(md5(concat(cl_id,'lkoegnuifvh bnn njenjn'))))))) = '".$_POST['hash_cl_d']."'");
			
			
			if(is_string($editclaim)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Found');
	}

	if(isset($_POST['edit_claim_mun'])){
		if(ctype_alnum(trim($_POST['edit_claim_mun']))){
			$editmun = getdatafromsql($conn,"select * from mun_rec where md5(sha1(md5(md5(concat(mun_id,'i9ujhu3birfviok3iojrwoiugueioutdrgoiuevoisur09giwjrsgiuejisxrg veoidrijgoieshrgjredf'))))) = '".$_POST['edit_claim_mun']."'");
			
			
			if(is_string($editmun)){
				die('Mun Hash Not Found');
			}
		}else{
			die('Invalid mun hash ');
		}
	}else{
		die('Mun not found');
	}

if($editclaim['cl_rel_mun_id'] == $editmun['mun_id']){
}else{
	
			$checkvalid = getdatafromsql($conn,"select * from mun_claim_requests where cl_rel_mun_id = ".$editmun['mun_id']." and cl_rel_lum_id = ".$editclaim['cl_rel_lum_id']."");
			
			
			if(is_array($checkvalid)){
				die('This Mun has already been claimed by the user');
			}
		
}


if(isset($_POST['edit_claims_cl_granted_f'])){
	if(is_numeric($_POST['edit_claims_cl_granted_f'])){
		if(($_POST['edit_claims_cl_granted_f'] == 0 ) or ($_POST['edit_claims_cl_granted_f'] == 1)){
		}else{
			die('Only 1 or 0 are allowed for granted values');
		}
	}else{
		die('Invalid Granting Value');
	}
}else{
	die('Please enter all fields');
}

if(isset($_POST['edit_claim_mlsent'])){
	if(is_numeric($_POST['edit_claim_mlsent'])){
		if(($_POST['edit_claim_mlsent'] == 0 ) or ($_POST['edit_claim_mlsent'] == 1)){
		}else{
			die('Only 1 or 0 are allowed for Mail values');
		}
	}else{
		die('Invalid Mail Value');
	}
}else{
	die('Please enter all fields (Mail)');
}

if($conn->query("update mun_claim_requests set cl_rel_mun_id = '".$editmun['mun_id']."', cl_granted = '".$_POST['edit_claims_cl_granted_f']."',cl_mail_sent = '".$_POST['edit_claim_mlsent']."' where cl_id = ".$editclaim['cl_id']."")){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($editclaim,$_SESSION['MUNC_USR_DB_ID'],'mun_claim_requests','update', "update mun_claim_requests set cl_rel_mun_id = '".$editmun['mun_id']."', cl_granted = '".$_POST['edit_claims_cl_granted_f']."',cl_mail_sent = '".$_POST['edit_claim_mlsent']."' where cl_id = ".$editclaim['cl_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: admin_claims.php');
}else{
	die('ERRMA(#HUTGBT(I#');
}

}
#
#
if(isset($_POST['add_adm_claim'])){
	##
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}

	if(isset($_POST['add_claim_munid'])){
		if(ctype_alnum(trim($_POST['add_claim_munid']))){
			$editmun = getdatafromsql($conn,"select * from mun_rec where md5(md5(sha1(md5(concat(mun_id,'huihnji0uiu4uewrgv3wsrd'))))) = '".$_POST['add_claim_munid']."'");
			
			
			if(is_string($editmun)){
				die('Mun Hash Not Found');
			}
		}else{
			die('Invalid mun hash ');
		}
	}else{
		die('Mun not found');
	}
	
	
	
		if(isset($_POST['add_claim_lumid'])){
		if(ctype_alnum(trim($_POST['add_claim_lumid']))){
			$useradding = getdatafromsql($conn,"select * from mun_logins 
			where md5(md5(sha1(md5(concat(lum_id,'ekrshuihnji0uiu4uewrgv3wsrd'))))) =
			 '".$_POST['add_claim_lumid']."'");
			
			
			if(is_string($useradding)){
				die('User  Hash Not Found');
			}
		}else{
			die('Invalid User  hash ');
		}
	}else{
		die('User not Entered');
	}
	
	
	

	
			$checkvalid = getdatafromsql($conn,"select * from mun_claim_requests where cl_rel_mun_id = ".$editmun['mun_id']." and cl_rel_lum_id = ".$useradding['lum_id']."");
			
			
			if(is_array($checkvalid)){
				die('This Mun has already been claimed by the user');
			}

if(isset($_POST['add_claim_granted'])){
	if(is_numeric($_POST['add_claim_granted'])){
		if(($_POST['add_claim_granted'] == 0 ) or ($_POST['add_claim_granted'] == 1)){
		}else{
			die('Only 1 or 0 are allowed for granted values');
		}
	}else{
		die('Invalid Granting Value');
	}
}else{
	die('Please enter all fields');
}

if(isset($_POST['add_claim_mlsnt'])){
	if(is_numeric($_POST['add_claim_mlsnt'])){
		if(($_POST['add_claim_mlsnt'] == 0 ) or ($_POST['add_claim_mlsnt'] == 1)){
		}else{
			die('Only 1 or 0 are allowed for Mail values');
		}
	}else{
		die('Invalid Mail Value');
	}
}else{
	die('Please enter all fields (Mail)');
}


if(isset($_POST['add_claim_owned'])){
	if(is_numeric($_POST['add_claim_owned'])){
		if(($_POST['add_claim_owned'] == 0 ) or ($_POST['add_claim_owned'] == 1)){
		}else{
			die('Only 1 or 0 are allowed for Owned values');
		}
	}else{
		die('Invalid owned Value');
	}
}else{
	die('Please enter all fields (owner)');
}

if($conn->query("INSERT INTO `mun_claim_requests`(`cl_rel_lum_id`, `cl_rel_mun_id`, `cl_granted`, `cl_mail_sent`, `cl_gen_time`, `cl_ip`, `cl_mun_owned`) VALUES (
'".$useradding['lum_id']."',
'".$editmun['mun_id']."',
'".$_POST['add_claim_granted']."',
'".$_POST['add_claim_mlsnt']."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."',
'".$_POST['add_claim_owned']."'
)

")){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($useradding,$_SESSION['MUNC_USR_DB_ID'],'mun_claim_requests','insert', "INSERT INTO `mun_claim_requests`(`cl_rel_lum_id`, `cl_rel_mun_id`, `cl_granted`, `cl_mail_sent`, `cl_gen_time`, `cl_ip`, `cl_mun_owned`) VALUES (
'".$useradding['lum_id']."',
'".$editmun['mun_id']."',
'".$_POST['add_claim_granted']."',
'".$_POST['add_claim_mlsnt']."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."',
'".$_POST['add_claim_owned']."'
)

" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	
	
	header('Location: admin_claims.php');
}else{
	die('ERRMATGBT(I#');
}

##
	
}
#
#
if(isset($_POST['cl_mk_inac_ha']) and isset($_POST['cl_mk_inac'])){
	if(ctype_alnum(trim($_POST['cl_mk_inac_ha']))){
		$checkit = getdatafromsql($conn,"select * from mun_claim_requests where md5(md5(sha1(sha1(md5(md5(concat(cl_id,'egkjtnr newsdnjjenfkv ijfkorkvnkorvfk')))))))= '".$_POST['cl_mk_inac_ha']."' and cl_valid =1");
		
		if(is_array($checkit)){
			if($conn->query("update mun_claim_requests set cl_valid =0 where cl_id= ".$checkit['cl_id']."")){				
		##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_claim_requests','update', "update mun_claim_requests set cl_valid =0 where cl_id= ".$checkit['cl_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###





								header('Location: admin_claims.php');
			}else{
				die('ERRRMAj/we/ifJOINJFWFEAO');
			}
		}else{
			die("No Claims\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
if(isset($_POST['cl_mk_ac_ha']) and isset($_POST['cl_mk_ac'])){
	if(ctype_alnum(trim($_POST['cl_mk_ac_ha']))){
		$checkit = getdatafromsql($conn,"select * from mun_claim_requests where md5(md5(sha1(sha1(md5(md5(concat(cl_id,'jijnfiirjfnirokijfkorkvnkorvfk')))))))= '".$_POST['cl_mk_ac_ha']."' and cl_valid =0");
		
		if(is_array($checkit)){
			if($conn->query("update mun_claim_requests set cl_valid =1 where cl_id= ".$checkit['cl_id']."")){				
		##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_claim_requests','update', "update mun_claim_requests set cl_valid =1 where cl_id= ".$checkit['cl_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###





								header('Location: admin_claims.php');
			}else{
				die('ERRRMAj/we/ifskhuizbJFWFEAO');
			}
		}else{
			die("No Claims\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
##
##
if(isset($_POST['add_instruction'])){
				 if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}



	
	if(isset($_POST['add_ins_topic'])){
		$topic = $_POST['add_ins_topic'];
	}else{
		die('Couldn\'t Find topic');
	}
	
	if(isset($_POST['add_inr_inst'])){
	}else{
		die('Couldn\'t Find topic\'s instructions');
	}
	
	if(isset($_POST['add_inr_inst_ico'])){
	}else{
		die('Couldn\'t Find topic\'s instruction\'s icon');
	}
	
	if(isset($_FILES['add_inr_inst_img'])){
		$topic = $_POST['add_ins_topic'];
	}else{
		die('Couldn\'t Find topic\'s instruction\'s Image');
	}
	
	
	$loopnames = array('add_inr_inst','add_inr_inst_ico','add_inr_inst_img');
	$l1ar = array();
	$l2ar = array();
	$l3ar = array();
	for($i =1;$i <31;$i++){
		if($i == 1){
			$nu = '';
		}else{
			$nu= $i;
		}
		
		if(isset($_POST[$loopnames[0].$nu])){
			$l1ar[] = $nu;
		}else{
		}
	}

	for($h =1;$h <31;$h++){
		if($h == 1){
			$nuo = '';
		}else{
			$nuo= $h;
		}
		
		if(isset($_POST[$loopnames[1].$nuo])){
			$l2ar[] = $nuo;
		}else{
		}
	}

	for($hi =1;$hi <31;$hi++){
		if($hi == 1){
			$no = '';
		}else{
			$no= $hi;
		}
		
		if(isset($_FILES[$loopnames[2].$no])){
			$l3ar[] = $no;
		}else{
		}
	}



if((count($l1ar) == count($l3ar)) and (count($l1ar) == count($l2ar)) and (count($l2ar) == count($l3ar))){
	
}else{
	die('Number of instructions and number of images and number of icons Dont Match');
}


if((count($l1ar) + count($l2ar) + count($l3ar) + 2) ==( count($_POST) + count($_FILES))){
}else{
	die('Post and topic and instructions dont match');
}



$instopic = "INSERT INTO `mun_instrcs_master`(`in_name`) VALUES ('".$_POST['add_ins_topic']."')";
#count all post and match this

if($conn->query($instopic)){
			


	$topic_id = $conn->insert_id;
	##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_instrcs_master','insert', $instopic ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


	$counterimage = array();
	foreach ($l3ar as $indexed=>$l3i){
		if($_FILES['add_inr_inst_img'.$l3i]['name'] == ''){
			$counterimage[$indexed] = NULL;
		}else{
			####UploadingStarts
$target_dir = "img/instruction_images/";
$target_file = $target_dir .md5($_FILES['add_inr_inst_img'.$l3i]["name"].$_FILES['add_inr_inst_img'.$l3i]["tmp_name"].$_FILES['add_inr_inst_img'.$l3i]["size"]).uniqid().'_'.md5(time()).'.'. extension($_FILES['add_inr_inst_img'.$l3i]["name"]);
$uploadOk = 1;
$err_arr = array();
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["add_instruction"])) {
    $check = getimagesize($_FILES['add_inr_inst_img'.$l3i]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $err_arr[] = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $err_arr[] = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES['add_inr_inst_img'.$l3i]["size"] > 1200000) {
    $err_arr[] = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
&& strtolower($imageFileType) != "gif" ) {
    $err_arr[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	foreach($err_arr as $err){
		echo $err.'<br>';
	}
    die("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES['add_inr_inst_img'.$l3i]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES['add_inr_inst_img'.$l3i]["name"]). " has been uploaded.";
		$counterimage[$indexed] = $target_file;
		
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
			
			####Uploading ends
		}
	}
	
			#l1ar
			#l2ar
			#counterimage
			
			
			$instructionmaster = array();
			
			foreach($l1ar as $ol=>$ini){
				$instructionmaster[] = array($_POST['add_inr_inst'.$ini],$_POST['add_inr_inst_ico'.$ini],$counterimage[$ol]);
$sqlo = array();			}
foreach($instructionmaster as $instg){
	if(is_null($instg[2])){
	$sqlo[] = "INSERT INTO `mun_ins_rel`(`inr_rel_in_id`, `inr_text`, `inr_image_src`, `inr_link_icon`) VALUES (
	'".$topic_id."',
		'".$instg[0]."',
			NULL,
				'".$instg[1]."'
	)";
	}else{
			$sqlo[] = "INSERT INTO `mun_ins_rel`(`inr_rel_in_id`, `inr_text`, `inr_image_src`, `inr_link_icon`) VALUES (
	'".$topic_id."',
		'".$instg[0]."',
			'".$instg[2]."',
				'".$instg[1]."'
	)";

	}
	
	
}

$errdu =array();
foreach($sqlo as $sl){
	if($conn->query($sl)){
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['MUNC_USR_DB_ID'],'mun_ins_rel','insert', $sl,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




		
	}else{
		$errdu[] = '1';
	}
}

if(count($errdu) == 0){
	header('Location: admin_instructions.php');
}else{
	die('ERRMAIUHGE)UI)HUIBEF');
}
}
	
}
#__ins AcInac
if(isset($_POST['in_mk_inac_ha'])){
	#hash = egkjtnr newsdnjjenfkvijfkorkvnkorvfk
	if(ctype_alnum(trim($_POST['in_mk_inac_ha']))){
		$checkit = getdatafromsql($conn,"select * from mun_instrcs_master where md5(md5(sha1(sha1(md5(md5(concat(in_id,'egkjtnr newsdnjjenfkvijfkorkvnkorvfk')))))))= '".$_POST['in_mk_inac_ha']."' and in_valid =1");
		
		if(is_array($checkit)){
			if($conn->query("update mun_instrcs_master set in_valid =0 where in_id= ".$checkit['in_id']."")){				
		##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_instrcs_master','update', "update mun_instrcs_master set in_valid =0 where in_id= ".$checkit['in_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###





								header('Location: admin_instructions.php');
			}else{
				die('ERRRMAjjiorefjnrhbejif');
			}
		}else{
			die("No TL Instructions Found");
		}
	}else{
		die('Invalid Entries');
	}

}
#
if(isset($_POST['in_mk_ac_ha'])){
	#jijnfiirjfnirokijfkvnkorvfk
	if(ctype_alnum(trim($_POST['in_mk_ac_ha']))){
		$checkit = getdatafromsql($conn,"select * from mun_instrcs_master where md5(md5(sha1(sha1(md5(md5(concat(in_id,'jijnfiirjfnirokijfkvnkorvfk')))))))= '".$_POST['in_mk_ac_ha']."' and in_valid =0");
		
		if(is_array($checkit)){
			if($conn->query("update mun_instrcs_master set in_valid =1 where in_id= ".$checkit['in_id']."")){				
		##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_instrcs_master','update', "update mun_instrcs_master set in_valid =1 where in_id= ".$checkit['in_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###





								header('Location: admin_instructions.php');
			}else{
				die('ERRRMAjorefjnrhbejif');
			}
		}else{
			die("No TL Instructions Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#__inrs AcInac
if(isset($_POST['inr_mk_inac_ha'])){
	#egkjtnr newsdnjjennjwhuirb3gjwfsn23qw@$%$Tfkvijwsardvnkorvfk
	if(ctype_alnum(trim($_POST['inr_mk_inac_ha']))){
		$checkit = getdatafromsql($conn,"select * from mun_ins_rel 
		where md5(md5(sha1(sha1(md5(md5(concat(inr_id,'egkjtnr newsdnjjennjwhuirb3gjwfsn23qw@$%Tfkvijwsardvnkorvfk')))))))= 
		'".$_POST['inr_mk_inac_ha']."' and inr_valid = 1");
		
		if(is_array($checkit)){
			if($conn->query("update mun_ins_rel set inr_valid =0 where inr_id= ".$checkit['inr_id']."")){				

		##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_ins_rel','update', "update mun_ins_rel set inr_valid =0 where inr_id= ".$checkit['inr_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




								header('Location: admin_instructions.php');
			}else{
				die('ERRRMeusjorefjnrhbejif');
			}
		}else{
			die("No TL rel Instructions Found");
		}
	}else{
		die('Invalid Entries');
	}
}
if(isset($_POST['inr_mk_ac_ha'])){
	#jijnfiirj3woi#esrgujrvoiejs4rijfkvnkorvfk
	if(ctype_alnum(trim($_POST['inr_mk_ac_ha']))){
		$checkit = getdatafromsql($conn,"select * from mun_ins_rel 
		where md5(md5(sha1(sha1(md5(md5(concat(inr_id,'jijnfiirj3woi#esrgujrvoiejs4rijfkvnkorvfk')))))))= 
		'".$_POST['inr_mk_ac_ha']."' and inr_valid = 0");
		
		if(is_array($checkit)){
			if($conn->query("update mun_ins_rel set inr_valid =1 where inr_id= ".$checkit['inr_id']."")){				
		##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['MUNC_USR_DB_ID'],'mun_ins_rel','update', "update mun_ins_rel set inr_valid =1 where inr_id= ".$checkit['inr_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###





								header('Location: admin_instructions.php');
			}else{
				die('ERRRMAwhgieuk5sgrejnrhbejif');
			}
		}else{
			die("No TL rel in Instructions Found");
		}
	}else{
		die('Invalid Entries');
	}
}
##
##
if(isset($_POST['edit_instructions'])){
	var_dump($_POST);
	if(isset($_SESSION['MUNC_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from mun_logins where lum_id = ".$_SESSION['MUNC_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_cl_d'])){
		if(ctype_alnum(trim($_POST['hash_cl_d']))){
			$editinst = getdatafromsql($conn,"select * from mun_instrcs_master where md5(md5(sha1(sha1(md5(md5(concat(in_id,'jhoubih4wiuheuf8rhbu8ifbnn njenjn'))))))) = '".$_POST['hash_cl_d']."'");
			
			
			if(is_string($editinst)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Found');
	}

#########3Loop Hole
if(isset($_POST['edit_ins_topic'])){
		$topic = $_POST['edit_ins_topic'];
	}else{
		die('Couldn\'t Find topic');
	}
	
	if(isset($_POST['edit_inr_inst'])){
	}else{
		die('Couldn\'t Find topic\'s instructions');
	}
	
	if(isset($_POST['edit_inr_inst_ico'])){
	}else{
		die('Couldn\'t Find topic\'s instruction\'s icon');
	}
	
	if(isset($_POST['edit_inr_inst_img'])){
	}else{
		die('Couldn\'t Find topic\'s instruction\'s Image');
	}
	
	
	$loopnames = array('edit_inr_inst','edit_inr_inst_ico','edit_inr_inst_img');
	$l1ar = array();
	$l2ar = array();
	$l3ar = array();
	for($i =1;$i <31;$i++){
		if($i == 1){
			$nu = '';
		}else{
			$nu= $i;
		}
		
		if(isset($_POST[$loopnames[0].$nu])){
			$l1ar[] = $nu;
		}else{
		}
	}

	for($h =1;$h <31;$h++){
		if($h == 1){
			$nuo = '';
		}else{
			$nuo= $h;
		}
		
		if(isset($_POST[$loopnames[1].$nuo])){
			$l2ar[] = $nuo;
		}else{
		}
	}

	for($hi =1;$hi <31;$hi++){
		if($hi == 1){
			$no = '';
		}else{
			$no= $hi;
		}
		
		if(isset($_POST[$loopnames[2].$no])){
			$l3ar[] = $no;
		}else{
		}
	}




if((count($l1ar) == count($l3ar)) and (count($l1ar) == count($l2ar)) and (count($l2ar) == count($l3ar))){
	
}else{
	die('Number of instructions and number of images and number of icons Dont Match');
}

#count all post and match this


if((count($l1ar) + count($l2ar) + count($l3ar) + 3) ==( count($_POST))){
}else{
	die('Post and topic and instructions dont match');
}

$delalll = "UPDATE `mun_ins_rel`
 SET `inr_valid`= 0 WHERE 
`inr_rel_in_id`= ".$editinst['in_id']."
";

if($conn->query($delalll)){
		##### Insert Logs ##################################################################VV3###
		if(preplogs($editinst,$_SESSION['MUNC_USR_DB_ID'],'mun_ins_rel','update', $delalll ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###





}else{
	die('ERRMAIOBRE)GIOOIEJJ)W#JF)I');
}

$instopic = "UPDATE `mun_instrcs_master`
 SET `in_name`= '".$_POST['edit_ins_topic']."' WHERE 
`in_id`= ".$editinst['in_id']."
";
#count all post and match this

if($conn->query($instopic)){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($editinst,$_SESSION['MUNC_USR_DB_ID'],'mun_instrcs_master','update', $instopic ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	$topic_id = $editinst['in_id'];
	
			#l1ar
			#l2ar
			#counterimage
			
			
			$instructionmaster = array();
			
			foreach($l1ar as $ol=>$ini){
				$instructionmaster[] = array($_POST['edit_inr_inst'.$ini],$_POST['edit_inr_inst_ico'.$ini],$_POST['edit_inr_inst_img'.$ini]);
$sqlo = array();			}
foreach($instructionmaster as $instg){
	if(($instg[2]) == 'NULL'){
	$sqlo[] = "INSERT INTO `mun_ins_rel`(`inr_rel_in_id`, `inr_text`, `inr_image_src`, `inr_link_icon`) VALUES (
	'".$topic_id."',
		'".$instg[0]."',
			NULL,
				'".$instg[1]."'
	)";
	}else{
			$sqlo[] = "INSERT INTO `mun_ins_rel`(`inr_rel_in_id`, `inr_text`, `inr_image_src`, `inr_link_icon`) VALUES (
	'".$topic_id."',
		'".$instg[0]."',
			'".$instg[2]."',
				'".$instg[1]."'
	)";

	}
	
	
}

$errdu =array();
foreach($sqlo as $sl){
	if($conn->query($sl)){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($editinst,$_SESSION['MUNC_USR_DB_ID'],'mun_ins_rel','insert', $sl ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




		
	}else{
		$errdu[] = '1';
	}
}

if(count($errdu) == 0){
	header('Location: admin_instructions.php');
}else{
	die('ERRMwsevelksmrvlkE)UI)HUIBEF');
}
}
	
#########3

}
###
###
if(isset($_POST['acrbeo'])){
	
	if(isset($_POST['class'])){
		$class = $_POST['class'];
	}else{
		$class = NULL;
	}

	if(isset($_POST['type'])){
		$type = $_POST['type'];
	}else{
		$type = NULL;
	}

	if(isset($_POST['outer'])){
		$outer = $_POST['outer'];
	}else{
		$outer = NULL;
	}

	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}else{
		$page = NULL;
	}
	
	if(isset($_POST['href'])){
		$href = $_POST['href'];
	}else{
		$href = NULL;
	}
	
	
	
	
	$sql  = "INSERT INTO `pg_click`(`href_type`, `href_linkedto`, `href_page`, `href_dnt`, `href_hash`) VALUES ('".$class."|".$outer."|".$type."','".$href."','".$page."','".time()."','".$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']."')";
	
	if($conn->query($sql)){
		echo 'erngf';
		
	}else{
		die("ERRMAIJNOUEIHG)");
	}
	
}
?>







