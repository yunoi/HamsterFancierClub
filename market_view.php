<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>장터 - 내용보기</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/board.css">
    <link rel="shortcut icon" href="./favicon.ico">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script src="./js/board.js"></script>
  </head>
  <body>
    <header>
        <?php include "header.php";?>
    </header>
    <section>
      <div id="board_img_bar">
        <div class="board_img">
          <img id="img_title" src="./img/top_temp_img.jfif">
        </div>
        <div class="board_text">
          <h1>MARKET</h1>
        </div>
      </div>
      <div id="board_box">
        <h3 class="title">장터 > 내용보기</h3>
<?php
  $num = $_GET['num'];
  $page = $_GET['page'];

  $conn = mysqli_connect("localhost", "root", "123456", "hamster");
  $sql = "select * from market where num=$num";
  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_array($result);

  $id      = $row["id"];
  $name      = $row["name"];
  $regist_day = $row["regist_day"];
  $subject    = $row["subject"];
  $content    = $row["content"];
  $file_name    = $row["file_name"];
  $file_type    = $row["file_type"];
  $file_copied  = $row["file_copied"];
  $hit          = $row["hit"];

  $content = str_replace(" ", "&nbsp;", $content);
  $content = str_replace("\n", "<br>", $content);

  $new_hit = $hit + 1;
  $sql = "update market set hit=$new_hit where num=$num";
  mysqli_query($conn, $sql);
  ?>

        <ul id="view_content">
          <li>
            <span class='col1'><b>제목: </b><?=$subject?></span>
            <span class='col2'><?=$name?> | <?=$regist_day?></span>
          </li>
          <li>
<?php
  if($file_name){
    $real_name = $file_copied;
    $file_path = "./data/".$real_name;
    $file_size = filesize($file_path);

    echo ("
      ▷ 첨부파일: $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
      <a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>
    ");
  }

  if(strpos($file_type, "image") !== false) {
    echo ("
      <img src='./data/$file_copied' width='500'><br>
      <p>$content</p>
      ");
  } else {
    echo ("
      <p>$content</p>
      ");
  }
?>
          </li>
        </ul>
        <ul class="buttons">
<?php
  if($userId === $id){
    echo("
      <li><button onclick=\"location.href='market_list.php?page=$page'\">목록</button></li>
      <li><button id='btn_modify' onclick=\"location.href='market_form.php?page=$page&num=$num&mode=update'\">수정</button></li>
      <li><button id='btn_delete' onclick=\"location.href='market_crud.php?page=$page&num=$num&mode=delete'\">삭제</button></li>
      <li><button onclick=\"location.href='market_form.php'\">글쓰기</button></li>
      <li><button onclick=\"location.href='market_form.php?num=$num&mode=response'\">댓글달기</button></li>
    ");
  } else {
    echo("
      <li><button onclick=\"location.href='market_list.php?page=$page'\">목록</button></li>
      <li><button onclick=\"location.href='market_form.php'\">글쓰기</button></li>
      <li><button onclick=\"location.href='market_form.php?num=$num&mode=response'\">댓글달기</button></li>
    ");
  }
?>
        </ul>
      </div>
    </section>
    <footer>
        <?php include "footer.php";?>
    </footer>
  </body>
</html>
