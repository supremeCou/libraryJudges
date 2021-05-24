<?php
session_start();
error_reporting(1);

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
    <title>Judges' Library | Manage Users</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Manage Users</h4>
    </div>
     <div class="row">
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
<?php if($_SESSION['msg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['msg']);?>
<?php echo htmlentities($_SESSION['msg']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['updatemsg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['updatemsg']);?>
<?php echo htmlentities($_SESSION['updatemsg']="");?>
</div>
</div>
<?php } ?>


   <?php if($_SESSION['delmsg']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['delmsg']);?>
<?php echo htmlentities($_SESSION['delmsg']="");?>
</div>
</div>
<?php } ?>

</div>


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           User Listing
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>UserName</th>
                                            <th>User Email</th>
                                            <th>User Department</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$stmt=$user->getUsers();
$usrCount = $stmt->rowCount();
$cnt=1;

if($usrCount > 0)
{
while($result = $stmt->fetch(PDO::FETCH_OBJ))
{               ?>                                      
                   <tr class="odd gradeX">
                        <td class="center"><?php echo htmlentities($cnt);?></td>
                        <td class="center"><?php echo htmlentities($result->user_name);?></td>
                        <td class="center"><?php echo htmlentities($result->user_email);?></td>
                        <td class="center"><?php echo htmlentities($result->user_department);?></td>
                        <!-- <td class="center"><?php 
                        //if($result->status==1) {?>
                        <a href="#" class="btn btn-success btn-xs">Active</a>
                        <?php //} else {?>
                        <a href="#" class="btn btn-danger btn-xs">Inactive</a>
                        <?php //} ?></td> -->
                        <td class="center"><?php echo htmlentities($result->created_on);?></td>
                        
                        <td class="center">

                        <a href="edit-user?id=<?php echo htmlentities($result->id);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 

                      <!--<a href="manage-users.php?del=<?php //echo htmlentities($result->id);?>" 
                        onclick="return confirm('Are you sure you want to delete?');"" >-->
                        <a class='delbtn_usr' data-pid=<?php echo htmlentities($result->id); ?> href='javascript:void(0)'>
                          <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>

                        </td>
                    </tr>
<?php $cnt=$cnt+1;
}}

 ?>                      
                                           
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
  <script src="assets/js/custom.js"></script>
    <!--User delete /status update--->


    <script>
        /* Delete button ajax call */

     $('.delbtn_usr').on( 'click', function(){
        
        if(confirm('This action will delete this record. Are you sure?')){
          
          var pid = $(this).data('pid');
          console.log("userid***"+pid);
          
          $.post( "user/process_user", { 'uid': pid ,'action':'UserDelete'})
          
          .done(function( data ) {
            console.log(data);
            
            if(data > 0){
            
              $('.alert-success').show(3000).html("Record deleted successfully.").delay(3200).fadeOut(6000);
            
            }else{
            
              $('.alert-danger').show(3000).html("Record could not be deleted. Please try again.").delay(3200).fadeOut(6000);;
            
            }

            setTimeout(function(){
                window.location.reload(1);
            }, 5000);

          });
        }
     });

      /* Delete button ajax call */



    </script>

</body>
</html>
<?php } ?>