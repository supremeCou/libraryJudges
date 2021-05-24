<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../includes/dbconnect.php';
include_once '../class/news.php';

$dbclass = new Database();
$connection = $dbclass->dbConnection();

$returnArr = array();
$news = new News($connection);

$data = $_POST;
$news->title = $data['titleName'];
$news->language = $data['languageId'];
$news->date = $data['newsdate'];
$news->subject = $data['newssub'];
$news->article = $data['newsarticle'];
$info = pathinfo($_FILES['file']['name']);
$ext = $info['extension']; // get the extension of the file
$time = time();
$newname = $time.".".$ext ;
$news->file =$newname;
$target = '../../newsupload/'.$newname;
$upload = move_uploaded_file($_FILES['file']['tmp_name'], $target);
$news->status = '1';
if($news->create()){
    $returnArr['status'] = "Success";
    $returnArr['msg'] = "News Successfully Add";
}
else{
    $returnArr['status'] = "Error";
    $returnArr['msg'] = "Something Error";
}
 echo  json_encode($returnArr); 

?>