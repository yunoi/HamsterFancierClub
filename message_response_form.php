<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>메시지</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/message.css">
    <link rel="shortcut icon" href="./favicon.ico">
    <script src="./js/message.js"></script>
  </head>
  <body>
    <header>
        <?php include "header.php";?>
    </header>
    <section>
      <div id="message_img_bar">
        <a href="#"><img id="img_title" src="./img/ham_message.png" alt="햄스터애호가클럽 메시지폼 이미지"></a>
      </div>
      <div id="message_box">
        <h3 id="write_title">답변 쪽지 보내기</h3>
<?php
  $num = $_GET['num'];

  $conn = mysqli_connect("localhost", "root", "123456", "hamster");
  $sql = "select * from message where num=$num";
  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_array($result);
  $send_id = $row['send_id'];
  $rv_id = $row['rv_id'];
  $subject = $row['subject'];
  $content = $row['content'];

  $subject = "RE: ".$subject;
  $content = "> ".$content;
  $content = str_replace("\n", "\n>", $content );
  $content = "\n\n\n-----------------------------------------------\n".$content;

  $result2 = mysqli_query($conn, "select name from members where id='$send_id'");
  $record = mysqli_fetch_array($result2);
  $send_name = $record['name'];
?>
        <form name="message_form" action="message_insert.php" method="post">
          <div id="write_msg">
            <ul>
              <li>
                <span class="col1">보내는 사람: </span>
                <span class="col2"><?=$userId?></span>
                <input type="hidden" name="send_id" value="<?=$userId?>">
              </li>
              <li>
                <span class="col1">수신 아이디: </span>
                <span class="col2"><?=$send_name?>(<?=$send_id?>)</span>
                <input type="hidden" name="rv_id" value="<?=$send_id?>">
              </li>
              <li>
                <span class="col1">제목: </span>
                <span class="col2"><input type="text" name="subject" value="<?=$subject?>"></span>
              <li id="text_area">
                <span class="col1">글 내용 : </span>
                <span class="col2">
                  <textarea name="content"><?=$content?></textarea>
                </span>
              </li>
            </ul>
            <button type="button" onclick="check_message()">보내기</button>
          </div>
        </form>
      </div>
    </section>
    <footer>
        <?php include "footer.php";?>
    </footer>
  </body>
</html>
