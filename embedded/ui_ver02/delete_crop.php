<?php
include_once 'dbconfig.php';

session_start(); // 세션 시작
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crop_num = $_POST['crop_num'];  // 폼에서 전달받은 crop_id 값
    
    // 작물 데이터 삭제 쿼리
    $sql = "DELETE FROM crop WHERE crop_num = ? AND user_id = ?";
    
    // SQL문 준비
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $crop_num, $user_id); // 's'는 user_id의 문자열 값

    // 쿼리 실행
    if ($stmt->execute()) {
        echo "<script>alert('작물 삭제 완료'); window.location.href = 'user_info.php';</script>";
    } else {
        echo "<script>alert('작물 삭제 실패: " . $conn->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
