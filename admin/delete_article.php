<?php
$URL = "./index.php";
    include '../bbps_db_conn.php';
    $q = intval($_GET['q']);
    $sql = "DELETE FROM articles WHERE id = $q";
    $result = mysqli_query($conn, $sql);
?>
<script>        
    alert("삭제되었습니다.");                  
    location.replace("<?php echo $URL?>");
</script>