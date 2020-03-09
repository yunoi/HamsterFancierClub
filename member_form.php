<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/signin.css">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="./js/signin.js"></script>
    <title>회원가입</title>
  </head>
  <body onload="populateform()">
    <header>
      <?php include "header.php" ?>
    </header>
    <section>
      <div id="center_align">
        <div id="h2_align">
          <h2>회 원 가 입</h2>
        </div>
        <form name="form_signin" action="./member_insert.php" method="post">
          <h4>사이트 이용정보 입력</h4>
          <div class="">
            <table>
              <tr>
                <th>아이디</th>
                <td>
                  <p>영문자, 숫자,_만 입력 가능. 최소3자이상 입력하세요</p>
                  <input type="text" name="id" class="essential_form" id="idInput" value=""><span class="span_warning" id="idCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>비밀번호</th>
                <td>
                  <p>영문자, 숫자, 특수문자를 포함하여 6-12자를 입력하세요</p>
                  <input type="password" name="pass" class="essential_form" id="pwInput" value="" onkeyup="pwCheck()"><span class="span_warning" id="pwCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>비밀번호 확인</th>
                <td>
                  <input type="password" class="essential_form" id="pw2Input" value="" onkeyup="pwCheck2()"><span class="span_warning" id="pwCorrect2"></span>
                </td>
              </tr>
            </table>
          </div>
          <h4>개인정보 입력</h4>
          <div class="">
            <table>
              <tr>
                <th>이름</th>
                <td>
                  <input type="text" name="name" class="essential_form" id="nameInput" value="" onkeyup="nameCheck()"><span class="span_warning" id="nameCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>닉네임</th>
                <td>
                  <p>공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)<br>
                    닉네임을 바꾸시면 앞으로 1일 이내에는 변경할 수 없습니다.
                  </p>
                  <input type="text" name="nick" class="essential_form" id="nickInput" value="" onkeyup="nickCheck()"><span class="span_warning" id="nickCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>E-mail</th>
                <td>
                  <input type="email" name="email" class="essential_form" id="emailInput" size="70" value="" onkeyup="emailCheck()"><span class="span_warning" id="emailCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>가입경로</th>
                <td>
                  <div id="rdo_enter">
                    <input type="radio" name="enterReason" value=""><span>인터넷검색</span>
                    <input type="radio" name="enterReason" value=""><span>배너광고</span>
                    <input type="radio" name="enterReason" value=""><span>관련기사를보고</span>
                    <input type="radio" name="enterReason" value=""><span>주변사람소개</span>
                    <input type="radio" name="enterReason" value=""><span>기타</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th>전화번호</th>
                <td>
                  <input type="tel" name="tel" class="essential_form" id="telInput" value="" onkeyup="telCheck()"><span class="span_warning" id="telCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>휴대폰번호</th>
                <td>
                  <input type="tel" name="phone" class="essential_form" id="phoneInput" value="" onkeyup="phoneCheck()"><span class="span_warning" id="phoneCorrect"></span>
                </td>
              </tr>
              <tr>
                <th>생년월일</th>
                <td>
                  <input type="date" name="birth_day" value="">
                </td>
              </tr>
              <tr>
                <th>주소</th>
                <td>
                  <div id="address_total">
                    <div class="address_search">
                      <input name="post" class="essential_form" type="text" id="inputPost" value="" placeholder=" 주소검색버튼을 눌러주세요" onkeyup="postCheck()">
                      <button type="button" id="btn_address" onclick="execDaumPostcode()">주소 검색</button><span class="span_warning" id="postCorrect"></span>
                    </div>
                    <input name="address" class="essential_form" type="text" id="inputAddress" value="" size="70" onkeyup="addressCheck()">
                    <span>기본주소</span><span class="span_warning" id=addressCorrect></span><br>
                    <input type="text" id="detailAddress" name="detail_address" value="" size="70">
                    <span>상세주소</span><br>
                    <input type="text" id="extraAddress" name="extra_address" value="" size="70">
                    <span>참고항목</span><br>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <h4>기타 개인설정</h4>
          <div id="etc_settings">
            <table>
              <tr>
                <th>카카오톡 메세지</th>
                <td>
                  <input type="checkbox" name="" value="" checked="true"><span class="etc_span">카카오톡 메세지를 받겠습니다.</span>
                  <span id=kakao_msg>> 수신체크를 하시면 세일 소식을 가장 먼저 받아보실 수 있습니다.</span>
                </td>
              </tr>
              <tr>
                <th>메일링서비스</th>
                <td>
                  <input type="checkbox" name="" value="" checked="true"><span class="etc_span">정보 메일을 받겠습니다.</span>
                </td>
              </tr>
              <tr>
                <th>SMS 수신여부</th>
                <td>
                  <input type="checkbox" name="" value="" checked="true"><span class="etc_span">휴대폰 문자메세지를 받겠습니다.</span>
                </td>
              </tr>
              <tr>
                <th>정보공개</th>
                <td>
                  <p>정보공개를 바꾸시면 앞으로 0일 이내에는 변경이 안됩니다.</p>
                  <input type="checkbox" name="" value="" checked="true"><span class="etc_span">다른분들이 나의 정보를 볼 수 있도록 합니다.</span>
                </td>
              </tr>
              <tr>
                <th>자동등록방지</th>
                <td>
                  <div id="not_robot_form">
                    <canvas id="canvas_robot" width="110" height="45"></canvas>
                    <input type="button" class="btn_code" value="코드 생성" onClick="populateform()">
                    <input class="essential_form" type="text" size=18 id="inputCode">
                    <input type="button" class="btn_code" value="비교" onClick="charCheck()"><span class="span_warning" id="codeCorrect"></span>
                    <p>자동등록방지 문자와 숫자를 순서대로 입력해 주세요</p>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div id="btn_submit">
            <input type="button" id="btn_signin" value="회원가입" onclick="signinDone(event)">
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
