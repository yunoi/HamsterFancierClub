function login() {
  var $idInput = document.getElementById("idInput");
  var $pwInput = document.getElementById("pwInput");
  if ($idInput.value === "") {
    alert("아이디를 입력해 주세요");
    $idInput.focus();
    return;
  }
  if ($pwInput.value === "") {
    alert("비밀번호를 입력해 주세요.");
    $pwInput.focus();
    return;
  } 
  document.form_login.submit();
}

function enterKey() {
  if (window.event.keyCode === 13) {
    login();
  }
}
