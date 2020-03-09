<?php
  $id = $_POST["id"];

    $conn = mysqli_connect("localhost", "root", "123456", "hamster");
    $sql = "select * from members where id='$id'";
    $result = mysqli_query($conn, $sql);

    $num_recode = mysqli_num_rows($result);
    if($num_recode){
      echo "1";
    } else {
      echo "0";
    }
    mysqli_close($conn);
  
?>
