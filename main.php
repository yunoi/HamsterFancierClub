<div class="slideshow">
  <div id="main_img_bar">
    <a href="#"><img src="./img/ham_main1.png" alt="햄스터애호가클럽 메인 이미지1"></a>
    <a href="#"><img src="./img/ham_main2.png" alt="햄스터애호가클럽 메인 이미지2"></a>
    <a href="#"><img src="./img/ham_main3.jpg" alt="햄스터애호가클럽 메인 이미지3"></a>
    <a href="#"><img src="./img/ham_main4.png" alt="햄스터애호가클럽 메인 이미지4"></a>
  </div>
  <div id="slideshow_nav">
    <a href="#" class="prev">prev</a>
    <a href="#" class="next">next</a>
  </div>
  <div id="slideshow_indi">
    <a href="#">&nbsp;&nbsp;</a>
    <a href="#">&nbsp;&nbsp;</a>
    <a href="#">&nbsp;&nbsp;</a>
    <a href="#">&nbsp;&nbsp;</a>
  </div>
</div>
<div id="main_content">
  <div id="latest">
    <h4>최근 게시글</h4>
    <ul>
<!-- 최근 게시글 DB 불러오기 -->
<?php
  $conn = mysqli_connect("localhost", "root", "123456", "hamster");
  $sql = "select * from board order by num desc limit 5";
  $result = mysqli_query($conn, $sql);

  if(!$result){
    echo "게시판 DB 테이블이 생성 전이거나 아직 게시글이 없습니다.";
  } else {
    while($row = mysqli_fetch_array($result)){
      $regist_day = substr($row["regist_day"], 0, 10);
?>
      <li>
        <span><?= $row["subject"]?></span>
        <span><?= $row["name"]?></span>
        <span><?= $regist_day?></span>
      </li>
<?php
    }
  }
?>

    </ul>
  </div>
  <div id="point_rank">
    <h4>포인트 랭킹</h4>
      <ul>
<?php
  $rank = 1;
  $sql = "select * from members order by point desc limit 5";
  $result = mysqli_query($conn, $sql);

  if(!$result){
    echo " 회원 DB 테이블이 생성 전이거나 아직 가입된 회원이 없습니다.";
  } else {
    while($row = mysqli_fetch_array($result)){
      $name = $row["name"];
      $id = $row["id"];
      $point = $row["point"];
      $name = mb_substr($name, 0, 1)."*".mb_substr($name, 2, 1);
?>
        <li>
          <span><?= $rank?></span>
          <span><?= $name?></span>
          <span><?= $id?></span>
          <span><?= $point?></span>
        </li>
<?php
      $rank++;
    }
  }
  mysqli_close($conn);
?>
      </ul>
  </div>
</div>
