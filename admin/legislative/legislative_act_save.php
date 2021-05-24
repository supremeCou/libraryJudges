<?php


header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    
include_once '../includes/dbconnect.php';
include_once '../class/legislativeact.php';

$database 		= new Database();
$db       		= $database->dbConnection();

$legislative     = new Legislative($db);

print_r($_FILES);print_r($_POST);

$legislative->act_name=$_POST['principal_act'];
$legislative->act_number=$_POST['principal_act_no'];
$file_principal_act=strtolower($_FILES['fileprincipal_act']['name']);
$file_act =explode(".",$file_principal_act); // get the extension of the file
print_r($file_act);
$time = time();
$fileprincipalact = $file_act[0]."_".$time.".".$ext_act[1] ;
$target_p_act = '../../lrca/act/'.$fileprincipalact;

if ($_FILES['fileprincipal_act']['type'] == 'application/pdf') {


echo "<br>pdf file".$target_p_act;
	}


/*Array ( [file_principal_act] => Array ( [name] => [type] => [tmp_name] => [error] => 4 [size] => 0 ) [president_assent_upload] => Array ( [name] => [type] => [tmp_name] => [error] => 4 [size] => 0 ) [enforcement_upload] => Array ( [name] => [type] => [tmp_name] => [error] => 4 [size] => 0 ) ) Array ( [created_by] => admin [principal_act] => DFSDF [principal_act_no] => SDFDSF [gazette_citation] => [president_assent] => [date_of_enforcement] => ) 

*/
/*print_r($_REQUEST);

if($_POST['action']=="SAVE_ACT")
{

			//$sucess_msg=array();$err_msg=array();
			$errorVal=0;

			$legislative->act_name=$_POST['principal_act'];
			$legislative->act_number=$_POST['principal_act_no'];
			$legislative->gazette_citation=$_POST['gazette_citation'];
			$legislative->date_of_president_asset=$_POST['date_of_president_asset'];
			$legislative->date_of_enforcment=$_POST['date_of_enforcment'];

			//$legislative->file_principal_act=strtolower($_FILES['file_principal_act']['name']);
			$file_principal_act=strtolower($_FILES['file_principal_act']['name']);

			$ext_act =implode(".",$_FILES['file_principal_act']['name']); // get the extension of the file
			$time = time();
			$fileprincipalact = $file_principal_act."_".$time.".".$ext_act[1] ;
			$legislative->file_principal_act=$fileprincipalact;
			$target_p_act = '../../lrca/act/'.$fileprincipalact;

			$allowedfileExtensions = array( 'pdf', 'doc','docx');
			//echo $file_principal_act."target".$target_p_act ;die;
			if ($_FILES['file_principal_act']['type'] == 'application/pdf') {

				$upload = move_uploaded_file($_FILES['fileprincipalact']['tmp_name'], $target_p_act);

					if($upload)
					{
							$sucess_msg ='Act File uploaded successfully.';$errorVal=0;
							$returnArr['status'] = "Success";
							$returnArr['msg'] = $sucess_msg ;
							
					}
					else
					{
							$errorVal=1;
						    $err_msg = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'.$_FILES['file_principal_act']['error'];
						    //echo json_encode(array("statusCode"=>201,"message"=>$err_msg));
						     $returnArr['status'] = "Error";
							 $returnArr['msg'] = $err_msg;
					}//end of move upload


				

			}else{

				 $errorVal=1;
				 $err_msg ="Upload PDF files for Principal Act!!!";
				 $returnArr['status'] = "Error";
				 $returnArr['msg'] = $err_msg;

				//echo json_encode(array("statusCode"=>201,"msg"=>$err_msg));
			}//END OF IN ARRAY COND ACT


			if($errorVal==0)
			{	
				 $sucess_msg="Save data into table after validation";		
          		 //echo json_encode(array("statusCode"=>200,"msg"=>$sucess_msg));

          		 $returnArr['status'] = "Success";
				 $returnArr['msg'] = $sucess_msg;

            }


            echo  json_encode($returnArr);
			

}

*/

?>