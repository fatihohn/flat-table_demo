<?php
    include_once '../bbps_db_conn.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'?>
</head>
<body>
    <?php include 'header.php'?>
    <?php include 'nav.php'?>

    <div id="overlay" class="overlay"></div>
    <section class="front_main">
        <div class="main">
            <div class="container group">
                <header class="container_header">
                    <div class="spacer login_spacer"></div>
                    <img src="/static/img/flat_table_icon.svg" alt="flat_table_icon">
                    <h1>로그인</h1>
                </header>
                
                <div class="container_login">
                    <form class='login_form' method='post' action='login_action.php'>
                        <!-- @csrf -->
                        <p>ID: <input class="login_input" name="username" type="text" required></p>
                        <p>PW: <input class="login_input" name="password" type="password" required></p>
                        <button class="login_btn" type="submit" value="로그인">
                            <p class="gg-batang">
                                로그인
                            </p>
                        </button>
                        <button id="join" class="login_btn" onclick="location.href='new_user.php'">
                            <p class="gg-batang">
                                회원가입
                            </p>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<!-- @endsection -->

<?php include 'footer.php'?>

<script src="/static/js/main.js"></script>

</body>
</html>