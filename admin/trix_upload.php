<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Access-Control-Allow-Credentials: true');

// $mb_id = $_GET['q'];

if (!file_exists('/var/www/html/files')) {
    mkdir('/var/www/html/files', 0777);
}

$uploadPath = "/var/www/html/files/";
    $status = $statusMsg = ''; 
    if(!empty($_FILES["file"]["name"])) { 
        // File info 
        $temp = explode(".", $_FILES["file"]["name"]);
        $newFileName = round(microtime(true)) . '-' . $temp[0] . '.' . end($temp);
        $imgUploadPath = $uploadPath . $newFileName; 
        // $fileUploadPath = $uploadPath . "files/" . $newFileName; 
        $fileUploadPath = $imgUploadPath; 
        $fileType = pathinfo($imgUploadPath, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowedImgTypes = array('jpg','JPG','jpeg','JPEG','png','PNG'); 
        // $allowedFileTypes = array('pdf','PDF', 'hwp', 'HWP', 'doc', 'DOC', 'docx', 'DOCX'); 
        $allowedFileTypes = array('pdf','PDF'); 
        if(in_array($fileType, $allowedImgTypes)){ 
            $imageTemp = $_FILES["file"]["tmp_name"];  // Image temp source 
            move_uploaded_file($imageTemp, $imgUploadPath);
            // exec('convert '.$imgUploadPath.' -resize 300x300 /var/www/html/community_images/thumbs/'.$newFileName);//imageMagick compression
        } else if(in_array($fileType, $allowedFileTypes)) {
            $fileTemp = $_FILES["file"]["tmp_name"]; 
            move_uploaded_file($fileTemp, $fileUploadPath);
        } else { 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & PDF files are allowed to upload.'; 
        } 
    } else { 
        $statusMsg = 'Please select a file to upload.'; 
    } 
// echo $statusMsg; //for test
echo $newFileName;

?>