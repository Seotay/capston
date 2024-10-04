<?php
include_once 'dbconfig.php';
session_start(); // 세션 시작

if ($_SERVER["REQUEST_METHOD"] == "GET") { // GET으로 변경

    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id']; // 로그인한 사용자의 ID
        echo "<script>alert('$user_id')</script>";
    } else {
        echo "사용자가 로그인하지 않았습니다.";
        exit();
    }

    // GET 요청으로 전달된 값 가져오기
    $fan_value = $_GET['fan'];
    $water_value = $_GET['water'];
    $led_value = $_GET['led'];
    $camera_value = $_GET['camera'];
    
    if (isset($fan_value) || isset($water_value) || isset($led_value) || isset($camera_value)) {    
        // 엑추에이터 현재 상태를 0으로 초기화
        $current_date = date('Y-m-d H:i:s');
        $fan_status = 0;
        $water_status = 0;
        $led_status = 0;
        $camera_status = 0;

        // fan 값이 On이면 act 테이블에 log기록
        if ($fan_value == 'On') {
            $fan_status = 1;
        }

        // water 값이 pumpOn이면 act 테이블에 log기록
        if ($water_value == 'pupmpOn') {
            $water_status = 1;
        }

        // led 값이 On이면 act 테이블에 log기록
        if ($led_value == 'ledOn') {
            $led_status = 1;
        }

        // camera 값이 On이면 act 테이블에 log기록
        if ($camera_value == 'On') {
            $camera_status = 1;
            
        }

        // 모든 값들을 act 테이블에 기록
        $sql = "INSERT INTO act (date, userid, fan, water, led, camera) 
                VALUES ('$current_date', '$user_id', '$fan_status', '$water_status', '$led_status', '$camera_status')";

        if ($conn->query($sql) === TRUE) {
            echo 'Success: 상태가 성공적으로 기록되었습니다.';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        if ($camera_status == 1) {
            header("Location: camera.php");
        }else{
            // index.php로 리다이렉트
            header("Location: index.php");
            exit();
        }  
    } else {
        echo "상태 값이 전송되지 않았습니다.";
    }
}

$conn->close();
?>
