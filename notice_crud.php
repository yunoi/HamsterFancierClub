<?php
  session_start();

  define('POINT_UP', 100);

  $conn = mysqli_connect("localhost", "root", "123456", "hamster");
  $mode = $_GET['mode'];

  if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];
  } else {
    $userId = "";
  }
  if(isset($_SESSION['userName'])){
    $userName = $_SESSION['userName'];
  } else {
    $userName = "";
  }
  if(isset($_SESSION['userLevel'])){
    $userLevel = $_SESSION['userLevel'];
  } else {
    $userLevel = "";
  }

  if(!$userId){
    echo("
      <script>
        alert('게시판 글쓰기는 로그인 후 사용 가능합니다.');
        history.go(-1);
      </script>
    ");
  } else if($userLevel != 1){
    echo("
      <script>
        alert('공지사항 글쓰기는 관리자만 사용 가능합니다.');
        history.go(-1);
      </script>
    ");
  }

  $num = $_GET['num'];
  $page = $_GET['page'];

  $subject = $_POST["subject"];
  $content = $_POST["content"];

  $subject = htmlspecialchars($subject, ENT_QUOTES);
  $content = htmlspecialchars($content, ENT_QUOTES);

  $upfile_name = $_FILES['upload_file']['name'];
  $upfile_tmp_name = $_FILES['upload_file']['tmp_name'];
  $upfile_type = $_FILES['upload_file']['type'];
  $upfile_size = $_FILES['upload_file']['size'];
  $upfile_error = $_FILES['upload_file']['error'];

  switch ($mode) {
    case 'insert':
      noticeInsert($conn, $userId, $userName, $subject, $content, $upfile_name, $upfile_tmp_name, $upfile_type, $upfile_size, $upfile_error);
      echo ("
        <script>
          location.href = 'notice_list.php';
        </script>
      ");
      break;
    case 'update':
      noticeUpdate ($conn, $num, $subject, $content);
      echo "
          <script>
            alert('게시물이 수정되었습니다.');
            location.href = 'notice_list.php?page=$page';
          </script>
      ";
      break;
    case 'delete':
      noticeDelete($conn, $num, $page);
      echo "
         <script>
            alert('게시물이 삭제되었습니다.');
            location.href = 'notice_list.php?page=$page';
         </script>
       ";
      break;
    default:
      echo "
       <script>
          alert('error');
       </script>
     ";
      break;
  }

  function noticeInsert($conn, $userId, $userName, $subject, $content, $upfile_name, $upfile_tmp_name, $upfile_type, $upfile_size, $upfile_error){
    $regist_day = date("Y-m-d (H:i)");

    $upload_dir = './data/';

    if($upfile_name && !$upfile_error){
      $file = explode(".", $upfile_name);
      $file_name = $file[0];
      $file_ext = $file[1];

      $new_file_name = date("Y_m_d_H_i_s");
      $new_file_name = $new_file_name."_".$file_name;
      $copied_file_name = $new_file_name.".".$file_ext;
      $uploaded_file = $upload_dir.$copied_file_name;

      if($upfile_size > 10000000){
        echo("
          <script>
            alert('파일 크기가 지정된 용량(10MB)을 초과합니다! <br>파일 크기를 체크해 주세요.');
            history.go(-1);
          </script>
        ");
      }

      if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
        echo ("
          <script>
            alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
            history.go(-1);
          </script>
        ");
      }
    } else {
      $upfile_name = "";
      $upfile_type = "";
      $copied_file_name = "";
    }

    $sql = "insert into notice values(null, '$userId', '$userName', '$subject', '$content', '$regist_day', 0, ".
    "'$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($conn, $sql);

    $sql = "select point from members where id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $point = $row['point'];
    $new_point = $point + POINT_UP;

    $sql = "update members set point=$new_point where id='$userId'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
  }
  function noticeUpdate ($conn, $num, $subject, $content){
    $sql = "update notice set subject='$subject', content='$content' where num=$num";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
  }

  function noticeDelete($conn, $num, $page){
    $sql = "select * from notice where num=$num";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row['file_copied'];

    if($copied_name){
      $file_path = './data/'.$copied_name;
      unlink($file_path);
    }

    $sql = "delete from notice where num=$num";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
  }
?>
