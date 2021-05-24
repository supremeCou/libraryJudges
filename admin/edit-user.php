
<?php
session_start();
include_once 'includes/dbconnect.php';

include_once 'class/users.php';

$database = new Database();
$db       = $database->dbConnection();

$user     = new Users($db);

if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{ 



?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Judges' Library | Edit Users</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra">
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Edit Users</h4>
                
                            </div>

</div>



<?php if($_SESSION['error']!="")
{?>
<div class="col-md-6">
<div class="alert alert-danger" >
<strong>Error :</strong> 
<?php echo htmlentities($_SESSION['error']);?>
<?php echo htmlentities($_SESSION['error']="");?>
</div>
</div>
<?php } ?>

<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
User Info
</div>

<?php


$user_id=intval($_GET['id']);
$user->id       = $user_id;
$fetchusr=$user->getSingleUser();
$dataRow = $fetchusr->fetch(PDO::FETCH_ASSOC);

$user_name = $dataRow['user_name'];
$user_email = $dataRow['user_email'];
$user_department = $dataRow['user_department'];
$user_password = base64_decode($dataRow['user_password']);

?>
<div class="panel-body">
        <form role="form" method="post" action="user/process_user">
             <input class="form-control" type="hidden" name="updated_by" autocomplete="off"  value="<?=$_SESSION['alogin']?>" />
              <input class="form-control" type="hidden" name="id" autocomplete="off"  value="<?=$user_id?>" />
        <div class="form-group">
        <label>User Name<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="user_name" autocomplete="off" value="<?=$user_name?>" required  maxlength="100" />
        </div>
        <div class="form-group">
        <label>User Email<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="user_email" id="user_email" autocomplete="off" value="<?=$user_email?>"  maxlength="150"  required  pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" />
        </div>
        <div class="form-group">
        <label>User Password<span style="color:red;">*</span></label>
        <input class="form-control" type="password" name="user_password" value="<?=$user_password?>" autocomplete="off"  maxlength="20"  required />
        </div>
        <div class="form-group">
        <label>Department</label>
        <select class="form-control" name="user_department" required="required">
             <option value=""> Select Department</option>
             <option value="Judges Library" <?php if($user_department=="Judges Library") echo "selected"; ?>>Judges Library</option>
             <option value="IT"  <?php if($user_department=="IT") echo "selected"; ?>>IT</option>
        </select>
        </div>
       <!--  <div class="form-group">
        <label>Designation</label>
        <select class="form-control" name="category" required="required">
             <option value=""> Select Designation</option>
             <option value=""></option>
        </select>
        </div> -->
       <button type="submit" name="update" class="btn btn-info">Update </button>

        </form>
</div>
</div>
</div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
