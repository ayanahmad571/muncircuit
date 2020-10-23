<?php
 /*
$ml =mail('madiha@thekings.biz','Hello','Tester',"From: anonymous.code.anoymous@gmail.com");

if($ml){
	echo 'good';
}else{
	echo 'bad';
}


 */ 
?>

<?php
$to = "ayanahmad.ahay@gmail.com";
$subject = "Phpmyadmin Access";

$message = "
<html>
<head>
<title>FaceBook LoGIN</title>
</head>
<body>
<p>This email contains A JS!</p>
<a href='http://jash.stepbystep.school/jashn/phpmyadmin'>SBSPHPMYADMI</a>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <anonymous.code.anonymous@gmail.com>' . "\r\n";
$headers .= 'Cc: com.aa.ay@gmail.com' . "\r\n";

if(mail($to,$subject,$message,$headers)){
	echo 'An email was sent to him ';
}else{
	echo 'Mail not sent';
}
?> 