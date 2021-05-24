<?php
session_start();
error_reporting(0);
include_once 'includes/dbconnect.php';

include_once 'class/Language.php';
include_once 'class/title.php';
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{


$dbclass = new Database();
$connection = $dbclass->dbConnection();
$product = new Language($connection);
$stmt = $product->read();
$title = new Title($connection);
$stmt_1 = $title->read();
$count = $stmt_1->rowCount();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
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
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra">
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add newspaper</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Newspaper Info
<a  href="manage-news.php" class="btn btn-info" style="float: inline-end;">Back To List</a><br><br>
</div>
<div class="panel-body">
    <form  method="POST" id="newForm" enctype="multipart/form-data">
        <div class="form-group">
        <label>Language</label>
        <select class="form-control" id="languageId" name="languageId" onchange="gettitle(this.value);">
                        <option value="0">Select Language</option>
                        <?php
                        $langArr = array();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row['id'];  ?>"><?php echo $row['language'];  ?></option>
                        <?php } ?>
        </select>
        </div>
        <div class="form-group">
        <label>Newspaper</label>
        <select class="form-control" name="titleName" id="titleName" onclick="selectLangCheck();" >
             
        </select>
        </div>
        <div class="form-group">
        <label>News  Date<span style="color:red;">*</span></label>
        <input class="form-control" type="date" name="newsdate" id="newsdate"   />
        </div>
        <div class="form-group">           
            <label>Subject<span style="color:red;">*</span></label>
            <input class="form-control" type="text" name="newssub" id="newssub" placeholder="Enter Subject Comma Separated.." />
        </div>
        <div class="form-group">
        <label>News Article<span style="color:red;">*</span></label>
        <textarea class="form-control" id="newsarticle" name="newsarticle" placeholder="Enter Article For News.."></textarea>
        </div>
        <div class="form-group">
        <label>Upload Pdf<span style="color:red;">*</span></label>
        <input class="form-control" type="file" name="file" id="file" autocomplete="off"   />
        </div>
            <button type="button"  class="btn btn-info" onclick="addNewsData();">Add </button>
    </form>
    </div>
    </div>
    </div>

        </div>
   
    </div>
    </div>
     <div class="alert error" style="display:none" id="errorMsg">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
     </div>
     <div class="alert error2" style="display:none" id="errorMsg2">
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
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    <script src="news/js/news.js"></script>
</body>
</html>
<?php } ?>
