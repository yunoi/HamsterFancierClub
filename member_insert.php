<?php
  date_default_timezone_set('Asia/Seoul');

  $id = $_POST["id"];
  $pass = $_POST["pass"];
  $name = $_POST["name"];
  $nick = $_POST["nick"];
  $email = $_POST["email"];
  $tel = $_POST["tel"];
  $phone = $_POST["phone"];
  $birth_day = $_POST["birth_day"];
  $post = $_POST["post"];
  $address = $_POST["address"];
  $detail_address = $_POST["detail_address"];
  $extra_address = $_POST["extra_address"];
  $regist_day = date("Y-m-d (H:i)");

  $conn = mysqli_connect("localhost", "root", "123456", "hamster");

  $sql = "insert into members values(null, '$id', '$pass', '$name', '$nick',".
  " '$email', '$tel', '$phone', '$birth_day', '$post', '$address', '$detail_address', '$extra_address', '$regist_day', 9, 0)";

  mysqli_query($conn, $sql);
  mysqli_close($conn);

  echo"<script>location.href = 'index.php';</script>";
?>
