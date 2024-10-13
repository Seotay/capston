<?php
include_once 'dbconfig.php';

// 오늘 날짜 기준으로 시간별 평균 온도, 습도, 수분, 조도 데이터를 조회
$sql = "SELECT 
        DATE_FORMAT(date, '%Y-%m-%d %H:00') AS hour, 
        ROUND(AVG(temperature), 2) AS avg_temperature, 
        ROUND(AVG(humidity), 2) AS avg_humidity, 
        ROUND(AVG(moisture), 2) AS avg_moisture, 
        ROUND(AVG(illumination), 2) AS avg_illumination
        FROM sensor02
        WHERE DATE(date) = '2024-03-06'  -- 특정 날짜로 필터링
        GROUP BY hour
        ORDER BY hour 
        LIMIT 24;";


$result = $conn->query($sql);

$conn -> close();
?>
