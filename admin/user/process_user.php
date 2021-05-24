<?php
session_start();

    
include_once '../includes/dbconnect.php';
include_once '../class/users.php';

$database = new Database();
$db       = $database->dbConnection();

$user     = new Users($db);

/***********UPDATE USER*************************/

if(isset($_POST['update']))
{

   
   $error=0;
   $id                  =$_POST['id'];
   $user->user_email    =$_POST['user_email'];
   $user->id            =$_POST['id'];
   echo 'test usr cnt'.$duplicate_email_chk =$user->DuplicateEmailCheck();
  

    if($duplicate_email_chk > 0){
      $response = "Email Already Exist!!!";
      $_SESSION['error']=$response;
      $error=1;
      header('location:../edit-user?id='.$id);
    }

   if($error==0)
   {

        //echo "inside error cond";die;
        $userData = array(
            'user_email' => $_POST['user_email'],
            'user_name' => $_POST['user_name'],
            'user_password' => base64_encode($_POST['user_password']),
            'updated_by'=> $_POST['updated_by'],
            'user_department'=>$_POST['user_department']
        );
        $condition = array('id' => $_POST['id']);
        $updateuser = $user->update($userData,$condition);

        
        if($updateuser)
        {
        $_SESSION['msg']="User updated successfully";
        header('location:../manage-users');
        }
        else 
        {
        $_SESSION['error']="Something went wrong. Please try again";
        header('location:../manage-users');
        }


   }//end of error cond
   


}

/***********UPDATE USER*************************/

/**************USER CREATION************/


if(isset($_POST['create']))
{

    $error=0;

    $user_email     =$_POST['user_email'];
    $user_name      =$_POST['user_name'];
    $user_password  =base64_encode($_POST['user_password']);
    $user_department=$_POST['user_department'];
    $created_by     =$_POST['created_by'];
    

 
    $user->user_email       = $user_email;
    $user->user_name        = $user_name;
    $user->user_password    = $user_password;
    $user->user_department  = $user_department;
    $user->created_by 		= $created_by;


    $unique_email_chk=$user->UniqueEmailCheck();

    if($unique_email_chk > 0){
      $response = "Email Already Exist!!!";
      $_SESSION['error']=$response;
      $error=1;
      header('location:../add-user');
    }

    if($error==0)
    {
        $createuser=$user->createUser();
     
        if($createuser)
        {
        	$_SESSION['msg']="User created successfully";
        	header('location:../manage-users');
        }
        else 
        {
        	$_SESSION['error']="Something went wrong. Please try again";
        	header('location:../manage-users');
        }
    }//END OF ERROR CONDITION

}//end of create condition

/**************USER CREATION************/


/**********USER DELETION*************/

$uid = intval($_POST['uid']);
if(intval($uid) && $_POST['action']=="UserDelete")
{
     //print_r($_POST);
      $userData = array(
        'status' => 0
    );
     $condition = array('id' => $uid);
     $updateuser = $user->update($userData,$condition);//updating the status to 0
    // $delete = $user->delete($condition);
     if($updateuser)
    {
        echo  $updateuser;
    }else{
        echo '0';
    }
}

/*******USER DELETION***************/


/*****USER Email Uniquness Checking********/

if(isset($_POST['useremail']))
{
   $useremail = $_POST['useremail'];
   $user->user_email       = $useremail;
   $count=$user->UniqueEmailCheck();

   $response = "<span style='color: green;'>Available.</span>";
   if($count > 0){
      $response = "<span style='color: red;'>Not Available.</span>";
   }

   echo $response;
   exit;


}



/*****USER Email Uniquness Checking********/


?>