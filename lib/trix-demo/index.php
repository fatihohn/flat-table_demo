<?php
    include 'wantit_db_config.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    session_start();

    $sql = "SELECT * FROM articles ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
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
                <h2>게시물 목록</h2>
            </center>
        </div>

        <div>
            <div>
                <button  onclick="location.href='new_article.php'">게시물 작성</button>
<!--                 
                <select name="searchSlct" id="searchSlct">
                    <option value="0">제목</option>
                    <option value="1">글쓴이</option>
                </select>
                <input type="text" class="searchInput" id="searchInput" onkeyup="searchInput(this.name)" placeholder="검색">
            
                <script>
                    function searchSet() {
                    let searchSlct = document.getElementById("searchSlct").value;
                    let searchInpt = document.getElementById("searchInput");
                    searchInpt.setAttribute("name", searchSlct);
                    }

                    document.getElementById("searchSlct").addEventListener("change", searchSet);
           

                </script> -->
            </div>
            <div id="includeTable">
                <table>
                    <tbody>
                        <tr>
                            <th onclick='sortTable(0)'>제목</th> 
                            <th onclick='sortTable(1)'>글쓴이</th> 
                            <th onclick='sortTable(2)'>날짜</th>     
                        </tr>
                        <?php
                        // if ($result->num_rows > 0) {
                        if (mysqli_num_rows($result) > 0) {
                            // var_dump($result->fetch_assoc());
                            while($row = $result->fetch_assoc()) {
                            //     echo "<tr class='{$row["id"]}' >
                            //             <td class='{$row["id"]}' onclick='";
                            //     echo 'location.href="./article.php?q='.$row["id"].'"'."'>";
                            //     echo "{$row['title']}</td>    
                            //             <td class='{$row["id"]}'>{$row['wi_id']}</td>
                            //             <td class='{$row["id"]}'>{$row['created_at']}</td>
                            //         </tr>";
                            // }
                                echo "<tr class='{$row["id"]}' >
                                        <td class='{$row["id"]}'>";
                                echo "    
                                            <a href='./article.php?q={$row["id"]}'>{$row['title']}</a>
                                        </td>
                                        <td class='{$row["id"]}'>{$row['wi_id']}</td>
                                        <td class='{$row["id"]}'>{$row['created_at']}</td>
                                    </tr>";
                            }
                        }else {
                            echo "게시물이 없습니다.";
                        }
                        $conn->close();
                        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="tableBox"></div>
        </div>
    </section>
    <script type="text/javascript" src="/lib/paginator.js"></script>
</body>

</html>
