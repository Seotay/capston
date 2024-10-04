<?php
include_once 'dbconfig.php';

// 데이터 조회
// $sql = "SELECT DATE_FORMAT(date, '%Y-%m-%d %H:%i') AS date, temperature, illumination, moisture, humidity 
// FROM sensor
// WHERE date >= DATE_ADD(NOW(), INTERVAL -30*10 MINUTE);";


$sql = "SELECT DATE_FORMAT(date, '%m-%d %H:%i') AS date, temp, humidity, moisture, illumination
FROM sensor
ORDER BY serial_no DESC
LIMIT 5;";

$result = $conn->query($sql);

// 데이터 가공
$data = array();
    while ($row = $result->fetch_assoc()) {
$data[] = $row;
}

// 시각화 생성
$date = array();
$temp = array();
$ill = array();
foreach ($data as $row) {
    $date[] = $row['date'];
    $temp[] = $row['temp'];
    $ill[] = $row['illumination'];
    $mois[] = $row['moisture'];
    $humi[] = $row['humidity'];
}
?>