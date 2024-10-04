<?php
include_once 'dbconfig.php';

// 데이터 조회
//$sql = "SELECT DATE_FORMAT(date, '%Y-%m-%d %H:%i') AS date, temperature, illumination, moisture, humidity 
//FROM sensor
//WHERE date >= DATE_ADD(NOW(), INTERVAL -20 MINUTE);";

$sql = "SELECT serial_no, DATE_FORMAT(date, '%Y-%m-%d %H:%i') AS date, temp, humidity, moisture, illumination
 FROM sensor
 ORDER BY serial_no;";

$result = $conn->query($sql);


$conn -> close();
?>