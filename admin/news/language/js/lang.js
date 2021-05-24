    function showaddForm(){
             $('#addDiv').show();
             $('#listDiv').hide();
    }
    function hideaddiv(){
             $('#addDiv').hide();
             $('#listDiv').show();
    }
    function addlanguage(){
        var langname =  $("#languageName").val();
        if(langname == ''){
             $('.error1').show();
             $('#addDiv').show();
             return false;
        }else{
          $.ajax({
                type: 'POST',
                url: 'news/language/create',                  
                data: {languageName:  langname},                               
                dataType:' json',
                async:false,
                error: function() { console.log("error"); },
                success: function(response) { 
                    console.log(response.msg);
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
    function deleteLang(id){
         $.ajax({
                type: 'POST',
                url: 'news/language/del',                  
                data: {langId:  id},                               
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