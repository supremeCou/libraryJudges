
<?php
session_start();



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
    <title>Judges' Library | Principal Act</title>
    <!-- BOOTSTRAP CORE STYLE  -->
   
   <link href="assets/css/bootstrap.css" rel="stylesheet" id="bootstrap-css" /> 
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
                <h4 class="header-line">Add Principal Act</h4>
                
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
Principal Act
</div>



<div class="panel-body">
        <form role="form" method="post" action=""  id="frmlrca" enctype="multipart/form-data">
             <input class="form-control" type="hidden" name="created_by" autocomplete="off"  value="<?=$_SESSION['alogin']?>" />
             <input type="hidden" name="action" value="SAVE_ACT">
       <div class="form-group">
                    <label class="control-label">Name of the Principal Act<span style="color:red;">*</span></label>
                    <input maxlength="100" name="principal_act" id="act_name" type="text" required="required" class="form-control" placeholder="Enter Principal Act Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Upload</label>
                     <input type="file" id="file_principal_act" name="file_principal_act">
                </div>

                 <div class="form-group">
                    <label class="control-label">Act Number<span style="color:red;">*</span></label>
                    <input maxlength="100" name="principal_act_no" id="act_number" type="text" required="required" class="form-control" placeholder="Enter Principal Act Number" />
                </div>
               <div class="form-group">
                    <label class="control-label">Gazette Citation</label>
                    <input maxlength="100" name="gazette_citation" type="text" class="form-control" placeholder="Enter Gazette Citation" />
                </div>
                 <div class="form-group">
                    <label class="control-label">Date of President's Assent</label>
                    <input maxlength="100" name="president_assent" type="text"  class="form-control" placeholder="Enter Date of President's Assent" />
                </div>
                <div class="form-group">
                    <label class="control-label">Upload</label>
                     <input type="file" id="myFile" name="president_assent_upload">
                </div>

                 <div class="form-group">
                    <label class="control-label">Date of Enforcement</label>
                    <input maxlength="100" name="date_of_enforcement" type="text"  class="form-control" placeholder="Enter Date of Enforcement" />
                </div>
                <div class="form-group">
                    <label class="control-label">Upload</label>
                     <input type="file" id="myFile" name="enforcement_upload">
                </div>
       <!--  <div class="form-group">
        <label>Designation</label>
        <select class="form-control" name="category" required="required">
             <option value=""> Select Designation</option>
             <option value=""></option>
        </select>
        </div> -->
         <button type="button" name="Save" id="butsave" class="btn btn-info">Save </button>
<span id="success" style="display:none;width: 400px;border: 1px solid #D8D8D8;padding: 10px;border-radius: 5px;
font-family: Arial;font-size: 11px;text-transform: uppercase;background-color: rgb(236, 255, 216);color: green;text-align: center;margin-top: 30px;"></span>
  <div id="erroutput"></div>
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





<script>

$(document).ready(function() {
        $('#butsave').on('click', function(e) {
                    e.preventDefault();
         var errval=0;
         var act_name     = $('#act_name').val();    
         var act_number   = $('#act_number').val();

         var file_act = $("#file_principal_act").val();
         var ext_act = file_act.split('.').pop();
         if(file_act!="" && ext_act !="pdf")
         {
            $("#erroutput").show();
            $("#erroutput").html('Please upload PDF for Principal Act !');
            errval=1;return false;
         }
         if(act_name==''){
               
             $("#erroutput").show();
             $("#erroutput").html('Please fill act name !');
             errval=1;return false;

        }

       if(act_number ==''){
               
             $("#erroutput").show();
             $("#erroutput").html('Please fill act Number !');
             errval=1;return false;

        }

        console.log("Err"+errval+"act"+act_name+"actno:"+act_number);

        if(errval==0)
        {
             console.log("****Principal Act*********");

              var fd = new FormData();
              var files_act = $('#file_principal_act')[0].files;
              fd.append('principal_act',act_name);
              fd.append('principal_act_no',act_number);
              fd.append('fileprincipal_act',files_act[0]);
              $.ajax({
                type: 'POST',
                url: 'legislative/legislative_act_save.php',                  
                data: fd,                                               
                async:false,
                contentType: false,
                processData: false,
                error: function() { console.log("error"); },
                success: function(response) { 
                   if(response.status == 'Success'){                       //                       
                       $('#successMsg').text(response.msg);
                       $('.success').show();                                               
                        setTimeout(
                        function() 
                        {
                        $('.success').hide();       
                        window.location.href="manage-legislative.php";   //do something special
                        }, 4000);
                        
                   }else{                        
                         $('#errorMsg').text(response.msg);
                         $('.error').show();
                         setTimeout(
                         function() 
                         {
                         $('.error').hide();                            
                         }, 3000);
                   }
                
                 },
         });
               

               

        }
    


  });
});
/*

$(document).ready(function() {
        $('#butsave').on('click', function(e) {
                e.preventDefault();
               

            var fd = new FormData();
        

            var act_name     = $('#act_name').val();    
            var act_number   = $('#act_number').val();


            var fileprincipalact = $('#file_principal_act')[0].files;

            fd.append('principal_act',act_name);
            fd.append('principal_act_no',act_number);
            
            fd.append('file_principal_act',fileprincipalact[0]);
            if(act_name!="" && act_number!=""){
                console.log("****Principal Act*********");

                $.ajax({
                url: "legislative/legislative_act_save.php",
                type: "POST",
                dataType: 'json',
                data: fd,
                contentType: false,
                cache: false,
                 processData: false,
                error: function() { console.log("errorsubmssion"); },
                success: function(response){
                    console.log("dataResult::"+response.msg);
                  //  var dataResult = JSON.parse(dataResult);
                   //var response = JSON.parse(JSON.stringify(dataResult));
                    //console.log("Result::".response);
                    if(response.status=="Success"){
                        $("#butsave").removeAttr("disabled");
                        $("#success").show();
                        $('#success').html('Data added successfully !');                        
                    }
                    else if(response.status=="Error"){
                       //alert("Error occured !"+response.msg);
                         $("#butsave").removeAttr("disabled");
                        $("#erroutput").show();
                        $("#erroutput").html(response.msg);


                   

                    }//
                    
                }
            });


            }else{
                //alert('Please fill all the mandatory fields !');
                $("#butsave").removeAttr("disabled");
                $("#erroutput").show();
                $("#erroutput").html('Please fill all the mandatory fields !');
                
           }

        });
});
*/
</script>


      
    
</body>
</html>
<?php } ?>
