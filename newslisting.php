
<?php
include_once 'admin/includes/dbconnect.php';
define("ROW_PER_PAGE",5);
//error_reporting(1);

$dbclass = new Database();
$connection = $dbclass->dbConnection();

 function getTitleNameByID($titleID,$connection) {
        $titleArr = array();
       $query = "SELECT id,title_name  FROM  tbl_news_title where id='".$titleID."' ";
        
        $stmt = $connection->prepare($query);
      //echo 'test';$stmt;die;
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['title_name'];
        
        
    }






//print_r($titleName);

$titleSql = "select id,title_name from tbl_news_title where status ='1'";
$titlestmt = $connection->prepare($titleSql);
$titlestmt->execute();
while ($res = $titlestmt->fetch(PDO::FETCH_ASSOC)){
      $titleData[$res['id']] = $res['title_name'];
}



  $cond="";
  $search_keyword = '';$search_skeyword=''; $search_subject ='';
  if(!empty($_POST['search']['keyword'])) {
    $search_keyword = $_POST['search']['keyword'];
    $cond.=" AND new_article LIKE :keyword ";
  }
  if(!empty($_POST['subject']['sub_keyword'])) {
    $search_subject = $_POST['subject']['sub_keyword'];
    $cond.=" AND subject LIKE :sub_keyword ";
  }

  if(!empty($_POST['title']['skeyword'])) {
    $search_skeyword = $_POST['title']['skeyword'];
    $cond.=" AND title = :skeyword ";
  }

 if(!empty($_POST['news']['nkeyword'])) {
    $search_nkeyword = $_POST['news']['nkeyword'];
    $cond.=" AND DATE(news_date) = :nkeyword ";
  }

  // if(!empty($_POST['tuts_link']) && $_POST['tuts_link']!="") {
  //  $tuts_link = $_POST['tuts_link'];
  //  $cond.="  AND tuts_link = :linkval ";
  // }

$sql = 'SELECT *,YEAR(news_date) AS newsyear FROM tbl_news WHERE status=1 '. $cond.' ORDER BY id DESC ';
  
  /* Pagination Code starts */
  $per_page_html = '';
  $page = 1;
  $start=0;
  if(!empty($_POST["page"])) {
    $page = $_POST["page"];
    $start=($page-1) * ROW_PER_PAGE;
  }

  //echo '<br>Search Key:  '.$search_keyword.'     newsdate val:'.$search_nkeyword;
  $limit=" limit " . $start . "," . ROW_PER_PAGE;
  $pagination_statement = $connection->prepare($sql);

   //$pagination_statement->execute( $search_keyword,$tuts_link);

  if($search_keyword) $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
  if($search_subject) $pagination_statement->bindValue(':sub_keyword', '%' . $search_subject . '%', PDO::PARAM_STR);
  if(trim($search_skeyword)) $pagination_statement->bindValue(':skeyword',$search_skeyword , PDO::PARAM_STR);
  if(trim($search_nkeyword)) $pagination_statement->bindValue(':nkeyword',$search_nkeyword , PDO::PARAM_STR);
  //print_r($pagination_statement);
  $pagination_statement->execute();

  $row_count = $pagination_statement->rowCount();
  if(!empty($row_count)){
    $per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
    $page_count=ceil($row_count/ROW_PER_PAGE);
    if($page_count>1) {
      for($i=1;$i<=$page_count;$i++){
        if($i==$page){
          $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
        } else {
          $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
        }
      }
    }
    $per_page_html .= "</div>";
  }
  
  $query = $sql.$limit;
  $pdo_statement = $connection->prepare($query);
  //$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
  if($search_keyword) $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
  if($search_subject) $pdo_statement->bindValue(':sub_keyword', '%' . $search_subject . '%', PDO::PARAM_STR);
  if(trim($search_skeyword)) $pdo_statement->bindValue(':skeyword', $search_skeyword, PDO::PARAM_STR);
   if(trim($search_nkeyword)) $pdo_statement->bindValue(':nkeyword', $search_nkeyword, PDO::PARAM_STR);
  $pdo_statement->execute();
  $result = $pdo_statement->fetchAll();

  //print_r($_POST);
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  

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

/* Table Styles */
div.dataTables_length {
    float: left;
    background-color: red;
}
 
div.dataTables_filter {
    float: right;
    background-color: green;
}
 
div.dataTables_info {
    float: left;
    background-color: blue;
}
 
div.dataTables_paginate {
    float: right;
    background-color: yellow;
}
 
