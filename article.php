<?php
    include 'wantit_db_config.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    session_start();
    $q = intval($_GET['q']);
    $sql = "SELECT * FROM articles WHERE id = $q";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $title = $row["title"];
    $wi_id = $row["wi_id"];
    $content = $row["content"];
    $created_at = $row["created_at"];
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trix-test</title>


    <link rel="stylesheet" type="text/css" href="/trix-master/dist/trix.css">
    <script type="text/javascript" src="/trix-master/dist/trix.js"></script>
    <script type="text/javascript" src="/trix-master/dist/attachments.js"></script>
</head>


<body>
    <section id="sc">
        <div>
            <center>
                <h2>
                    <?=$title?>
                </h2>
            </center>
        </div>
        <div>
            <div>
                <?=$wi_id?>
            </div>
            <div>
                <?=$created_at?>
            </div>
            <div class="trix-content">
                <?=$content?>
            </div>
        </div>
        <div>
            <button onclick="location.href='index.php'">
                목록
            </button>
        </div>
    </section>
</body>

</html>
