<?php
function isIE()  {
    if($_SERVER['HTTP_USER_AGENT']) {//IE check
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) {
            $ie = 1;
        } else {
            $ie = 0;
        }
    } else {
        $ie = 0;
    }
    return $ie;
}
// $file_server = $_SERVER[HTTP_HOST];
$file_server = "pyeongsang.net";

?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>평상도록 | 관리자</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="../static/css/admin_important.css" type="text/css" media="all" />
<link rel="stylesheet" href="../static/css/layout.css" type="text/css" media="all" />
<link rel="stylesheet" href="../static/css/admin.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="/trix-master/dist/trix.css">
    <script type="text/javascript" src="/trix-master/dist/trix.js"></script>
    <!-- <script type="text/javascript" src="/trix-master/dist/attachments.js"></script> -->
    <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        var isIndex;
    </script>

