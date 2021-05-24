<?php
session_start();
error_reporting(0);
include('includes/dbconnect.php');
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
    <title>Judges Library | Add Legislative Research Of Central Act</title>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP CORE STYLE  -->
   
   <link href="assets/css/bootstrap.css" rel="stylesheet" id="bootstrap-css" /> 
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 -->   

   
<style>
    /* Latest compiled and minified CSS included as External Resource*/

/* Optional theme */

/*@import url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css');*/

.stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
    
    
    
</style>
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra">
    <div class="content-wrapper">
         
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Legislative Research Of Central Act</h4>
             </div>

        </div>

 
   
<div class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Principal Act</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Debates/Bill</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Repealed/Superseded </small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Law Commission</small></p>
            </div>
        </div>
    </div>

   
    
    <form role="form" id="frmlrca" enctype="multipart/form-data" >
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Principal Act</h3>
            </div>
            <div class="panel-body">
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
                    <input maxlength="100" name="date_of_president_asset" type="text"  class="form-control" placeholder="Enter Date of President's Assent" />
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
                 <button type="button" name="Save" id="butsave" class="btn btn-info">Save </button>
                 <span id="success" style="display:none;width: 400px;border: 1px solid #D8D8D8;padding: 10px;border-radius: 5px;
font-family: Arial;font-size: 11px;text-transform: uppercase;background-color: rgb(236, 255, 216);color: green;text-align: center;margin-top: 30px;"></span>
                
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
<script>





$(document).ready(function() {
		$('#butsave').on('click', function(e) {
			    e.preventDefault();

			$("#butsave").attr("disabled", "disabled");
		var formData = new FormData($("#frmlrca")[0]);

			var myForm = document.getElementById('frmlrca');  // Our HTML form's ID
			var file_principal_act = document.getElementById('file_principal_act');  // Our HTML files' ID
			// Get the files from the form input
    		var fileprincipalact = file_principal_act.files;
    		console.log("Act file::"+fileprincipalact);

			console.log("Act file length::"+fileprincipalact.length);
    		
    		if(fileprincipalact.length != 0 )
    		{
    			
    		 var file_principal_type = fileprincipalact[0].type; // get file type
 
    		console.log("Act file type::"+file_principal_type);
    			if(file_principal_type!="application/pdf")
    			{
    				alert("Please upload PDF format!!!");return false;
    			}
    		}

			var act_name	 = $('#act_name').val();	
			var act_number   = $('#act_number').val();
			if(act_name!="" && act_number!=""){
				console.log("****Principal Act*********");

				$.ajax({
				url: "legislative/legislative_act_save.php",
				type: "POST",
				dataType: 'json',
				data: formData,
				contentType: false,
				cache: false,
       			 processData: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$("#success").show();
						$('#success').html('Data added successfully !'); 						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});


			}else{
				alert('Please fill all the mandatory fields !');
		   }

		});
});

</script>


        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Debates/Bill</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Introduced in LokSabha</label>
                <select class="form-control" name="loksabha_debate" >
                <option value=""> Select</option>
                 <option value="1"> Yes</option> <option value="2"> No</option>
                </select>
                </div>
                <div class="form-group">
                <label>Upload LS Debates</label>
                <input class="form-control" type="file" name="file_lsdebate" autocomplete="off"   />
                </div>



                <div class="form-group">
                    <label class="control-label">Introduced in Rajya Sabha</label>
                <select class="form-control" name="rajsabha_debates" >
                <option value=""> Select</option>
                 <option value="1"> Yes</option> <option value="2"> No</option>
                </select>
                </div>
                <div class="form-group">
                <label>Upload RS Debates</label>
                <input class="form-control" type="file" name="file_rajdebate" autocomplete="off"  />
                </div>

                <div class="form-group">
                    <label class="control-label">Introduced in Both Houses</label>
                <select class="form-control" name="rajsabha_debates" >
                <option value=""> Select</option>
                 <option value="1"> Yes</option> <option value="2"> No</option>
                </select>
                </div>
                <div class="form-group">
                <label>Upload both House Debates</label>
                <input class="form-control" type="file" name="file_lr_debate" autocomplete="off"  />
                </div>


                <div class="form-group">
                    <label class="control-label">Bill Title<span style="color:red;">*</span></label>
                    <input maxlength="100" name="bill_title" type="text" required="required" class="form-control" placeholder="Enter Bill Title" />
                </div>
               <div class="form-group">
                    <label class="control-label">Bill Number <span style="color:red;">*</span></label>
                    <input maxlength="100" name="bill_number" type="text" required="required" class="form-control" placeholder="Enter Bill Number" />
                </div>
                 <div class="form-group">
                    <label class="control-label">Gazette Citation<span style="color:red;">*</span></label>
                    <input maxlength="100" name="gazette_bill_citation" type="text" required="required" class="form-control" placeholder="Enter Gazette Citation" />
                </div>
                <div class="form-group">
                    <label class="control-label">Upload Bill</label>
                     <input type="file" id="bill_upload" name="bill_upload" class="form-control" >
                </div>







                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Repealed/Superseded</h3>
            </div>
            <div class="panel-body">


            <div class="form-group">
                    <label class="control-label">Repealed/Superseded</label>

                </div>

                    <div class="field_wrapper">
                    <div>
                    <input type="text" name="field_name[]" value="" class="form-control" placeholder="Enter Act"/> <input type="file" id="file_rep_upload" name="file_rep_upload" class="" >
                    <a href="javascript:void(0);" class="add_button" title="Add field"><img src="assets/img/add-icon.png"/></a>
                    </div>
                    </div>
               

       <div class="form-group"></div>





                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Cargo</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Company Name</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Company Address</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                </div>
                <button class="btn btn-success pull-right" type="submit">Finish!</button>
            </div>
        </div>
    </form>
</div>




   



    </div>
    </div>


<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="field_name[]" value="" class="form-control"/> <input type="file" id="file_rep_upload" name="file_rep_upload" class="" ><a href="javascript:void(0);" class="remove_button"><img src="assets/img/remove-icon.png"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

    <script>
    $(document).ready(function () {


        /************Add more button start---*/

      //    $(".add-more-rs").click(function(){ 
      //     var html = $(".copy").html();
      //     $(".after-add-more").after(html);
      // });


      // $("body").on("click",".remove-rs",function(){ 
      //     $(this).parents(".control-group").remove();
      // });

        /**********End of Add more button********/



    
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');
    
        allWells.hide();
    
        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);
    
            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-success').addClass('btn-default');
                $item.addClass('btn-success');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });
    
        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;
    
            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }
    
            if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
        });
    
        $('div.setup-panel div a.btn-success').trigger('click');
    });

</script>




     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
        <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js"></script>
</body>
</html>
<?php } ?>
