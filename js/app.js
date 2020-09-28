
$(document).ready(function(){
    console.log('working fine');


    $(document).on("click",".contenant",function() {
        //alert("click bound to document listening for .contenant");
    });

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

   




    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
});
