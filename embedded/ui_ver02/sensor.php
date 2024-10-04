<?php
include_once 'dbconfig.php';

// 데이터 조회
//$sql = "SELECT DATE_FORMAT(date, '%Y-%m-%d %H:%i') AS date, temperature, illumination, moisture, humidity 
//FROM sensor
//WHERE date >= DATE_ADD(NOW(), INTERVAL -20 MINUTE);";

$sql = "SELECT serial_no, DATE_FORMAT(date, '%Y-%m-%d %H:%i') AS date, temperature, humidity, moisture, illumination
 FROM sensor02
 ORDER BY date DESC
 LIMIT 1;";

$result = $conn->query($sql);


?>