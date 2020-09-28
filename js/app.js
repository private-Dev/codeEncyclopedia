
$(document).ready(function(){
    console.log('working fine');


    $(document).on("click",".contenant",function() {});


//-- ADD THEME -------------------------------------------------
    $(document).on("click",".addElement",function(e) {
        console.log("want to add ? ");
        e.preventDefault();
    
        $.ajax({
            url : "../templates/theme/FormCreateTheme.tpl.php",
            cache:false
        })
            .done(function(html){
                $("#formTheme").html(html);
            })
            .fail(function(data){})
            .always(function(data){})
            
        return false;
     });

    $(document).on("click",".A-create-Theme",function(e){
           self = $(this);
           
           if ($("#label").val() === ''){
            $('#labelAlert').css('display','block')
        }else{

            data = {
                label   : $("#label").val(),
                tooltip : $("#tooltip").val(),
                action  :'addTheme'    
            };  
          
            $.ajax({
                url:'../scripts/interface_theme.php',
                type:'POST',
                data : data,
                datatype :'json',
                success :function(data){
                    location.reload();
                }
            });
        }

            
            
    })

//-- ADD THEME END -------------------------------------------------


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
});
