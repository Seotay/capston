<?php
      include_once 'dbconfig.php';
      session_start();
       echo "로그인한 사용자의 ID는: " . $_SESSION["id"];
  ?>