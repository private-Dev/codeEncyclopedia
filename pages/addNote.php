<?php
include_once 'top.php';
?>
    
        <!--    VIEW MODE          -->    
        <?php if (isset($action) && $action != '' && $action = "viewNote") {
            // var_dump($noteId);
            ?>
            <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="float-right">
                        <a class="btn edit-btn"><i class="fa fa-address-book" aria-hidden="true"></i></a>
                        <a class="btn delete-btn"><i class="fa fa-times" aria-hidden="true"></i></a>
                    </div>
                </div>    
            </div>
            <?php
            $markdown = new ParseClassedown();
            $Paragraphs = $paragraph->getRows($user,$noteId);
            ?>
            <div class="row">
                <div class="col-sm">
                <?php
                foreach ($Paragraphs as $par){
                    print_r($markdown->text($par->content));
                }
                ?>
                </div></div>
            </div>
        <!--    EDIT MODE          -->    

        <!--    CREATE MODE        -->
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

<?php 
    include_once 'bottom.php';
?>

