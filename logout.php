<?php
  session_start();
  unset($_SESSION["userId"]);
  unset($_SESSION["userName"]);
  unset($_SESSION["userLevel"]);
  unset($_SESSION["userPoint"]);

  echo("
  <script>
    alert('로그아웃 하셨습니다.');
    location.href = 'index.php';
  </script>
  ");
?>
