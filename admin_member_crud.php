<?php
    session_start();
    if(isset($_SESSION['userLevel'])){
        $userLevel = $_SESSION['userLevel'];
    } else {
        $userLevel = "";
    }

    if($userLevel != 1){
        echo("
            <script>
            alert('관리자 권한이 없습니다.');
            history.go(-1)
            </script>
        ");
    }

    $num = $_GET['num'];
    $mode = $_GET['mode'];
    $level = $_POST['level'];
    $point = $_POST['point'];
    $conn = mysqli_connect("localhost", "root", "123456", "hamster");

    switch($mode){
        case 'update':
            userUpdate($conn, $level, $point, $num);
            header("Location:admin.php");
            break;
        case 'delete':
            userDelete($conn, $num);
            header("Location:admin.php");
        break;
        default: echo("
            <script>
                alert('DB ERROR');
                history.go(-1);
            </script>
                ");
    }

    function userUpdate($conn, $level, $point, $num){
        $sql = "update members set level=$level, point=$point where num=$num";
        mysqli_query($conn, $sql);
        echo("
            <script>
                alert('회원정보가 수정되었습니다.');
             </script>
        ");
    }

    function userDelete($conn, $num){
        $sql = "delete from members where num=$num";
        mysqli_query($conn, $sql);

    }
    mysqli_close($conn);

?>