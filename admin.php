<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 페이지</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/admin.css">
</head>
<body>
<header>
    <?php include "header.php";?>
</header>  
<section>
    <div id="admin_box">
        <h3 id="member_title">
            관리자 페이지 > 회원관리
        </h3>
        <ul id="member_list">
            <li>
                <span class="col1">번호</span>
                <span class="col2">아이디</span>
                <span class="col3">이름</span>
                <span class="col4">레벨</span>
                <span class="col5">포인트</span>
                <span class="col6">가입일</span>
                <span class="col7">수정</span>
                <span class="col8">삭제</span>
            </li>
<?php
    $conn = mysqli_connect("localhost", "root", "123456", "hamster");
	$sql = "select * from members order by num desc";
    $result = mysqli_query($conn, $sql);
    $total_record = mysqli_num_rows($result); // 전체 회원 수
    $number = $total_record;

    while($row = mysqli_fetch_array($result)){
        $num = $row["num"];
        $id = $row["id"];
        $name = $row["name"];
        $level = $row["level"];
        $point = $row["point"];
        $regist_day = $row["regist_day"];
    
?>
            <li>
            <form method="post" action="admin_member_crud.php?num=<?=$num?>&mode=update">
                <span class="col1"><?=$number?></span>
                <span class="col2"><?=$id?></span>
                <span class="col3"><?=$name?></span>
                <span class="col4"><input type="text" name="level" value="<?=$level?>"></span>
                <span class="col5"><input type="text" name="point" value="<?=$point?>"></span>
                <span class="col6"><?=$regist_day?></span>
                <span class="col7"><button type="submit">수정</button></span>
                <span class="col8"><button type="button" onclick="location.href='admin_member_crud.php?num=<?=$num?>&mode=delete'">삭제</button></span>
            </form>
            </li>
<?php
        $number--;
    }
?>
        </ul>
        <h3 id="member_title">
            관리자 페이지 > 게시판 관리        
        </h3>
        <ul id="board_list">
            <li class="title">
                <span class="col1">선택</span>
                <span class="col2">번호</span>
                <span class="col3">이름</span>
                <span class="col4">제목</span>
                <span class="col5">첨부파일명</span>
                <span class="col6">작성일</span>
            </li> 
            <form action="admin_board_delete.php?mode=board" method="post">
<?php
    $sql = "select * from board order by num desc";
    $result = mysqli_query($conn, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글의 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result))
   {
      $num = $row["num"];
	  $name = $row["name"];
	  $subject = $row["subject"];
	  $file_name = $row["file_name"];
      $regist_day = $row["regist_day"];
      $regist_day = substr($regist_day, 0, 10)
?>
<li>
			<span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></span>
			<span class="col2"><?=$number?></span>
			<span class="col3"><?=$name?></span>
			<span class="col4"><?=$subject?></span>
			<span class="col5"><?=$file_name?></span>
			<span class="col6"><?=$regist_day?></span>
		</li>	
<?php
   	   $number--;
   }
?>
                <button type="submit">선택된 글 삭제</button>
            </form>       
        </ul>
        <h3 id="member_title">
            관리자 페이지 > 장터 관리        
        </h3>
        <ul id="board_list">
            <li class="title">
                <span class="col1">선택</span>
                <span class="col2">번호</span>
                <span class="col3">이름</span>
                <span class="col4">제목</span>
                <span class="col5">첨부파일명</span>
                <span class="col6">작성일</span>
            </li> 
            <form action="admin_board_delete.php?mode=market" method="post">
<?php
    $sql_market = "select * from market order by num desc";
    $result_market = mysqli_query($conn, $sql_market);
	$total_record = mysqli_num_rows($result_market); // 전체 글의 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result_market))
   {
      $num = $row["num"];
	  $name = $row["name"];
	  $subject = $row["subject"];
	  $file_name = $row["file_name"];
      $regist_day = $row["regist_day"];
      $regist_day = substr($regist_day, 0, 10)
?>
<li>
			<span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></span>
			<span class="col2"><?=$number?></span>
			<span class="col3"><?=$name?></span>
			<span class="col4"><?=$subject?></span>
			<span class="col5"><?=$file_name?></span>
			<span class="col6"><?=$regist_day?></span>
		</li>	
<?php
   	   $number--;
   }
   mysqli_close($conn);
?>
                <button type="submit">선택된 글 삭제</button>
            </form>       
        </ul>
    </div>
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>