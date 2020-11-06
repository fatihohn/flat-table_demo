<?php
    include_once '../bbps_db_conn.php';

    $str = $_GET['str'];

    $sql_tag_finder = "SELECT tag_name FROM tags WHERE tag_name LIKE '$str%' ORDER BY tag_name*1 ASC";

    $result_tag_finder = mysqli_query($conn, $sql_tag_finder);

    
        echo '<ul class="tag_finder">';
        if (mysqli_num_rows($result_tag_finder) > 0) {
            while($row_tag_finder = $result_tag_finder->fetch_assoc()) {
            echo '<li class="tag_finder_item">';
            echo '<button type="button" class="tag_finder_btn">#'.$row_tag_finder['tag_name'].'</button>';
            echo '</li>';
            }
        }
        echo '</ul>';






        // $conn->close();
        
?>