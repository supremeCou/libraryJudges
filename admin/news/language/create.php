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
$langName =ucwords($data['languageName']);
$language->language = $langName;
////////////////////////////////check already exiting////////////////
$stmt = $language->existingLaguage();
$count = $stmt->rowCount();
if($count > 0){
            $returnArr['status'] = "Already Exit";
            $returnArr['msg'] = "Language Already Existing";
}else{
            $language->status = '1';
            if($language->create()){
                $returnArr['status'] = "Success";
                $returnArr['msg'] = "Language Successfully Add";
            }
            else{
                $returnArr['status'] = "Error";
                $returnArr['msg'] = "Something Error";
            }
}
 echo  json_encode($returnArr); 

?>