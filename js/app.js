
$(document).ready(function(){
    console.log('working fine');


    $(document).on("click",".contenant",function() {});


//-- ADD THEME -------------------------------------------------
    $(document).on("click","#addTheme",function(e) {
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
                url:'../scripts/interface.php',
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



//-- ADD BLOCKNOTE -------------------------------------------------
$(document).on("click","#addBlocknote",function(e) {
   
    e.preventDefault();

    $.ajax({
        url : "../templates/blocknote/FormCreateBlocknote.tpl.php",
        cache:false
    })
        .done(function(html){
            $("#formBlocknote").html(html);
        })
        .fail(function(data){})
        .always(function(data){})
        
    return false;
 });

$(document).on("click",".A-create-Blocknote",function(e){
      

    if ($("#label").val() === ''){
        $('#labelAlert').css('display','block')
    }else{

        data = {
            label   : $("#label").val(),
            tooltip : $("#tooltip").val(),
            fktheme : $(this).attr('data-fktheme'),
            action  :'addblocknote' 

        };  
      
        $.ajax({
            url:'../scripts/interface.php',
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
$(document).on("click","#addnote",function(e) {
   
    e.preventDefault();

    $.ajax({
        url : "../templates/note/FormCreateNote.tpl.php",
        cache:false
    })
        .done(function(html){
            $("#formNote").html(html);
        })
        .fail(function(data){})
        .always(function(data){})
        
    return false;
 });

//-- ADD NOTE -------------------------------------------------
//-- --- -- --------------------------------------------




    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
});
