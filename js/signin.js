var keyList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
var temp = "";
var idCheck = false;

function pwCheck() {
  var $pwInput = document.getElementById("pwInput");
  var $pwCorrect = document.getElementById("pwCorrect");
  var pwExp = /^.*(?=^.{6,12}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;
  if ($pwInput.value === "") {
    $pwCorrect.innerHTML = "비밀번호는 빈 칸일 수 없습니다.";
    return false;
  } else if (!$pwInput.value.match(pwExp)) {
    $pwCorrect.innerHTML = " 비밀번호 조건에 맞지 않습니다..";
    return false;
  } else {
    $pwCorrect.innerHTML = "<span style='color:green'> OK</span>";
    return true;

  }
}

function pwCheck2() {
  var $pwInput = document.getElementById("pwInput");
  var $pwInput2 = document.getElementById("pw2Input");
  var $pwCorrect2 = document.getElementById("pwCorrect2");
  if ($pwInput.value === $pwInput2.value) {
    $pwCorrect2.innerHTML = "<span style='color:green'> OK</span>";
    return true;
  } else {
    $pwCorrect2.innerHTML = " 비밀번호가 일치하지 않습니다.";
    return false;

  }
}

function nameCheck() {
  var $nameInput = document.getElementById("nameInput");
  var $nameCorrect = document.getElementById("nameCorrect");
  var nameExp = /^[가-힣]{2,12}$/; //한글만 입력
  if (!$nameInput.value.match(nameExp)) {
    $nameCorrect.innerHTML = " 한글로 2자 이상 입력해 주세요.";
    return false;
  } else if ($nameInput.value === "") {
    $nameCorrect.innerHTML = "이름은 빈 칸일 수 없습니다.";
    return false;

  } else {
    $nameCorrect.innerHTML = "<span style='color:green'> OK</span>";
    return true;
  }
}

function nickCheck() {
  var $nickInput = document.getElementById("nickInput");
  var $nickCorrect = document.getElementById("nickCorrect");
  var nickExp = /^[가-힣0-9\x20]{2,12}|[a-zA-Z0-9\x20]{4,12}$/;

  if (!$nickInput.value.match(nickExp)) {
    $nickCorrect.innerHTML = " 조건에 맞지 않는 닉네임입니다.";
    return false;
  } else if ($nickInput.value === "") {
    $nickCorrect.innerHTML = "닉네임은 빈 칸일 수 없습니다.";
    return false;

  } else {
    $nickCorrect.innerHTML = "<span style='color:green'> OK</span>";
    return true;
  }
}

function emailCheck() {
  var $emailInput = document.getElementById("emailInput");
  var $emailCorrect = document.getElementById("emailCorrect");
  var emailExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
  if (!$emailInput.value.match(emailExp)) {
    $emailCorrect.innerHTML = " 올바른 메일형식이 아닙니다.";
    return false;

  } else if ($emailInput.value === "") {
    $emailCorrect.innerHTML = "E-mail은 빈 칸일 수 없습니다.";
    return false;
  } else {
    $emailCorrect.innerHTML = "<span style='color:green'> OK</span>";
    return true;

  }
}

function telCheck() {
  var $telInput = document.getElementById("telInput");
  var $telCorrect = document.getElementById("telCorrect");
  var telExp = /^[0-9]{9,11}$/;
  if (!$telInput.value.match(telExp)) {
    $telCorrect.innerHTML = " 숫자만 입력해 주세요.";
    return false;

  } else if ($telInput.value === "") {
    $telCorrect.innerHTML = "전화번호는 빈 칸일 수 없습니다.";
    return false;
  } else {
    $telCorrect.innerHTML = "<span style='color:green'> OK</span>";
    return true;
  }
}

function phoneCheck() {
  var $phoneInput = document.getElementById("phoneInput");
  var $phoneCorrect = document.getElementById("phoneCorrect");
  var phoneExp = /^[0-9]{10,11}$/;
  if (!$phoneInput.value.match(phoneExp)) {
    $phoneCorrect.innerHTML = " 숫자만 입력해 주세요.";
    return false;

  } else if ($phoneInput.value === "") {
    $phoneCorrect.innerHTML = "휴대폰번호는 빈 칸일 수 없습니다.";
    return false;
  } else {
    $phoneCorrect.innerHTML = "<span style='color:green'> OK</span>";
    return true;
  }
}

function postCheck() {
  var $inputPost = document.getElementById("inputPost");
  var $postCorrect = document.getElementById("postCorrect");
  postExp = /^\d{5}$/u;
  if (!$inputPost.value.match(postExp)) {
    $postCorrect.innerHTML = " 우편번호 형식에 맞지 않습니다.";
    return false;

  } else if ($inputPost.value === "") {
    $postCorrect.innerHTML = "우편번호는 빈 칸일 수 없습니다.";
    return false;
  } else {
    $postCorrect.innerHTML = "<span style='color:green'> OK</span>";
    return true;
  }
}

function addressCheck() {
  var $inputAddress = document.getElementById("inputAddress");
  var $addressCorrect = document.getElementById("addressCorrect");
  if ($inputAddress.value === "") {
    $addressCorrect.innerHTML = " 기본주소는 빈 칸일 수 없습니다.";
    return false;
  } else {
    $addressCorrect.innerHTML = "<span style='color:green'> OK</span>";
    return true;
  }
}

function makeCode(plength) {
  temp = "";
  for (i = 0; i < plength; i++)
    temp += keyList.charAt(Math.floor(Math.random() * keyList.length));
  return temp;
}

function populateform() {
  var canvasRobot = document.getElementById("canvas_robot");
  var canvasContext = canvasRobot.getContext("2d");
  canvasContext.clearRect(0, 0, canvasRobot.width, canvasRobot.height);
  canvasContext.font = "italic 18px Georgia";
  canvasContext.fillText(makeCode(8), 8, 30);
}

function charCheck() {
  var $codeCorrect = document.getElementById("codeCorrect");
  var $inputCode = document.getElementById("inputCode");
  if (temp === $inputCode.value) {
    $codeCorrect.innerHTML = "<span style='color:green'> OK</span>";
    return true;
  } else if ($codeCorrect.value === "") {
    $codeCorrect.innerHTML = "자동등록방지문자를 입력해 주세요.";
  } else {
    $codeCorrect.innerHTML = "문자가 일치하지 않습니다. 다시 입력해 주세요.";
    return false;
  }
}

function signinDone(event) {

  if (idCheck && nameCheck() && phoneCheck() && emailCheck() && pwCheck() && pwCheck2() &&
    telCheck() && postCheck() && addressCheck() && charCheck()) {
    alert("가입되었습니다.");
    document.form_signin.submit();
  } else {
    alert("가입할 수 없습니다. 양식을 다시 확인해 주세요.");
    event.preventDefault();
  }
}

//우편번호API
function execDaumPostcode() {
  new daum.Postcode({
    oncomplete: function(data) {
      // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

      // 각 주소의 노출 규칙에 따라 주소를 조합한다.
      // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
      var addr = ''; // 주소 변수
      var extraAddr = ''; // 참고항목 변수

      //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
      if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
        addr = data.roadAddress;
      } else { // 사용자가 지번 주소를 선택했을 경우(J)
        addr = data.jibunAddress;
      }

      // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
      if (data.userSelectedType === 'R') {
        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
        if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
          extraAddr += data.bname;
        }
        // 건물명이 있고, 공동주택일 경우 추가한다.
        if (data.buildingName !== '' && data.apartment === 'Y') {
          extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
        }
        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
        if (extraAddr !== '') {
          extraAddr = ' (' + extraAddr + ')';
        }
        // 조합된 참고항목을 해당 필드에 넣는다.
        document.getElementById("extraAddress").value = extraAddr;

      } else {
        document.getElementById("extraAddress").value = '';
      }

      // 우편번호와 주소 정보를 해당 필드에 넣는다.
      document.getElementById('inputPost').value = data.zonecode;
      document.getElementById("inputAddress").value = addr;
      // 커서를 상세주소 필드로 이동한다.
      document.getElementById("detailAddress").focus();
    }
  }).open();
}

//아이디 중복 검사
//모든 자료가 로드되면 자동으로 작동하는 함수
$(document).ready(function(){
  var idInput = $('#idInput'),
      idCorrect = $("#idCorrect");
  idInput.keyup(function(){
    var idValue = idInput.val();
    var idExp = /^[0-9a-zA-Z_]{3,11}$/;
    if (idValue === "") {
      idCorrect.text("아이디는 빈 칸일 수 없습니다.");
      idCheck = false;
    } else if (!idExp.test(idValue)) {
      idCorrect.text("아이디 조건에 맞지 않습니다.");
      idCheck = false;
    } else {
      //ajax 처리부분입니다.
      $.ajax({
        url: 'member_check_id.php',
        type: 'POST',
        data: {id: idValue},
        success: function(data){
          console.log(data);
          if(data === '1'){
            idCorrect.text("중복된 아이디입니다.");
            idCheck = false;
          } else if (data === '0'){
            idCorrect.html("<span style='color:green'>사용하실 수 있는 아이디입니다.</span>");
            idCheck = true;
          } else {
            idCorrect.text("비정상적인 값입니다. 다시 입력해 주세요.");
            idCheck = false;
          }
        }
      });
    }// end of if
  });
});
