<!DOCTYPE html>
<html>

<head>
<?php include 'head.php'; ?>
<?php
  include "../bbps_db_conn.php";
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
    

?>
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
                    <h1>회원가입</h1>
                </header>
                
                <div class="container_login">
                    <form class='login_form new_user_form' method='post' action='new_user_action.php'>
                        <!-- @csrf -->
                        <p>Email: <input class="login_input" type="email" name="email" placeholder="이메일" required></p>
                        <p>ID: <input class="login_input" name="username" type="text" required></p>
                        <p>
                            <div class="createGrid3" id="userConf"></div>
                            <div>
                                <p>
                                (영문, 숫자 조합 7자 이상)
                                </p>
                            </div>
                        </p>
                        <p>PW: <input id="pwOne" class="login_input" name="password" type="password" required></p>
                        <p>PW check: <input id="pwTwo" class="login_input" name="password_conf" type="password" required></p>
                        <p>
                            <div class="createGrid3" id="pwConf"></div>
                            <div>
                                <p style="font-size:0.8rem; margin-top:10px; margin-left:30px">
                
                                    * 8자 이상 영문(대소문자)+숫자+특수문자 중 2종류 이상을 조합하여 사용할 수 있습니다.
                                    <br>
                                    * 아이디와 중복되는 패스워드는 사용이 불가능 합니다.
                                    <br>
                                    * 동일한 숫자 또는 문자를 3번이상 연속으로 사용할 수 없습니다.
                                </p>
                
                            </div>    
                        </p>
                        <button id="join" class="login_btn" type="submit" value="회원가입">
                            <p class="gg-batang">
                                회원가입
                            </p>
                        </button>
                        <button class="cancel_btn login_btn" name="cancel">
                            <a href = "javascript:history.back()">
                                취소
                            </a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'?>

    <script src="/static/js/main.js"></script>
        
 
<!-- <section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
                <div class="view_wrap">
    <div class="view_wrap_line">
        <div class="contEditor">
            <center>
                <h3>필진 등록</h3>
            </center>

        <form class="createForm" action="admin_create_user_action.php" method="POST" enctype="multipart/form-data">
            <p >
                <div class="createInput">
                    <label class="createGrid1">이름(실명)</label>
                    <input class="createGrid2" id="realname" type="text" name="realname" placeholder="이름" required />
                    
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">아이디</label>
                    <input class="createGrid2" id="username" type="text" name="username" placeholder="아이디" required />
                    <div class="createGrid3" id="userConf"></div>
                    <div>
                        <p>
                        (영문, 숫자 조합 7자 이상)
                        </p>
                    </div>
                </div>
                
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">비밀번호</label>
                <input class="createGrid2" type="password" id="pwOne" name="password" placeholder="비밀번호" required />
            </div>    
        </p>
        <p>
            <div class="createInput">
                <label class="createGrid1">비밀번호 확인</label>
                <input class="createGrid2" type="password" id="pwTwo" name="password_conf" placeholder="비밀번호 확인" required />
                <div class="createGrid3" id="pwConf"></div>
                    <div>
                        <p style="font-size:0.8rem; margin-top:10px; margin-left:30px">
        
                            * 8자 이상 영문(대소문자)+숫자+특수문자 중 2종류 이상을 조합하여 사용할 수 있습니다.
                            <br>
                            * 아이디와 중복되는 패스워드는 사용이 불가능 합니다.
                            <br>
                            * 동일한 숫자 또는 문자를 3번이상 연속으로 사용할 수 없습니다.
                        </p>
        
                    </div>    
                </div>    
            </p>
            

            <p>
                <div class="createInput">
                <label class="createGrid1">이메일</label>
                <input class="createGrid2" type="email" name="email" placeholder="이메일" required>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">필명</label>
                <input class="createGrid2" id="author" name="author" placeholder="필명" required />
                <div class="createGrid3" id="authorConf"></div>    
            </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">작가소개</label>
                <textarea class="createGrid2" name="auth_detail" placeholder="작가소개" rows="10" cols="20"required></textarea>
                </div>
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">필진 등급: 일반<br>('작가' 등급이 되려면 에디터에게 문의하세요)</label>
                <input class="createGrid2" type="hidden" name="cast" value="normal" />
                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1"></label>
                <input class="createGrid2" type="hidden" name="active" value="on" />
                </div>    
            </p>



            <p>
                <input type="submit">
                <button name="cancel"><a href = "javascript:history.back()" class="cancel_btn">취소</a></button>
            </p>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
    </section>
    <footer>
        <?php //include 'admin_footer.php'; ?>

    </footer> -->
 

</body>

</html>


