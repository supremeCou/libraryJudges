  function gettitle(val){
          $.ajax({
                type: 'POST',
                url: 'news/getTitle',                  
                data: {langId:  val},                               
                dataType:' json',
                async:false,
                error: function() { console.log("error"); },
                success: function(response) { 
                    
                   $("#titleName").html(response.html);
                
                 },
         });
}
function selectLangCheck(){
    var langId = $('#languageId').val();
    if(langId == 0){
        $(".error2").show();
        $("#errorMsg2").text("Please  Select Language First");
        setTimeout(
        function() 
        {
        $(".error2").hide();
        }, 2000);
        return false;
    }
    
}
function addNewsData(){
    var languageId = $("#languageId").val();
    var titleName = $("#titleName").val();
    var newsdate = $("#newsdate").val();
    var newssub = $("#newssub").val();
    var newsarticle = $("#newsarticle").val();
    var file = $("#file").val();
    var ext = file.split('.').pop();
    if(languageId == 0){
        $(".error1").show();
        $("#languageId").focus();
        return false;
        
    }else if(titleName == 0){
         $(".error1").show();
         $("#titleName").focus();
        return false;
    }else if(newsdate == ''){
         $(".error1").show();
         $("#newsdate").focus();
        return false;
    }else if(newssub ==''){
         $(".error1").show();
         $("#newssub").focus();
         return false;
    }else if(newsarticle ==''){
         $(".error1").show();
         $("#newsarticle").focus();
         return false;        
    }else if(file == ''){
        $(".error1").show();
        $("#file").focus();
         return false;        
    }else if(file != '' && ext !="pdf"){
            $(".error2").show();
            $("#errorMsg2").text("Select Only Pdf File");
            setTimeout(
            function() 
            {
            $(".error2").hide();
            }, 2000);
           return false;
    }
    else{
        var fd = new FormData();
        var files = $('#file')[0].files;
        fd.append('languageId',languageId);
        fd.append('titleName',titleName);
        fd.append('newsdate',newsdate);
        fd.append('newssub',newssub);
        fd.append('newsarticle',newsarticle);
        fd.append('file',files[0]);
        $.ajax({
                type: 'POST',
                url: 'news/create',                  
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
                        window.location.href="manage-news.php";   //do something special
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
}
function addMoresubject(){
    console.log("in");
    
}
    