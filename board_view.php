<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>자유게시판 - 내용보기</title>
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
                    <h1>BOARD</h1>
                </div>
            </div>
            <div id="board_box">
                <h3 class="title">게시판 > 내용보기</h3>
                <?php
  $num = $_GET['num'];
  $page = $_GET['page'];

  $conn = mysqli_connect("localhost", "root", "123456", "hamster");
  $sql = "select * from board where num=$num";
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
  $sql = "update board set hit=$new_hit where num=$num";
  mysqli_query($conn, $sql);
  ?>

                <ul id="view_content">
                    <li>
                        <span class='col1'>
                            <b>제목:
                            </b><?=$subject?></span>
                        <span class='col2'><?=$name?>
                            |
                            <?=$regist_day?></span>
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
                <ul id="board_buttons" class="buttons">
                <?php
  if($userId === $id){
    echo("
      <li><button onclick=\"location.href='board_list.php?page=$page'\">목록</button></li>
      <li><button id='btn_modify' onclick=\"location.href='board_form.php?page=$page&num=$num&mode=update'\">수정</button></li>
      <li><button id='btn_delete' onclick=\"location.href='board_crud.php?page=$page&num=$num&mode=delete'\">삭제</button></li>
      <li><button onclick=\"location.href='board_form.php'\">글쓰기</button></li>
    ");
  } else {
    echo("
      <li><button onclick=\"location.href='board_list.php?page=$page'\">목록</button></li>
      <li><button onclick=\"location.href='board_form.php'\">글쓰기</button></li>
    ");
  }
?>

                </ul>
                <!-- 댓글 -->
                <div id="ripple">
                    <div id="ripple1">댓글</div>
                    <div id="ripple2">
                        <?php 
  $sql="select * from board_ripple where parent=$num";
  $result_ripple = mysqli_query($conn, $sql);

  while($row_ripple=mysqli_fetch_array($result_ripple)){
    $ripple_num=$row_ripple['num'];
    $ripple_id=$row_ripple['id'];
    $ripple_date=$row_ripple['regist_day'];
    $ripple_content=$row_ripple['content'];
    $ripple_content=str_replace("\n", "<br>",$ripple_content);
    $ripple_content=str_replace(" ", "&nbsp;",$ripple_content);

?>
                        <div id="ripple_title">
                            <ul>
                                <li><?=$userName."&nbsp;&nbsp;".$ripple_date?></li>
                                <li id="mdi_del">
                                    <?php 
  if($_SESSION['userId']=="admin"||$_SESSION['userId']==$ripple_id){
    echo ("<form style='display:inline' action='board_crud.php?mode=delete_ripple&page=$page' method='post'>
    <input type='hidden' name='num' value=$ripple_num>
    <input type='hidden' name='parent' value=$num>
    <input type='submit' value='삭제'>
    </form>");
  }
  ?>
                                </li>
                            </ul>
                        </div>
                        <div id="ripple_content">
                            <?=$ripple_content?>
                        </div>
                        <?php 
  } // end of while
  mysqli_close($conn);
?>
                        <form
                            name="ripple_form"
                            action="board_crud.php?num=<?=$num?>&page=<?=$page?>&mode=insert_ripple"
                            method="post">
                            <input type="hidden" name="parent" value="<?=$num?>">
                            <input type="hidden" name="hit" value="<?=$hit?>">
                            <input type="hidden" name="page" value="<?=$page?>">
                            <div id="ripple_insert">
                                <div id="ripple_textarea">
                                    <textarea name="ripple_content" rows="3" cols="80"></textarea>
                                </div>
                                <div id="ripple_button">
                                    <input type="submit" value="댓글달기"></div>
                            </div>
                            <!--end of ripple_insert -->
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <?php include "footer.php";?>
        </footer>
    </body>
</html>