<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>메시지함</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/message.css">
    <link rel="shortcut icon" href="./favicon.ico">
    <script src="./js/message.js"></script>
  </head>
  <body>
    <header>
        <?php include "header.php";?>
    </header>
    <?php
      if(!$userId){
        echo ("<script>
          alert('로그인 후 이용해 주세요!');
          history.go(-1);
          </script>
        ");
      }
    ?>
    <section>
      <div id="message_img_bar">
        <div class="message_img">
          <img id="img_title" src="./img/ham_message.png" alt="햄스터애호가클럽 메시지메뉴 이미지">
        </div>
        <div class="message_text">
          <h1>MESSAGE</h1>
        </div>
      </div>
      <div id="message_box">
        <h3>
<?php
  if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
  } else {
    $page = 1;
  }

  $mode = $_GET['mode'];

  if($mode == "send"){
    echo "송신 쪽지함 > 목록보기";
  } else {
    echo "수신 쪽지함 > 목록보기";
  }
?>
        </h3>
         <div>
           <ul id="message">
             <li>
               <span class="col1">번호</span>
               <span class="col2">제목</span>
               <span class="col3">
<?php
                if($mode=="send"){
                  echo "받은 이";
                } else {
                  echo "보낸 이";
                }
?>
               </span>
               <span class="col4">등록일</span>
             </li>
<?php
  $conn = mysqli_connect("localhost", "root", "123456", "hamster");

  if($mode == "send"){
    $sql = "select * from message where send_id='$userId' order by num desc";
  } else {
    $sql = "select * from message where rv_id='$userId' order by num desc";
  }

  $result = mysqli_query($conn, $sql);
  $total_record = mysqli_num_rows($result);

  $scale = 10;

  // 전체 페이지 수 계산
  if($total_record % $scale == 0){
    $total_page = floor($total_record / $scale);
  } else {
    $total_page = floor($total_record / $scale) + 1;
  }

  $start = ($page - 1) * $scale; // 표시할 페이지에 따라 시작 위치 계산
  $number = $total_record - $start; // 원하는 페이지의 첫번째 위치

  for($i = $start; $i < $start+$scale && $i <$total_record; $i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
    $num = $row['num'];
    $subject = $row['subject'];
    $regist_day = $row['regist_day'];

    if($mode=='send'){
      $msg_id = $row['rv_id'];
    } else {
      $msg_id = $row['send_id'];
    }

    $result2 = mysqli_query($conn, "select name from members where id='$msg_id'");
    $record = mysqli_fetch_array($result2);
    $msg_name = $record['name'];
?>
              <li>
                <span class="col1"><?=$number?></span>
                <span class="col2"><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></span>
                <span class="col3"><?=$msg_name?>(<?=$msg_id?>)</span>
                <span class="col4"><?=$regist_day?></span>
              </li>
<?php
      $number--;
    } // end of for
    mysqli_close($conn);
?>
           </ul>
           <ul id="page_num">
<?php
  if($total_page>=2 && $page >=2){
    $new_page = $page-1;
    echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a></li>";
  } else {
    echo "<li>&nbsp;</li>";
  }

  // 게시판 목록 하단 페이지 링크 번호
  for($i = 1; $i<=$total_page; $i++){
    if($page == $i){
      echo "<li><b> $i </b></li>";
    } else {
      echo "<li><a href='message_box.php?mode=$mode&page=$i'> $i </a></li>";
    }
  } // end of for
  if($total_page>=2 && $page != $total_page){
    $new_page = $page + 1;
    echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
  } else {
    echo "<li>&nbsp;</li>";
  }
?>
           </ul>
           <ul class="buttons">
             <li>
               <button onclick="location.href='message_box.php?mode=receive'">수신 쪽지함</button>
             </li>
             <li>
               <button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button>
             </li>
             <li>
               <button onclick="location.href='message_form.php'">쪽지 보내기</button>
             </li>
           </ul>
         </div>
      </div>
      </section>
      <footer>
          <?php include "footer.php";?>
      </footer>
  </body>
</html>
