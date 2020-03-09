<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>로그인</title>
    <link rel="shortcut icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/master.css">
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="./js/login.js"></script>
  </head>
  <body>
    <header>
      <?php include "header.php" ?>
    </header>
    <section>
        <div id="top_img_bar">
          <img id="img_title" src="./img/ham_login.png" alt="햄스터애호가클럽 로그인 이미지">
        </div>
      <div id="main">
      <h1>로그인</h1><br>
      <div id="align_center">
        <div id="align_input">
          <form name="form_login" action="login.php" method="post">
            <div id="login_form_btn">
              <div id="input_forms">
                <input type="text" id="idInput" name="id" placeholder="아이디" value="" size="25"><br>
                <input type="password" id="pwInput" name="pass" placeholder="비밀번호" value="" size="25" onkeypress="enterKey()">
              </div>
              <div id="btn_login">
                <input id="btnLogin" type="button" value="로그인" onclick="login()">
              </div>
            </div>
            <div id="check_otp">
              <div id="ckb_div">
                <input type="checkbox" name="" value="">아이디저장

              </div>

            </div>
            </script>
    <!-- 네이버 -->
    <div id="naver_id_login"></div>
    <script type="text/javascript">
      var naver_id_login = new naver_id_login("r_Loln5ySkJ_67Fmpf6O", "http://localhost/hamster_fancier_club/naver_callback.html");
      var state = naver_id_login.getUniqState();
      naver_id_login.setButton("white", 2.5,58.5);
      naver_id_login.setDomain("http://localhost/health/index.php");
      naver_id_login.setState(state);
      naver_id_login.setPopup();
      naver_id_login.init_naver_id_login();
    </script>
            <div id="btn_align">
              <input type="button" name="" value="아이디 찾기">
              <input type="button" name="" value="비밀번호 찾기">
            </div>
          </form>
        </div>
      </div>
    </div>
    </section>
    <footer>
      <?php include "footer.php" ?>
    </footer>
  </body>
</html>
