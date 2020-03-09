<?php
  session_start();
  if(isset($_SESSION["userId"])){
    $userId = $_SESSION["userId"];
  } else {
    $userId = "";
  }
  if(isset($_SESSION["userName"])){
    $userName = $_SESSION["userName"];
  } else {
    $userName = "";
  }
  if(isset($_SESSION["userLevel"])){
    $userLevel = $_SESSION["userLevel"];
  } else {
    $userLevel = "";
  }
  if(isset($_SESSION["userPoint"])){
    $userPoint = $_SESSION["userPoint"];
  } else {
    $userPoint = "";
  }
?>
  <div id="top">
      <a href="index.php"><img src="./img/ham_main_icon.png" alt="햄스터 메인 아이콘"><h3>햄스터 애호가 클럽</h3></a>
    <ul id="top_menu">
<?php
  if(!$userId) {
?>
      <li><a href="member_form.php">회원가입</a></li>
      <li> | </li>
      <li><a href="login_form.php">로그인</a></li>
<?php
  } else {
    $logged = $userName."(".$userId.")";
    $logged_etc = "님 [Level: ".$userLevel.", Point: ".$userPoint."]";
?>
      <li><span><?=$logged?></span><span><?=$logged_etc?></span></li>
      <!-- onclick="window.open('message_box.php?mode=receive','메시지함', 'width=200,height=600,scrollbars=no,resizable=yes')" -->
      <li> | </li>
      <li><a href="logout.php">로그아웃</a></li>
      <li> | </li>
      <li><a href="member_modify_form.php">정보수정</a></li>
<?php
  }
?>
<?php
    if($userLevel==1) {
?>
                <li> | </li>
                <li><a href="admin.php">관리자페이지</a></li>
<?php
    }
?>
    </ul>
  </div>
  <div id="menu_bar">
    <ul>
      <li id="li_first"><a href="index.php">HOME</a></li>
      <li><a href="notice_list.php">NOTICE</a></li>
      <li><a href="message_box.php?mode=receive">MESSAGE</a></li>
      <li><a href="board_list.php?mode=free">BOARD</a></li>
      <li><a href="market_list.php">MARKET</a></li>
    </ul>
  </div>
