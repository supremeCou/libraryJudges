
<!DOCTYPE html>
<html xmlns="">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Judge's Library | Add Newspaper</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <style>
        .alert {
          padding: 20px;
          color: #a94442;
          background-color: #f2dede;
          border-color: #ebccd1;
          width: 21%;
          float: left;
          margin-top: -57%;
        }

        .closebtn {
          margin-left: 15px;
          color: white;
          font-weight: bold;
          float: right;
          font-size: 22px;
          line-height: 20px;
          cursor: pointer;
          transition: 0.3s;
        }

        .closebtn:hover {
          color: black;
        }
        .alert.success {  
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
 </style>
</head>
<body>
      <!------MENU SECTION START-->
<?php
include('includes/header.php');
include_once 'includes/dbconnect.php';

include_once 'class/Language.php';
include_once 'class/title.php';

$dbclass = new Database();
$connection = $dbclass->dbConnection();
$product = new Language($connection);
$stmt = $product->read();
$title = new Title($connection);
$stmt_1 = $title->read();
$count = $stmt_1->rowCount();
?>
<!-- MENU SECTION END-->
    <div class="content-wra">
 <div class="content-wrapper">
    <div class="container">
       <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Manage Newspaper</h4>
            </div>
        </div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"  id="addDiv" style="display:none;">
        <button  type="button" class="btn btn-info" style="float: inline-end;" onclick="hideaddiv();">Back To List</button><br><br>
            <div class="panel panel-info">
                <div class="panel-heading">        
                  Newspaper Info
                </div>
                <div class="panel-body" >
                <form  method="POST"  >


                    <div class="form-group">
                    <label>Language<span style="color:red;">*</span></label>
                    <select class="form-control" id="languageId">
                        <option value="0">Select Language</option>
                        <?php
                        $langArr = array();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $langArr[$row['id']] = $row['language'];
                        ?>
                        <option value="<?php echo $row['id'];  ?>"><?php echo $row['language'];  ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label>Newspaper<span style="color:red;">*</span></label>
                    <input class="form-control" type="text" name="titleName" id="titleName" autocomplete="off"   />
                    </div>
                    <button  type="button" class="btn btn-info" onclick="addtitle()">Add </button>
                  </form>

                </div>
            </div>
    </div>
  <div class="table-responsive" id="listDiv">
      <button  type="button" class="btn btn-info" style="float: inline-end;" onclick="showaddForm();">Add Newspaper</button><br><br>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Language</th>                                            
                        <th>Newspaper</th>                                            
                        <th>Ctreated On</th>                                            
                        <th>Action</th>
                    </tr>
                </thead>
                             <tbody>
<?php 
$cnt=1;
if($count > 0){
while ($res = $stmt_1->fetch(PDO::FETCH_ASSOC)){
    ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($langArr[$res['laguage_id']]);?></td>                                                                                      
                                            <td class="center"><?php echo htmlentities($res['title_name']);?></td>                                                                                      
                                            <td class="center"><?php echo htmlentities($res['created_on']);?></td>                                                                                      
                                            <td class="center">
                                             <a href="#" onclick="deleteTitle(<?php echo htmlentities($res['id']); ?>,<?php echo htmlentities($res['laguage_id']); ?>)" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
                                            </td>
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
           </table>
       </div>
   </div>
  </div>
 </div>
        <div class="alert error" style="display:none" id="errorMsg">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
       
        </div>
    <div class="alert error1" style="display:none">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          Please Enter Required Field 
    </div>
        <div class="alert success" style="display:none" id="successMsg">
        <span class="closebtn" onclick="this.parentElement.style.display='none';" >&times;</span>  
         
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
    <!-- for laguage data  -->
    <script src="news/title/js/title.js"></script>
   
</body>
</html>

