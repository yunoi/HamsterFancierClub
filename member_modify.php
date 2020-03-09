<?php
  session_start();

  $id = $_GET['id'];

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

  $conn = mysqli_connect("localhost", "root", "123456", "hamster");

  $sql = "update members set pass='$pass', name='$name', nick='$nick',".
  " email='$email', tel='$tel', phone='$phone', birth_day='$birth_day', post='$post',".
  " address='$address', detail_address='$detail_address', extra_address='$extra_address' where id='$id'";

  mysqli_query($conn, $sql);

  $sql = "select name from members where id='$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  mysqli_close($conn);

  $_SESSION["userName"] = $row["name"];

  echo"<script>location.href = 'index.php';</script>";
?>
