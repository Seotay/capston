<?php
include_once 'dbconfig.php';

// 데이터 조회
// $sql = "SELECT DATE_FORMAT(date, '%Y-%m-%d %H:%i') AS date, temperature, illumination, moisture, humidity 
// FROM sensor
// WHERE date >= DATE_ADD(NOW(), INTERVAL -30*10 MINUTE);";

$sql = "SELECT CONCAT(weeks, '주차') AS weeks, ROUND(AVG(leaf_len),2) AS leaf_len, MAX(leaf_num) as leaf_num FROM `sensor`
GROUP BY weeks;";

$result = $conn->query($sql);

// 데이터 가공
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// 시각화 생성
$leaf_len = array();
$leaf_num = array();

foreach ($data as $row) {
    $weeks[] = $row['weeks'];
    $leaf_len[] = $row['leaf_len'];
    $leaf_num[] = $row['leaf_num'];
}
?>