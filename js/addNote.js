$(document).ready(function () {
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
   })   
   
   
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
   
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });

    

   // REDIRECTION LOGO
   $(document).on('click', '.markk', function() {
        var addr = "index.php";
        $(location).attr("href", addr);   
   });
    //-- SELECT THEME -> HYDRATE BLOCKNOTE SELECT ---------
    $('#selectTheme').on('change', function() {
        data = {
            idTheme   : this.value,
            action  :'selectChangeTheme'
        };
        $.ajax({
            url:'../scripts/interface_select_blocknote.php',
            type:'POST',
            data : data,
            datatype :'json',
            success :function(data){
                $('#boxBlocknoteSelect').html(data);
            }
        });
    });

    //-- ADD THEME -------------------------------------------------
    $(document).on("click","#addThemeBtn",function(e){

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
        console.log('je creer un theme');
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


    //-- BLOCK CHANGE ------------------------------------------------
    $(document).on('click', '#selectBlock', function() {

        data = {
            idBlock   : this.value,
            action  :'selectChangeBlock'
        };
        $.ajax({
            url:'../scripts/interface_changeIdBlockSelectedSession.php',
            type:'POST',
            data : data,
            datatype :'json',
            success :function(data){
                //$('#boxBlocknoteSelect').html(data);
            }
        });
        console.log(this.value);

        /*
            on call un akax pour remplir la session Note idBlock
         */
    });
    //-- ADD BLOCKNOTE -------------------------------------------------
    $(document).on("click","#addBlocknote",function(e) {

        e.preventDefault();
        if ($("#selectTheme").val() > -1 ){
            $.ajax({
                url: "../templates/blocknote/FormCreateBlocknote.tpl.php",
                cache: false
            })
                .done(function (html) {
                    $("#formBlocknote").html(html);
                })
                .fail(function (data) {
                })
                .always(function (data) {
                })
        }else{
            $("#formBlocknote").html('<div class="alert alert-warning" role="alert">Select first a Theme to be affected to your blocknote. </div>');
        }
        return false;
    });
    //-- ADD action BLOCKNOTE -------------------------------------------------
    $(document).on("click",".A-create-Blocknote",function(e){


        if ( $("#label").val() === '' &&  ($("#selectTheme").val() > -1) ){
            $('#labelAlert').css('display','block')
        }else{

            data = {
                label   : $("#label").val(),
                tooltip : $("#tooltip").val(),
                fktheme : $("#selectTheme").val(),
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
    });

    //-- CREATE NOTE -------------------------------------------------
    $(document).on("click","#NoteCreateBtn",function(e){


        if ( ( $("#selectTheme").val() > -1 && $("#selectTheme").val() != '' )
            && ( $("#selectBlock").val() > -1 && $("#selectBlock").val() != '' )
            && $('#noteLabel').val() != ''
            && $('#paragraphNote').val()){

            data = {
                fktheme   : $("#selectTheme").val(),
                fkblocknote : $("#selectBlock").val(),
                notelabel : $('#noteLabel').val(),
                paragraph :$('#paragraphNote').val(),
                action  :'addnote'
            }
            $.ajax({
                url:'../scripts/interface_addParagraphToNote.php',
                type:'POST',
                data : data,
                datatype :'json',
                success :function(data){
                    var json = JSON.parse(data);
                    var addr = "../index.php?action=viewNote&noteId=" + json.id;
                    $(location).attr("href", addr);   
                }
            });
        } else{
            err ='';
            if ($("#selectTheme").val() < 0){
              err +=  '<div class="alert alert-danger" role="alert">Select Theme </div>'
            }
            if ($("#selectBlock").val() < 0){
                err +=  '<div class="alert alert-danger" role="alert">Select BlockNote </div>'
            }
            if ($("#noteLabel").val() == ''){
                err +=  '<div class="alert alert-danger" role="alert">no empty Note Label  </div>'
            }
            if ($("#paragraphNote").val() == ''){
                err +=  '<div class="alert alert-danger" role="alert">no empty Paragraph  </div>'
            }
            $('#errorMsg').css('display','block');
            $('#errorMsg').html(err);
            $('#errorMsg').fadeOut(8300, "linear")
        }
    })

    // DELETE NOTE BTN  ACTION
    $(document).on("click","#confirmDeleteNote",function(e){

        console.log();

        
        data = {
            idNote   : $('#confirmDeleteNote').attr('data-noteid'),
            action  :'deleteNote'
        };
        $.ajax({
            url:'../scripts/interface.php',
            type:'POST',
            data : data,
            datatype :'json',
            success :function(data){
                $('#confirmModalDeleteNote').modal('hide');
                var addr = "../pages/index.php?msgStatus=deletedNote";
                $(location).attr("href", addr);   
                
            }
        });

        


    });
    // --- PREVIEW FILE 
    $(document).on("click","#nav-preview-tab",function(e){
        $('#container-preview').html('');
       // console.log($('#paragraphNote').val());
        data = {
            content   : $('#paragraphNote').val(),
            action  :'previewNote'
        };   
        $.ajax({
            url:'../scripts/interface.php',
            type:'POST',
            data : data,
            datatype :'json',
            success :function(data){ 
                var json = JSON.parse(data);
                console.log(json);
                for(var key in json){
                     $('#container-preview').append(json[key]);
                     console.log(key + ' - ' + json[key])
                }
            }
        });    
    }); 

     // --- BTN HELPER TAG MARKDOWN 

    //-- HEADER H1
    $(document).on("click","#h-btn",function(e){
          $('#paragraphNote').val ($('#paragraphNote').val() +  "#");     
    });

    $(document).on("click","#p-standard-btn",function(e){
          $('#paragraphNote').val ($('#paragraphNote').val() +  "! your content !/");     
    });

    $(document).on("click","#code-btn",function(e){
          $('#paragraphNote').val ($('#paragraphNote').val() +  ": {{code-s}}\n");
          $('#paragraphNote').val ($('#paragraphNote').val() +  "console.log(your code)\n");    
          $('#paragraphNote').val ($('#paragraphNote').val() +  ":/");         
    });

    $(document).on("click","#hash-btn",function(e){
          $('#paragraphNote').val ($('#paragraphNote').val() +  "! your content {{hash}}\n"); 
                 
          $('#paragraphNote').val ($('#paragraphNote').val() +  "!/");     
    });

    $(document).on("click","#p-alert-btn",function(e){
          $('#paragraphNote').val ($('#paragraphNote').val() +  "!! important !!/");     
    });

    $(document).on("click","#p-warning-btn",function(e){
          $('#paragraphNote').val ($('#paragraphNote').val() +  "&& warning &&/");     
    });

    $(document).on("click","#quote-btn",function(e){
          $('#paragraphNote').val ($('#paragraphNote').val() +  ">  your quote >/");     
    });
    


});

