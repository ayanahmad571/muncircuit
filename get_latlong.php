<?php
$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
var_dump($ip);
if(($ip=='::1') or (strpos($ip,'192.168') === true)){
	$ip="122.177.159.179";
}
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
    var_dump($location);
}else{
	die('Please Reload');
}
##
$dist = 23.3;
##
?>

<h1>Showing muns within <?php echo $dist.'KM'
?>
</h1>
<?php
 /*
http://maps.googleapis.com/maps/api/geocode/json?address=Step+by+step+school
http://maps.googleapis.com/maps/api/geocode/json?latlng=28.5734417,77.3215453&sensor=false
SELECT *, 
    ( 6371 * acos( cos( radians(28.6667) ) 
                   * cos( radians( `mun_lat` ) ) 
                   * cos( radians( `mun_long` ) 
                       - radians(77.2167) ) 
                   + sin( radians(28.6667) ) 
                   * sin( radians( `mun_lat` ) ) 
                 )
   ) AS distance 
FROM mun_rec 
HAVING distance < 25
ORDER BY distance LIMIT 0 , 20
 */ 
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muncircuit";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 } 

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
HAVING distance < ".$dist."
ORDER BY distance LIMIT 0 , 20";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        var_dump($row);
    }
} else {
    echo "0 results";
}
?>