div.dataTables_length,
div.dataTables_filter,
div.dataTables_paginate,
div.dataTables_info {
    padding: 6px;
}


table.pretty {
    clear: both;
}
 
/* Self clearing - */
div.dataTables_wrapper:after {
    content: ".";
    display: block;
    clear: both;
    visibility: hidden;
    line-height: 0;
    height: 0;
}
html[xmlns] .dataTables_wrapper { display: block; }
* html .dataTables_wrapper { height: 1%; }



table.pretty td,
table.pretty th {
    padding: 5px;
    border: 1px solid #fff;
}
/* Header cells */
table.pretty thead th {
    text-align: center;
    background: #66a9bd;
}

/* Body cells */
table.pretty tbody th {
    text-align: left;
    background: #91c5d4;
}
 
table.pretty tbody td {
    text-align: left;
    background: #d5eaf0;
}
 
table.pretty tbody tr.odd td {
    background: #bcd9e1;
}
/***************Table styling****************/
  </style>
   <link rel="stylesheet" href="file/css/jquery.dataTables.min.css">
<script src="file/js/jquery-3.5.1.js"></script>




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
<h2 style="font-family: Calibri;">Legal News Paper Clippings</h2>
</center>


</div>
<div style="text-align: center;" id="left1" ><br>
<br>
<br>


<div class="container-fluid">
<!--TABLE-->
  <div class="row">
<form name='frmSearch' action='' method='post'>
<div class="col-sm-3">
 
  <select id="newsId" name="title[skeyword]" class="form-control">
     <option value="">Select Newspaper</option>

     <?php

    foreach($titleData as $key =>$value)
    {
        if($search_skeyword==$key)
        {
          $sel="selected";
        }else{
          $sel="";
        }
      ?>
        <option value="<?=$key?>" <?=$sel?>><?=$value?></option>    
    <?php }

     ?>
    
      </select>
</div>
<div class="col-sm-3">
<input type="text" name='subject[sub_keyword]' class="form-control" value="<?php echo $search_subject; ?>" id='news_subject' maxlength='25' placeholder="Search for subject.....">
</div>
<div class="col-sm-3">
<input type="text" name='search[keyword]' class="form-control" value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25' placeholder="Search for article.....">
</div>
    <div class="col-sm-2">
      
        <input type="date"  class="form-control" name="news[nkeyword]" id="news_date" value="" style="padding-top: 1;width: 117%;">
    </div>
<div class="col-sm-1">
    <input type="submit" name="btnsubmit"  class="btn btn-info" value="Search" > 
  
  <!-- <input type="button"  value="Reset" onclick="reset();"> -->
</div>
</div>
<vr><br><br>
<div class="table-wrapper">
  <!--Table-->
  <table id="example"  class="pretty" style="width:100%">

    <!--Table head-->
    <thead>
      <tr>
        <th>SNo</th>
        <th>Year</th>
        <th>Article</th>
        <th>Newspaper</th>
        <th>News Date</th>
        <th>View</th>
       
      </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>


      <?php
      $cnt=1;
  if(!empty($result) && isset($_POST['btnsubmit'])) { 
    foreach($result as $row) {

      
  ?>
      <tr>
        <td align="center"><?=$cnt?></td>
        <td><?php echo $row['newsyear']; ?></td>
        <td><?php //echo wordwrap(htmlentities($row['new_article']),50,"<br>");
                echo    htmlentities($row['new_article']);
         ?></td>
        <td style="text-align: left;"><?php $titleName=getTitleNameByID($row['title'],$connection); 
        echo $titleName;
         ?></td>
        <td><?php echo $row['news_date']; ?></td>
        <td><a href="newsupload/<?php echo htmlentities($row['news_file']);  ?>" target="_blank" class="btn btn-success btn-xs">View</a></td>
         </tr>
      <?php

      $cnt++;
    }//end of foreach

    ?> <tr><td colspan="6"><?php echo $per_page_html; ?></td></tr>
    <?php
  }else{
      echo "<tr><td colspan='6'>No record Found!!!</td></tr>";

  }//end of if
  ?>
 
     
    </tbody>
    <!--Table body-->
  </table>
  <!--Table-->
</form>
</div><!-- end of table responsive-->

</div>







</div>

</div><!--end of main3-->



<!--Footer start-->


<!--End of Footer-->

</div>



</div>
  <?php
include_once("file/includes/footer.php");


  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  
  function reset(){
    alert("in");
    $("#newsId").prop('selectedIndex',0);

       
  }
  </script>
</body>
</html>
