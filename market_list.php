<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>장터</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/board.css">
    <link rel="shortcut icon" href="./favicon.ico">
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
      } else if($userLevel > 8) {
        echo("
        <script>
          alert('장터는 레벨 8 이상 이용 가능합니다.');
          history.go(-1);
        </script>
        "); 
      }
?>   
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
        <h3>장터 > 목록보기</h3>
        <form name="board_form" action="market_list.php?mode=search" method="post">
           <div id="list_search">
             <div id="list_search1">
               <select  name="find">
                 <option value="subject">제목</option>
                 <option value="content">내용</option>
                 <option value="id">아이디</option>
               </select>
             </div><!--end of list_search1  -->
             <div id="list_search2"><input type="text" name="search"></div>
             <div id="list_search3"> <input type="submit" value="검색"></div>
           </div><!--end of list_search  -->
         </form>
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
  if(isset($_GET['mode'])&&$_GET['mode'] == "search"){
    // 제목, 내용, 아이디 검색
    $find = $_POST['find'];
    $search = $_POST['search'];
    $sql = "select * from market where $find like '%$search%' order by num desc";
  } else { 
    $sql = "select * from market order by group_num desc, ord asc";
  }
  
  $result = mysqli_query($conn, $sql);
  $total_record = mysqli_num_rows($result);
  $total_page=($total_record % SCALE == 0 )?
  ($total_record/SCALE):(ceil($total_record/SCALE));

  $truncate_number = ($page - 1) * SCALE;
  $start_number = $total_record - $truncate_number;

  for($i=$truncate_number; $i < $truncate_number + SCALE && $i < $total_record; $i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);

    $num = $row['num'];
    $id = $row['id'];
    $name = $row['name'];
    $subject = $row['subject'];
    $regist_day = $row['regist_day'];
    $hit = $row['hit'];
    $depth=(int)$row['depth'];
    $space="";
    if($row['file_name']){
      $file_image = "<img src='./img/file.gif'>";
    } else {
      $file_image = " ";
    }
    for($j = 0; $j < $depth; $j++){
        $space="&nbsp;&nbsp;".$space;
    }

    echo ("
    <li>
      <span class='col1'>$start_number</span>
      <span class='col2'><a href='market_view.php?num=$num&page=$page'>$space$subject</a></span>
      <span class='col3'>$name</span>
      <span class='col4'>$file_image</span>
      <span class='col5'>$regist_day</span>
      <span class='col6'>$hit</span>
    </li>
    ");

    $start_number--;
  }

  mysqli_close($conn);
?>
        </ul>
        <ul id="page_num">
<?php
  if($total_page>= 2 && $page >= 2){
    $new_page = $page - 1;
    echo ("<li><a href='market_list.php?page=$new_page'>◀ 이전</a> </li>");
  } else {
    echo ("<li>&nbsp;</li>");
  }

  for($i = 1; $i <= $total_page; $i++){
    if($page == $i){
      echo ("<li><b> $i </b></li>");
    } else {
      echo ("<li><a href='market_list.php?page=$i'> $i </a></li>");
    }
  }

  if($total_page >= 2 && $page != $total_page){
    $new_page = $page + 1;
    echo ("<li> <a href='market_list.php?page=$new_page'>다음 ▶</a> </li>");
  } else {
    echo ("<li>&nbsp;</li>");
  }
?>
        </ul>
        <ul class='buttons'>
          <li>
            <button onclick="location.href='market_list.php'">목록</button>
          </li>
<?php
  if($userId){
    echo ("<li><button onclick=\"location.href='market_form.php'\">글쓰기</button></li>");
  } else {
    echo ("<li><a href=\"javascript:alert('로그인 후 이용해 주세요!')\"><button>글쓰기</button></li>");
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
