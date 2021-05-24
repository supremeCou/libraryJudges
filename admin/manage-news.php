<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
include_once 'includes/dbconnect.php';

include_once 'class/title.php';
include_once 'class/news.php';

$dbclass = new Database();
$connection = $dbclass->dbConnection();
$title = new Title($connection);
$titleData = $title->getTitleIdbyName();
$news = new News($connection);
$stmt = $news->read();
$count = $stmt->rowCount();


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Judge's Library | Manage Newspaper</title>
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
                <h4 class="header-line">Manage Newspaper</h4>
    </div>
   


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Newspaper Listing
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <a  href="add-news.php" class="btn btn-info" style="float: inline-end;" >Add News</a><br><br>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Year</th>
                                            <th>Article</th>
                                            <th>News Paper</th>
                                            <th>News Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$cnt=1;
if($count > 0){
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>                                           
                                            <tr class="odd gradeX">
                                                <td class="center"><?php echo htmlentities($cnt);?></td>
                                                <td class="center"><?php echo htmlentities(date("Y" , strtotime($row['news_date'])));?></td>
                                                <td class="center"><?php echo htmlentities($row['new_article']);?></td>
                                                <td class="center"><?php echo htmlentities($titleData[$row['title']]);?></td>
                                                <td class="center"><?php echo htmlentities(date("Y-m-d" , strtotime($row['news_date'])));?></td>
                                                <td class="center"><a href="../newsupload/<?php echo htmlentities($row['news_file']);  ?>" target="_blank" class="btn btn-success btn-xs">View</a></td>
                                            </tr>
<?php $cnt=$cnt+1;}} ?>     
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
</body>
</html>
<?php } ?>