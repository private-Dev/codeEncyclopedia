
$(document).ready(function(){
    console.log('working fine');


    $(document).on("click",".contenant",function() {
        //alert("click bound to document listening for .contenant");
    });

    $(document).on("click",".addElement",function() {
        console.log("want to add ? ");
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
});
