<?php
include_once '../bbps_db_conn.php';
session_start();
$sessionUser = $_SESSION['username'];
$sessionAdmin = $_SESSION['admin'];
?>


<div class="header">
    <div class="title header-margin">
        <div class="box actions">
            <a class="menu x">
                <span class="line top"></span>
                <span class="line middle"></span>
                <span class="line bottom"></span>
            </a>
        </div>
        <div class="box links home-btn">
            <a href="/admin">
                평상도록
            </a>
        </div>
        <div class="box actions login_link">
            <!-- <a class="menu login" href="login.php">
                LogIn
            </a> -->

            <?php
            if (isset($sessionUser)) {
                echo '<a class="menu login logout" href="logout.php">';
                echo    'LogOut';        
                echo '</a>';    
            } else {
                echo '<a class="menu login" href="login.php">';
                echo    'LogIn';        
                echo '</a>';    
            }
            
            ?>


        </div>
    </div>
</div>