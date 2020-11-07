<?php include 'header.php'?>
    <?php
    if($sessionUser) {
        $username = $sessionUser;
    } else {
        ?>
        <script>
            alert("로그인하세요");
            location.href='index.php';
        </script>
        <?php
    }
    ?>

<?php
$URL = "./index.php";
    include_once '../bbps_db_conn.php';
    $q = intval($_GET['q']);
    $sql = "DELETE FROM articles WHERE id = $q";
    $result = mysqli_query($conn, $sql);
?>
<script>        
    alert("삭제되었습니다.");                  
    location.replace("<?php echo $URL?>");
</script>