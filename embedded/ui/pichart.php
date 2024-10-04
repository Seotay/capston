<?php
include_once 'dbconfig.php';

$sql = "SELECT DATE(date) AS date,
SUM(fan) AS sum_fan,
SUM(water) AS sum_water,
SUM(led) AS sum_led,
SUM(camera) AS sum_camera
FROM act
WHERE DATE(date) = CURDATE()
GROUP BY DATE(date);";

$result = $conn->query($sql);

// 데이터 가공
$data = array();
    while ($row = $result->fetch_assoc()) {
$data[] = $row;
}

// 시각화 생성
$current_date = array(); // $current_date 초기화
$sum_fan = array();
$sum_water = array();
$sum_led = array();
$sum_camera = array();
foreach ($data as $row) {
    $current_date[] = $row['date'];
    $sum_fan[] = $row['sum_fan'];
    $sum_water[] = $row['sum_water'];
    $sum_led[] = $row['sum_led'];
    $sum_camera[] = $row['sum_camera'];
}
?>