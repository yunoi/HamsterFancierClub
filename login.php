<?php
  session_start();

  $id = $_POST["id"];
  $pass = $_POST["pass"];

  $conn = mysqli_connect("localhost", "root", "123456", "hamster");
  $sql = "select * from members where id='$id'";
  $result = mysqli_query($conn, $sql);

  $count = mysqli_num_rows($result);

  if(!$count){
    echo("
      <script>
        alert('등록되지 않은 아이디입니다!');
        history.go(-1);
      </script>
    ");
  } else {
    $row = mysqli_fetch_array($result);
    $db_pass = $row["pass"];

    mysqli_close($conn);

    if($pass != $db_pass){
      echo("
        <script>
          alert('비밀번호가 틀립니다.');
          history.go(-1);
        </script>
      ");
      exit;
    } else {
      $_SESSION["userId"] = $row["id"];
      $_SESSION["userName"] = $row["name"];
      $_SESSION["userLevel"] = $row["level"];
      $_SESSION["userPoint"] = $row["point"];

      echo("
        <script>
          location.href = 'index.php';
        </script>
      ");
    }
  }
?>
