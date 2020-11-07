<?php
    $URL = "./index.php";
    include '../bbps_db_conn.php';
    $q = intval($_GET['q']);
    $sql = "DELETE FROM articles WHERE id = $q";
    $result = mysqli_query($conn, $sql);
    if($result) {
        ?>
        <script>        
            alert("삭제되었습니다.");                  
            location.replace("<?=$URL?>");
        </script>
        <?php
    } else {
        echo mysqli_error($conn);
        error_log(mysqli_error($conn));
    }
?>