<?php
include_once('config.php');
define("ROW_PER_PAGE",5);
//error_reporting(1);
$titleData = array();
$langSql = "select id,language from tbl_language where status ='1'";
$langstmt = $pdo_conn->prepare($langSql);
$langstmt->execute();
while ($row = $langstmt->fetch(PDO::FETCH_ASSOC)){
    
}
$titleSql = "select id,title_name from tbl_news_title where status ='1'";
$titlestmt = $pdo_conn->prepare($titleSql);
$titlestmt->execute();
while ($res = $titlestmt->fetch(PDO::FETCH_ASSOC)){
      $titleData[$res['id']] = $res['title_name'];
}
$newsSql = "select * from tbl_news order by id desc";
$newsstmt = $pdo_conn->prepare($newsSql);
$newsstmt->execute();
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="Content-Type"
 content="text/html; charset=iso-8859-1">


  <title>News Listing</title>
 <style type="text/css">
a {font-family:calibri;font-size:18px;cursor: auto}
a:link {color:black;}
a:visited {color: #000000}
a:hover {text-decoration: none; color: #3333ff; font-weight:bold;}
a:active {color: #000000;text-decoration: none}
  </style>
  <title>News</title>
 <!--  <style type="text/css">body {background-image: url('image/bg2.jpg');}</style> -->
  <style type="text/css"> a {text-decoration:none;}</style>
  <style type="text/css">#wrap {border:1px solid #708090 box-shadow: 0px 16px 10px 0px rgba(0,0,0,0.6); height:1000px; width:1020px; margin:auto;}</style>
  <style type="text/css">
#left1{
border:1px solid #9ec9cf; 
border-radius:05px; 
font-family:Times Roman; 
font-size:18px;
text-align: justify;
padding:20px; 
height:1300px; 
width:960px; 
margin:5px; 
float:left;
}
  </style>
 

  <link rel="stylesheet" href="file/css/jquery.dataTables.min.css">>
  <script src="file/js/jquery-3.5.1.js"></script>
  <script src="file/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrap">
<?php

include_once("file/includes/header.php");

?>
<!----------------------------------LEFT ROW ---------------------------------------------->
<div id="main3">
<div>
    <center>
    <h2 style="font-family: Calibri;">News Articles</h2>
    </center>
</div>
<div style="text-align: center;" id="left1" ><br>




<!--TABLE-->
<div class="table-responsive">
  <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Sr.no</th>
                <th>Year</th>
                <th>Article</th>
                <th>News Paper</th>
                <th>News date</th>
                <th>Article File</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cnt=1;
            while ($newsRow = $newsstmt->fetch(PDO::FETCH_ASSOC)){
 
            ?>
           <tr class="odd gradeX">
                                                <td class="center"><?php echo htmlentities($cnt);?></td>
                                                <td class="center"><?php echo htmlentities(date("Y" , strtotime($newsRow['news_date'])));?></td>
                                                <td class="center"><?php echo htmlentities($newsRow['new_article']);?></td>
                                                <td class="center"><?php echo htmlentities($titleData[$newsRow['title']]);?></td>
                                                <td class="center"><?php echo htmlentities(date("Y-m-d" , strtotime($newsRow['news_date'])));?></td>
                                                <td class="center"><a href="news/pdf/<?php echo htmlentities($newsRow['news_file']);  ?>" target="_blank" class="btn btn-info" style="color: #fff">View</a></td>
             </tr>
            <?php  $cnt=$cnt+1;
            } ?>
        </tbody>
        
    </table>
  <!--Table-->
</div><!-- end of table responsive-->
</div>
</div><!--end of main3-->
</div>



    <script>
        $(document).ready(function() {
    $('#example').DataTable({
        "dom": '<"top"f>rt<"bottom"lp>' ,
//        searching: false,
        info: false,
        ordering: false,});
} );
//$('table').dataTable({searching: false, paging: false, info: false});
    </script>
</body>
</html>
