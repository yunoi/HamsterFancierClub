function check_text() {
  if (document.board_form.subject.value === "") {
    document.board_form.subject.focus();
    alert('제목을 입력해 주세요.');
    return;
  }
  if (document.board_form.content.value === "") {
    document.board_form.content.focus();
    alert('내용을 입력해 주세요.');
    return;
  }
  document.board_form.submit();
}
// $(document).ready(function() {
//   var fileTarget = $('#input_upload');
//       fileTarget.on('change', function() { 
        // 값이 변경되면 if(window.FileReader) { // modern browser var filename = $(this)[0].files[0].name; } else { // old IE var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출 } // 추출한 파일명 삽입 $(this).siblings('.upload-name').val(filename); }); });
