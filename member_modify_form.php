<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/signin.css">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="./js/modify.js"></script>
    <title>정보 수정</title>
  </head>
  <body>
    <header>
      <?php include "header.php" ?>
    </header>
    <?php
      $conn = mysqli_connect("localhost", "root", "123456", "hamster");
      $sql = "select * from members where id='$userId'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);

      $pass = $row['pass'];
      $name = $row['name'];
      $nick = $row['nick'];
      $email = $row['email'];
      $tel = $row['tel'];
      $phone = $row['phone'];
      $birth_day = $row['birth_day'];
      $post = $row["post"];
      $address = $row["address"];
      $detail_address = $row["detail_address"];
      $extra_address = $row["extra_address"];

      mysqli_close($conn);
    ?>

    <section>
      <div id="center_align">
        <div id="h2_align">
          <h2>회원 정보 수정</h2>
        </div>
        <form name="form_modify" action="./member_modify.php?id=<?=$userId?>" method="post">
          <div class="">
            <table>
              <tr>
                <th>아이디</th>
                <td>
                  <span> <?= $userId?></span>
                </td>
              </tr>
              <tr>
                <th>비밀번호</th>
                <td>
                  <p>영문자, 숫자, 특수문자를 포함하여 6-12자를 입력하세요</p>
                  <input type="password" name="pass" class="essential_form" id="pwInput" value="<?= $pass?>" onkeyup="pwCheck()"><span class="span_warning" id="pwCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>비밀번호 확인</th>
                <td>
                  <input type="password" class="essential_form" id="pw2Input" value="<?= $pass?>" onkeyup="pwCheck2()"><span class="span_warning" id="pwCorrect2"></span>
                </td>
              </tr>
            </table>
          </div>
          <div class="">
            <table>
              <tr>
                <th>이름</th>
                <td>
                  <input type="text" name="name" class="essential_form" id="nameInput" value="<?=$name?>" onkeyup="nameCheck()"><span class="span_warning" id="nameCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>닉네임</th>
                <td>
                  <p>공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)<br>
                    닉네임을 바꾸시면 앞으로 1일 이내에는 변경할 수 없습니다.
                  </p>
                  <input type="text" name="nick" class="essential_form" id="nickInput" value="<?=$nick?>" onkeyup="nickCheck()"><span class="span_warning" id="nickCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>E-mail</th>
                <td>
                  <input type="email" name="email" class="essential_form" id="emailInput" size="70" value="<?=$email?>" onkeyup="emailCheck()"><span class="span_warning" id="emailCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>전화번호</th>
                <td>
                  <input type="tel" name="tel" class="essential_form" id="telInput" value="<?=$tel?>" onkeyup="telCheck()"><span class="span_warning" id="telCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>휴대폰번호</th>
                <td>
                  <input type="tel" name="phone" class="essential_form" id="phoneInput" value="<?=$phone?>" onkeyup="phoneCheck()"><span class="span_warning" id="phoneCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>생년월일</th>
                <td>
                  <input type="date" name="birth_day" value="<?=$birth_day?>">
                </td>
              </tr>
              <tr>
                <th>주소</th>
                <td>
                  <div id="address_total">
                    <div class="address_search">
                      <input name="post" class="essential_form" type="text" id="inputPost" value="<?=$post?>" placeholder=" 주소검색버튼을 눌러주세요" onkeyup="postCheck()">
                      <button type="button" id="btn_address" onclick="execDaumPostcode()">주소 검색</button><span class="span_warning" id="postCorrect"></span>
                    </div>
                    <input name="address" class="essential_form" type="text" id="inputAddress" value="<?=$address?>" size="70" onkeyup="addressCheck()">
                    <span>기본주소</span><span class="span_warning" id=addressCorrect></span><br>
                    <input type="text" id="detailAddress" name="detail_address" value="<?=$detail_address?>" size="70">
                    <span>상세주소</span><br>
                    <input type="text" id="extraAddress" name="extra_address" value="<?=$extra_address?>" size="70">
                    <span>참고항목</span><br>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div id="btn_submit">
            <input type="button" id="btn_signin" value="정보수정" onclick="signinDone(event)">
            <button type="button" id="btn_cancel" onclick="location.href = 'index.php'">취소</button>
          </div>
        </form>
      </div>
    </section>
    <footer>
      <?php include "footer.php" ?>
    </footer>
  </body>
</html>
