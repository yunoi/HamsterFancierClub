<?php
    session_start();

    $mode = $_GET["mode"];

    if(isset($_SESSION["userLevel"])){
        $userLevel = $_SESSION["userLevel"];
    } else {
        $userLevel="";
    }

    if($userLevel != 1){
        echo("
        <script>
        alert('관리자 권한이 없습니다.');
        history.go(-1);
    </script> 
        ");
    }

    if(isset($_POST['item'])){
        $num_item = count($_POST['item']);
    } else {
        echo("
                    <script>
                    alert('삭제할 게시글을 선택해주세요!');
                    history.go(-1)
                    </script>
        ");
    }

    $conn = mysqli_connect("localhost", "root", "123456", "hamster");

    switch($mode){
        case 'board':
            textDelete($conn, $num_item, $mode);
        break;
        case 'market' :
            $sql_select = "select * from market where num = $num";
            $sql_delete = "delete from market where num = $num";
            textDelete($conn, $num_item, $mode);
        break;
        default: 
    }
    
    function textDelete($conn, $num_item, $mode){
        for($i=0; $i<$num_item; $i++){
            $num = $_POST['item'][$i];
            $sql_select = "select * from $mode where num = $num";
            $result = mysqli_query($conn, $sql_select);
            $row = mysqli_fetch_array($result);
            $copied_name = $row['file_copied'];
    
            if($copied_name){
                $file_path = './data/'.$copied_name;
                unlink($file_path);
            }
    
            $sql_delete = "delete from $mode where num = $num";
            mysqli_query($conn, $sql_delete);
        }
    
        mysqli_close($conn);
        header("Location:admin.php");
    
    }
?>