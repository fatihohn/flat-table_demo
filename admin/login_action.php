<?php
    session_start();
    include_once '../bbps_db_conn.php';
    
    //입력 받은 id와 password
    $username=mysqli_real_escape_string($conn, $_POST['username']);
    
    
    $querySalt = "SELECT salt FROM user_data WHERE username=?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $querySalt)) {
            echo "queryS error";
    } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $resultSalt = mysqli_stmt_get_result($stmt);
            $salt = mysqli_fetch_assoc($resultSalt)['salt'];
            // mysqli_stmt_close();
    }
    

    $password=mysqli_real_escape_string($conn, $_POST['password']);
    
    $pwSalt = $password.$salt;
    $password = base64_encode(hash('sha512', $pwSalt, true));

    //아이디가 있는지 검사
    $query = "SELECT * FROM user_data WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
            echo "query error";
    } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // mysqli_stmt_close();
    }


    //아이디가 있다면 비밀번호 검사
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        //비밀번호가 맞다면 세션 생성
        if($row['password']==$password){
            $_SESSION['username'] = $username;
            if($row['admin'] == "admin") {
                $_SESSION['admin'] = "admin";
            }
            if(isset($_SESSION['username']) && isset($_SESSION['admin'])){
                ?>      
                <script>
                        alert("<?=$username;?>님 로그인 되었습니다.");
                        location.replace("index.php");
                </script>
                <?php
            } else {
                // echo "session fail";
                ?>      
                <script>
                        alert("로그인 권한이 없습니다. 관리자에게 문의하세요.");
                        location.replace("index.php");
                </script>
                <?php
            }
        } else {
            ?>             
            <script>
                alert("비밀번호가 잘못되었습니다.");
                history.back();
            </script>
            <?php
        }

    } else {
        ?>              
        <script>
            alert("아이디가 잘못되었습니다.");
            history.back();
        </script>
        <?php
    }
?>
