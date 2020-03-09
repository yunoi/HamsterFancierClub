<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>자유게시판 - 글쓰기</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/board.css">
    <link rel="shortcut icon" href="./favicon.ico">
    <script src="./js/board.js"></script>
  </head>
  <body>
    <header>
        <?php include "header.php";?>
    </header>
    <?php
      if(!$userId){
        echo("
        <script>
          alert('로그인 후 이용해 주세요!');
          history.go(-1);
        </script>
        ");
      }
      if(isset($_GET["page"])){
        $page = $_GET["page"];
    } else {
      $page = 1;

    }
      if(isset($_GET['mode'])){
        $mode = $_GET['mode'];
      } else {
        $mode = "insert";
      }
      if(isset($_GET['num'])){
        $num = $_GET['num'];

        $mode = "update";

        $conn = mysqli_connect("localhost", "root", "123456", "hamster");
        $sql = "select * from board where num=$num";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $name = $row["name"];
        $subject = $row["subject"];
        $content = $row["content"];
        $file_name = $row["file_name"];
      } else {
        $name = $userName;
        $subject = "";
        $content = "";
        $file_name = "";
      }
    ?>
    <section>
      <div id="board_img_bar">
        <div class="board_img">
          <img id="img_title" src="./img/top_temp_img.jfif">
        </div>
        <div class="board_text">
          <h1>BOARD</h1>
        </div>
      </div>
      <div id="board_box">
<?php
  if($mode === "insert"){
    echo ("<h3 id='board_title'>게시판 > 글쓰기</h3>
      <form name='board_form' action='board_crud.php?mode=$mode' method='post' enctype='multipart/form-data'>
    ");

  } else {
    echo ("<h3 id='board_title'>게시판 > 글수정</h3>
      <form name='board_form' action='board_crud.php?mode=$mode&num=$num&page=$page' method='post' enctype='multipart/form-data'>
    ");
  }
?>
          <ul id="board_form">
            <li>
              <span class='col1'>이름: </span>
              <span class='col2'><?=$name?></span>
            </li>
            <li>
              <span class='col1'>제목: </span>
              <span class='col2'><input type="text" name="subject" value="<?=$subject?>"></span>
            </li>
            <li>
              <span class='col1'>내용: </span>
              <span class='col2'><textarea name="content"><?=$content?></textarea></span>
            </li>
            <li>
              <div class="file_box">
                <span class='col1'>첨부파일: </span>
                <span class='col2'>
                  <input type="file" id="input_upload" name="upload_file">
                  <input class="upload_name" value="<?=$file_name?>" placeholder="파일 선택" disabled="disabled">
                </span>
                <label for="input_upload">업로드</label>
              </div>

            </li>
          </ul>
          <ul class="buttons">
            <li><button type="button" name="button" onclick="check_text()">완료</button></li>
            <li><button type="button" name="button" onclick="location.href='board_list.php'">목록</button></li>
          </ul>
        </form>
      </div>
    </section>
    <footer>
        <?php include "footer.php";?>
    </footer>
  </body>
</html>
