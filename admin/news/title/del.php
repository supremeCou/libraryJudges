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
$Id =$data['id'];
$langId =$data['langId'];
$title->id = $Id;
$title->language = $langId;
if($title->delete()){
        $returnArr['status'] = "Success";
        $returnArr['msg'] = "Title Successfully Delete";
}
else{
        $returnArr['status'] = "Error";
        $returnArr['msg'] = "Something Error";
}
 echo  json_encode($returnArr); 

?>