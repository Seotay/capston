<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbName = "smart";

$conn = new mysqli($servername, $username, $password, $dbName);
/* DB 연결 확인 */
if (!$conn){
    die('Could not connect: ' . mysqli_error($conn));
}


//mysqli_close($conn);
?>
