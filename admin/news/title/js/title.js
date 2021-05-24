    function showaddForm(){
             $('#addDiv').show();
             $('#listDiv').hide();
    }
    function hideaddiv(){
             $('#addDiv').hide();
             $('#listDiv').show();
    }
    function addtitle(){
        var languageId =  $("#languageId").val();
        var titlename =  $("#titleName").val();
        if(languageId == 0){
             $('.error1').show();
             $('#languageId').focus(); 
             $('#addDiv').show(); 
             return false;
        }
        else if(titlename == ''){
             $('.error1').show();
             $('#titleName').focus(); 
             $('#addDiv').show();
             return false;
        }else{
          $.ajax({
                type: 'POST',
                url: 'news/title/create',                  
                data: {language:  languageId, title: titlename},                               
                dataType:' json',
                async:false,
                error: function() { console.log("error"); },
                success: function(response) { 
                   if(response.status == 'Success'){                       //                       
                       $('#successMsg').text(response.msg);
                       $('.success').show();                                               
                        setTimeout(
                        function() 
                        {
                        $('.success').hide();     
                        hideaddiv();    
                        location.reload(true);   //do something special
                        }, 4000);
                        
                       
                   }else{
                         $('#addDiv').show();
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
    function deleteTitle(id,langId){
         $.ajax({
                type: 'POST',
                url: 'news/title/del',                  
                data: {id: id, langId:  langId},                               
                dataType:' json',
                async:false,
                error: function() { console.log("error"); },
                success: function(response) { 
                   if(response.status == 'Success'){
                       $('#successMsg').text(response.msg);//                       
                       $('.success').show();
                       setTimeout(
                        function() 
                       {   
                        location.reload(true);   //do something special
                       }, 3000); 
                       
                   }else{
                         $('#errorMsg').text(response.msg);
                         $('.error').show();
                   }
                
                 },
         });
    }