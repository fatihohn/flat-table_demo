<?php
include_once '../bbps_db_conn.php';
session_start();
$sessionUser = $_SESSION['username'];
$sessionAdmin = $_SESSION['admin'];
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>평상도록 | 관리자</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Styles -->
<!-- <link rel="stylesheet" href="../static/css/admin_important.css" type="text/css" media="all" /> -->
<link rel="stylesheet" href="../static/css/layout_important.css" type="text/css" media="all" />
<link rel="stylesheet" href="../static/css/layout.css" type="text/css" media="all" />
<link rel="stylesheet" href="../static/css/admin.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="/trix-master/dist/trix.css">
    <script type="text/javascript" src="/trix-master/dist/trix.js"></script>
    <script type="text/javascript" src="/trix-master/dist/attachments.js"></script>
    <script>
        var isIndex;
    </script>