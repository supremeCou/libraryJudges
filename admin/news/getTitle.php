<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../includes/dbconnect.php';
include_once '../class/title.php';

$dbclass = new Database();
$connection = $dbclass->dbConnection();

$returnArr = array();
$title = new Title($connection);

$data = $_POST;
$langId =$data['langId'];
$html = "";
$title->language = $langId;
$stmt = $title->getTitleList();
$count = $stmt->rowCount();
$html = '<option value=""> Select Newspaper</option>';
if($count > 0){
           
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               $html .= '<option value='.$row["id"].'>'.$row["title_name"].'</option>'; 
            }
            $returnArr['html'] = $html;
}else{
           $returnArr['html'] ='';
}

 echo  json_encode($returnArr); 

?>