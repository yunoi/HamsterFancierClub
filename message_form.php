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
        <a href="#"><img id="img_title" src="./img/ham_message.png" alt="햄스터애호가클럽 메시지폼 이미지"></a>
      </div>
      <!-- id get방식 말고 input hidden으로 보내기!! -->
      <div id="message_box">
        <h3 id="write_title">쪽지 보내기</h3>
        <ul class="top_buttons">
          <li><a href="message_box.php?mode=receive">수신 쪽지함</a></li>
          <li><a href="message_box.php?mode=send">송신 쪽지함</a></li>
        </ul>
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
                <span class="col2"><input type="text" name="rv_id" value=""></span>
              </li>
              <li>
                <span class="col1">제목: </span>
                <span class="col2"><input type="text" name="subject" value=""></span>
              </li>
              <li id="text_area">
                <span class="col1">내용: </span>
                <span class="col2"><textarea name="content"></textarea></span>
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
