<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../includes/dbconnect.php';
include_once '../../class/Language.php';

$dbclass = new Database();
$connection = $dbclass->dbConnection();

$returnArr = array();
$language = new Language($connection);

$data = $_POST;
$langId =$data['langId'];
$language->id = $langId;
if($language->delete()){
        $returnArr['status'] = "Success";
        $returnArr['msg'] = "Language Successfully Delete";
}
else{
        $returnArr['status'] = "Error";
        $returnArr['msg'] = "Something Error";
}
 echo  json_encode($returnArr); 

?>