<?php

if(isset($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']) and trim($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']) != ''){
	if(ins_pgview($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'],basename($_SERVER['PHP_SELF']),$conn)){
	}else{
		die('#ERRHOM1');
	}
}else{
	
	#newhash
	session_regenerate_id();
	$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'] = give_uniqid();
	session_write_close();
	if(ins_msview($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'],$conn)){
	}else{
		die('#ERRHOM3');
	}
	#hash pgname 
if(ins_pgview($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'],basename($_SERVER['PHP_SELF']),$conn)){
	}else{
		die('#ERRHOM4');
	}

}


if(isset($_SESSION['MUNCIRCUIT_SESS_ID'])){
$login=1;
$_USER = array();
$_USER = make_user_ar($conn,$_SESSION['MUNC_USR_DB_ID'],$login);
	

}else{
	$login=0;
}



?>