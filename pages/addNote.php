<?php
Session_start();

if (!isset( $_SESSION['auth'])){
    header('Location: ../login.php');
    exit();
}


include_once     "../include/ParseClassdown.php";
include_once     "../classes/class.Constants.php";
include_once     "../classes/db/class.Database.php";
include_once     "../classes/metier/paragraph.class.php";
include_once     "../classes/metier/blocknote.class.php";
include_once     "../classes/metier/theme.class.php";
include_once     "../classes/metier/note.class.php";

$db = new Database();
$p = new ParseClassedown();
$paragraph = new Paragraph($db->getInstance());
//$paragraph->fetch($_GET['id']);

$theme = new Theme($db->getInstance());
$block = new Blocknote($db->getInstance());
$note = new Note($db->getInstance());
$paragraph = new Paragraph($db->getInstance());

$user = $_SESSION['auth']->id;
$themes = $theme->getRows($user);


$action = isset($_GET['action']) ? isset($_GET['action']) : '';
$noteId = isset($_GET['noteId']) ? $_GET['noteId'] : '';;


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Code Reminder Encyclopédia</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/style5.css">
    <link rel="stylesheet" href="../css/note.css">
    <link rel="stylesheet" href="../css/app.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <span class="d-inline-flex p-3">
                <img src="../assets/logo-cre-yellow.svg" class="adminImgLogo mt-1" width="50" height="50" alt="Global notes Logo">
                <span class="mt-2">Code Encyclopédia</span>
            </span>

        </div>

        <ul class="list-unstyled components">
            <p></p>
            <?php foreach ($themes as $t) { ?>
                <li><p class="theme-list-label"><?= $t->label; ?></p>
                    <ul class="list-unstyled">
                        <?php
                        $blocks =  $block->getRows($user,$t->rowid);

                        foreach ($blocks as $b) {  ?>

                            <li><span><?= $b->label ?></span></li>

                            <ul class="list-unstyled">
                                <?php
                                $notes =  $note->getRows($user,$b->rowid);

                                foreach ($notes as $n) {  ?>
                                    <li class="ml-3"><a class="section-link" href="?action=viewNote&noteId=<?=$n->rowid ?>" title="<?=$n->label ?>"><?=$n->label ?></a></li>
                                <?php  } ?>
                            </ul>
                            </li>
                        <?php  } ?>
                    </ul>
                </li>
            <?php  } ?>

        </ul>

    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="signout.php">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php if (isset($action) && $action != '' && $action = "viewNote") {
            // var_dump($noteId);
            $markdown = new ParseClassedown();
            $Paragraphs = $paragraph->getRows($user,$noteId);
            ?>
            <div class="container">
                <?php
                foreach ($Paragraphs as $par){

                    print_r($markdown->text($par->content));
                }
                ?>
            </div>
        <?php  }else { ?>

            <section class="cover show "style="width:100%;">
                <div class="row mt-0">

                    <div class="d-inline-flex flex-row col-12 text-center mb-3 mt-5 border-2 rounded ">
                        <div class="mt-0">
                            <i class="fas fa-database small-icon text-light"></i>
                        </div>
                        <div class="ml-2 mt-3 vapor-2">
                            <h3>Add note</h3>
                        </div>

                    </div>
                    <hr class="hrVapor">
                </div>
                <div class="cover-main d-flex flex-column justify-content-end" >

                        <!-- SELECT THEME -->
                        <div class="form-group  d-inline-flex  p-2 m-3" >
                            <label for="selectTheme" class="mt-1">Thème</label>
                            <select id="selectTheme" name="selectTheme" class="form-control ml-5">
                                <option value="-1" >Select a theme</option>
                                <?php foreach ($themes as $th) { ?>
                                <option value="<?=$th->rowid; ?>"
                                    <?php
                                        if ( isset($_SESSION['NewNote']['idTheme'])
                                            && !empty($_SESSION['NewNote']['idTheme'])
                                            && $_SESSION['NewNote']['idTheme'] == $th->rowid ){?>
                                            selected
                                            <?php }  ?>
                                ><?=$th->label;?></option>

                                <?php }  ?>
                            </select>
                            <a id="addThemeBtn" class="nav-link" href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                        </div>
                        <div id="formTheme"> </div>

                        <!-- SELECT BLOCKNOTE -->
                        <div id="boxBlocknoteSelect" class="form-group  d-inline-flex  p-2 m-3" >
                            <label for="selectBlock" class="mt-1">Blocknote</label>
                            <select id="selectBlock" name="selectBlock" class="form-control ml-5">
                                <option value="-1" >Select a Blocknote</option>
                                <?php
                                if ( isset($_SESSION['NewNote']['idTheme']) && !empty($_SESSION['NewNote']['idTheme'])){
                                   $blocks  = $block->getRows($user,$_SESSION['NewNote']['idTheme']);
                                   var_dump($blocks);
                                      foreach ($blocks as $b) { ?>
                                          <option value=" <?=$b->rowid; ?>"
                                            <?php
                                                  if ( isset($_SESSION['NewNote']['idBlock']) && !empty($_SESSION['NewNote']['idBlock']) && $_SESSION['NewNote']['idBlock'] == $b->rowid ) { ?>
                                                        selected
                                                  <?php }  ?>
                                                  ><?=$b->label;?></option>
                                      <?php } }?>
                            </select>
                            <a id="addBlocknote" class="nav-link" href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                        </div>
                        <div id="formBlocknote"></div>
                        <hr>

                        <!-- SELECT NOTE -->
                        <div id="boxBlocknoteSelect" class="form-group d-inline-flex  p-2 m-3">
                            <label for="noteLabel" class="mt-1">Note</label>
                            <input type="text" class="form-control ml-5" id="noteLabel" aria-describedby="emailHelp" placeholder="Enter note label">

                        </div>
                         <nav>
                            <div class="nav nav-tabs ml-4 mt-2" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-create-tab" data-toggle="tab" href="#nav-create" role="tab" aria-controls="nav-create" aria-selected="true"><strong><i class="fa fa-file" aria-hidden="true"></i> Edit File</strong></a>
                                <a class="nav-link" id="nav-preview-tab" data-toggle="tab" href="#nav-preview" role="tab" aria-controls="nav-preview" aria-selected="false"><strong><i class="fa fa-eye" aria-hidden="true"></i> Preview changes</strong></a>
                                <a class="nav-link" id="nav-helper-tab" data-toggle="tab" href="#nav-helper" role="tab" aria-controls="nav-helper" aria-selected="false"><strong><i class="fa fa-info-circle" aria-hidden="true"></i> Helper syntaxes</strong></a>
                                
                            </div>
                        </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-create" role="tabpanel" aria-labelledby="nav-create-tab">
                                  
                                    <!-- PARAGRAPH -->
                                    <div class="form-group flex-md-column  p-2 m-3">   
                                        <?php include_once 'detailsMarkdown-tpl.php' ; ?>                                         
                                        <textarea id="paragraphNote" class="form-control" id="paragraph" rows="20" cols="20"></textarea>
                                        <div class="col-sm-12 mt-5 ml-3">
                                            <a id="NoteCteateBtn" class="btn btn-redCode">Créer Note</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="tab-pane fade" id="nav-preview" role="tabpanel" aria-labelledby="nav-preview-tab">
                                <div id="container-preview" class="preview">

                                </div>

                                </div>
                                <div class="tab-pane fade" id="nav-helper" role="tabpanel" aria-labelledby="nav-helper-tab">
                                  
                                    <div id="container-helper" class="preview">
                                           <?php 
                                             foreach($p::SELECTORS as $key => $s){
                                                 echo '<h6>' .$key .'   &nbsp;   ' . $s .'</h6>';
                                                 echo '<hr>';
                                             }
                                           ?>                 
                                    </div>                        
                                </div>
                            </div>
                        <hr>
                        <div class="form-group row p-4">
                            <div class="col-sm-12">
                              <!--  <a id="NoteCteateBtn" class="btn btn-redCode">Créer Note</a> -->
                            </div>
                            <div id="errorMsg" class="col-sm-12 mr-5">

                        </div>
                    </div>

                    </form>
                </div>

            </section>

        <?php  } ?>


    </div>

</div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(function () {
             $('[data-toggle="tooltip"]').tooltip()
        })    
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
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
        $(document).on("click","#NoteCteateBtn",function(e){


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
                    //$('#boxBlocknoteSelect').html(data);
                    
                    var json = JSON.parse(data);
                    console.log(json);
                    for(var key in json){
                         $('#container-preview').append(json[key]);
                         console.log(key + ' - ' + json[key])
                    }
                  
                    //$('#container-preview').html(data);
                    //console.log(data);

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
</script>
</body>

</html>

