<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../includes/dbconnect.php';
include_once '../../class/title.php';

$dbclass = new Database();
$connection = $dbclass->dbConnection();

$returnArr = array();
$title = new Title($connection);

$data = $_POST;
$langName = $data['language'];
$titleName = ucwords($data['title']);
$title->language = $langName;
$title->title = $titleName;
////////////////////////////////check already exiting////////////////
$stmt = $title->existingLaguage();
$count = $stmt->rowCount();
if($count > 0){
            $returnArr['status'] = "Already Exit";
            $returnArr['msg'] = "Newspaper Already Existing";
}else{
            $title->status = '1';
            if($title->create()){
                $returnArr['status'] = "Success";
                $returnArr['msg'] = "Newspaper Successfully Add";
            }
            else{
                $returnArr['status'] = "Error";
                $returnArr['msg'] = "Something Error";
            }
}
 echo  json_encode($returnArr); 

?>