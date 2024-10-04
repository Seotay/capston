<?php
include_once 'dbconfig.php';


    $fan_value = $_GET['fan'];
    $water_value = $_GET['water'];
    $led_value = $_GET['led'];
    $camera_value = $_GET['camera'];

    if (isset($_GET['fan']) or isset($_GET['water']) or isset($_GET['led']) or isset($_GET['camera'])) {    
        // 엑추에이터 현재 상태를 0으로 초기화
        $current_date = date('Y-m-d H:i:s');
        $fan_status = 0;
        $water_status = 0; 
        $led_status = 0;
        $camera_status = 0;
}

// led 값이 On이면 act 테이블에 log기록
if ($fan_value == 'On'){
        $fan_status = 1;
        $sql = "INSERT INTO act (date, fan, water, led, camera) VALUES ('$current_date', '$fan_status', '$water_status', '$led_status', '$camera_status')";
        if ($conn->query($sql) === TRUE) 
        {
            echo 'Success: fan On';
        } 
        else { // Off이면 기록x
            echo "fan Off";
            }
        }
 else {
    echo "fan 상태가 전송되지 않았습니다. <br>";
}

if ($water_value == 'On'){
    $water_status = 1;
    $sql = "INSERT INTO act (date, fan, water, led, camera) VALUES ('$current_date', '$fan_status', '$water_status', '$led_status', '$camera_status')";
    if ($conn->query($sql) === TRUE) 
    {
        echo 'Success: water On';
    } 
    else { // Off이면 기록x
        echo "water Off";
        }
    }
else {
    echo "water 상태가 전송되지 않았습니다. <br>";
}

if ($led_value == 'On'){
    $led_status = 1;
    $sql = "INSERT INTO act (date, fan, water, led, camera) VALUES ('$current_date', '$fan_status', '$water_status', '$led_status', '$camera_status')";
    if ($conn->query($sql) === TRUE) 
    {
        echo 'Success: led On';
    } 
    else { // Off이면 기록x
        echo "led Off";
        }
    }
else {
echo "LED 상태가 전송되지 않았습니다.<br>";
}

if ($camera_value == 'On'){
    $camera_status = 1;
    $sql = "INSERT INTO act (date, fan, water, led, camera) VALUES ('$current_date', '$fan_status', '$water_status', '$led_status', '$camera_status')";
    if ($conn->query($sql) === TRUE) 
    {
        echo 'Success: Camera On';
    } 
    else { // Off이면 기록x
        echo "camera Off";
        }
    }
else {
echo "camera 상태가 전송되지 않았습니다. <br>";
}


$conn->close();
// index.php로 리다이렉트
header("Location: index.php");
exit();
?>