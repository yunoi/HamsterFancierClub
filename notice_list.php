<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>공지사항</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/board.css">
    <link rel="shortcut icon" href="./favicon.ico">
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
          <h1>NOTICE</h1>
        </div>
      </div>
      <div id="board_box">
        <h3>공지사항 > 목록보기</h3>
        <ul id="board_list">
          <li>
            <span class="col1">번호</span>
            <span class="col2">제목</span>
            <span class="col3">글쓴이</span>
            <span class="col4">첨부</span>
            <span class="col5">등록일</span>
            <span class="col6">조회</span>
          </li>
<?php

    define('SCALE', 10);

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $conn = mysqli_connect("localhost", "root", "123456", "hamster");
  $sql = "select * from notice order by num desc";
  $result = mysqli_query($conn, $sql);
  $total_record = mysqli_num_rows($result);
  if(!$total_record){
      echo("
        <li id='li_empty'>게시글이 없습니다</li>
      ");
  } 
  if($total_record % SCALE == 0){
    $total_page = floor($total_record / SCALE);
  } else {
    $total_page = floor($total_record / SCALE) + 1;
  }

  $page_set_number = ($page - 1) * SCALE;
  $number = $total_record - $page_set_number;

  for($i=$page_set_number; $i < $page_set_number + SCALE && $i < $total_record; $i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);

    $num = $row['num'];
    $id = $row['id'];
    $name = $row['name'];
    $subject = $row['subject'];
    $regist_day = $row['regist_day'];
    $hit = $row['hit'];
    if($row['file_name']){
      $file_image = "<img src='./img/file.gif'>";
    } else {
      $file_image = " ";
    }

    echo ("
    <li>
      <span class='col1'>$number</span>
      <span class='col2'><a href='notice_view.php?num=$num&page=$page'>$subject</a></span>
      <span class='col3'>$name</span>
      <span class='col4'>$file_image</span>
      <span class='col5'>$regist_day</span>
      <span class='col6'>$hit</span>
    </li>
    ");

    $number--;
  }

  mysqli_close($conn);
?>
        </ul>
        <ul id="page_num">
<?php
  if($total_page>= 2 && $page >= 2){
    $new_page = $page - 1;
    echo ("<li><a href='notice_list.php?page=$new_page'>◀ 이전</a> </li>");
  } else {
    echo ("<li>&nbsp;</li>");
  }

  for($i = 1; $i <= $total_page; $i++){
    if($page == $i){
      echo ("<li><b> $i </b></li>");
    } else {
      echo ("<li><a href='notice_list.php?page=$i'> $i </a></li>");
    }
  }

  if($total_page >= 2 && $page != $total_page){
    $new_page = $page + 1;
    echo ("<li> <a href='notice_list.php?page=$new_page'>다음 ▶</a> </li>");
  } else {
    echo ("<li>&nbsp;</li>");
  }
?>
        </ul>
        <ul class='buttons'>
          <li>
            <button onclick="location.href='notice_list.php'">목록</button>
          </li>
<?php
  if($userLevel == 1){
    echo ("<li><button onclick=\"location.href='notice_form.php'\">글쓰기</button></li>");
  } else {
    echo ("<li><a href=\"javascript:alert('관리자만 작성할 수 있는 게시판입니다.')\"><button>글쓰기</button></li>");
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
