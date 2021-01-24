<?php 
    include_once 'top.php';
    include_once     "../classes/class.Constants.php";
    include_once     "../classes/db/class.Database.php";
    include_once     "../classes/metier/paragraph.class.php";
?>

<?php

    /** *************************************************************************
     *
     * PROCESS MODE
     *
     ************************************************************************* */

    $msgStatus              = Util::GETPOST('msgStatus');
    $order                  = Util::GETPOST('order');
    $field                  = Util::GETPOST('field');
    $searchlabelNote        = Util::GETPOST('searchlabelNote');
    $searchlabelTheme       = Util::GETPOST('searchlabelTheme');
    $searchLabelBlocknote   = Util::GETPOST('searchLabelBlocknote');
    $searchCreated          = Util::GETPOST('searchCreated','date');
    $searchUpdated          = Util::GETPOST('searchUpdated','date');
    $searchContent          = Util::GETPOST('searchContent');
    $limit                  = Util::GETPOST('limit');


    $msg="";
    if ($msgStatus == 'deletedNote'){
            $msg = 'Note supprimée';
    }
    if ($msgStatus == 'createdNote'){
        $msg = 'Note créée';
    }
    if ($msgStatus == 'updateNote'){
        $msg = 'Modifications effectuées';
    }
    if ($msgStatus){
        print_r('<div class="alert alert-success" role="alert">'.$msg.'</div>');
    }


    //SQL CONSTRUCT SEARCH --------------------------------------------------------
    //-----------------------------------------------------------------------------
    $db = new Database();
    //-----FIELDS------------------------------------------------
    $sqlSelect =" SELECT ";
    $sqlSelect .=" t.id AS idtheme, ";
    $sqlSelect .=" t.label AS labelTheme,";
    $sqlSelect .=" b.id AS idblocknote,";
    $sqlSelect .=" b.label AS labelBlocknote,";
    $sqlSelect .=" n.id AS idnote,";
    $sqlSelect .=" n.label AS labelNote,";
    $sqlSelect .=" p.date_created,";
    $sqlSelect .=" p.date_update,";
    $sqlSelect .=" n.toolTipMsg,";
    $sqlSelect .=" p.content_tagless AS text";
    //-----FROM------------------------------------------------
    $sqlFrom =" FROM paragraph p ";
    $sqlFrom .=" INNER JOIN note n ON p.fk_note = n.id";
    $sqlFrom .=" INNER JOIN blocknote b ON n.fk_blocknote = b.id";
    $sqlFrom .=" INNER JOIN theme t ON b.fk_theme = t.id";
    //-----WHERE------------------------------------------------
    $sqlWhere =" WHERE 1 = 1 ";

    if (!empty($searchlabelNote)){
        $sqlWhere .=" AND n.label  LIKE '%".$searchlabelNote."%' ";
    }
    if (!empty($searchlabelTheme)){
        $sqlWhere .=" AND t.label  LIKE '%".$searchlabelTheme."%' ";
    }
    if (!empty($searchLabelBlocknote)){
        $sqlWhere .=" AND b.label  LIKE '%".$searchLabelBlocknote."%' ";
    }
    if (!empty($searchContent)){
        $sqlWhere .=" AND p.content_tagless  LIKE '%".$searchContent."%' ";
    }
    //@todo ajouter date debut date fin
    if (!empty($searchCreated)){
        $sqlWhere .=" AND p.date_created  >= '".$searchCreated."'";
    }
    //@todo ajouter date debut date fin
    if (!empty($searchUpdated)){
        $sqlWhere .=" AND p.date_update  >= '".$searchUpdated."'";
    }
    //-----ORDER BY ------------------------------------------------
    $sqlOrder = ' ';
    if (!is_null($field)){
        $sqlOrder =" ORDER BY ". $field . ' '. $order ;
    }
    //-----LIMIT------------------------------------------------
    $sqlLimit = (!empty($limit)) ? " LIMIT ".$limit : "";

    $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlOrder . $sqlLimit ;
    //-----------------------------------------------------------------------------
    //-----------------------------------------------------------------------------

   // print_r($sql);
    $stmt = $db->getInstance()->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();


    // search get construction

    $SearchMemory = '';
    isset($searchlabelNote)         ? $SearchMemory  =  '&searchlabelNote='.$searchlabelNote : '';
    isset($searchlabelTheme)        ? $SearchMemory .=  '&searchlabelTheme='.$searchlabelTheme : '';
    isset($searchlabelBlocknote)    ? $SearchMemory .=  '&searchlabelBlocknote ='.$searchlabelBlocknote : '';
    isset($searchCreated)           ? $SearchMemory .=  '&searchCreated ='.$searchCreated : '';
    isset($searchUpdated)           ? $SearchMemory .=  '&searchUpdated ='.$searchUpdated : '';
    isset($searchContent)           ? $SearchMemory .=  '&searchContent ='.$searchContent : '';


/**
 *
 * VIEW MODE
 *
 */
//@TODO ADD PAGINATION PROCESS
 ?> 
           <form  action="" method="POST" >
           <section class="float-right mb-1">

            <select name="limit" id="limit">
                    <option value="5" selected>5</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                    <option value="5000">5000</option>
                </select>  
           </section>    
           <section class="Liste">
           <container>
               <table style="width:100%;">
                <thead>
                    <tr>
                        <th>
                           <div class="d-flex flex-column" >  
                            <input type="text" name="searchlabelNote" value="<?= isset($searchlabelNote) ? $searchlabelNote : '' ?>">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    Note
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=labelNote<?=$SearchMemory;?>" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?order=ASC&field=labelNote<?=$SearchMemory;?>" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>

                           </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                                <input type="text" value="<?= isset($searchlabelTheme) ? $searchlabelTheme : '' ?>" name="searchlabelTheme" >
                                <div class="d-flex flex-row justify-content-between p-2">
                                    Thème
                                    <div class="d-flex flex-column smallArrow p-2">
                                   
                                            <a href="index.php?order=DESC&field=labelTheme<?=$SearchMemory;?>">
                                       
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?order=ASC&field=labelTheme<?=$SearchMemory;?>" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                        </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                            <input type="text" value="<?= isset($labelBlocknote) ? $labelBlocknote : '' ?>" name="searchLabelBlocknote">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    Blocknote
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=labelBlocknote<?=$SearchMemory?>" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?order=ASC&field=labelBlocknote<?=$SearchMemory?>" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                            </div>
                        </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                            <input type="date" name="searchCreated" value="<?=isset($searchCreated) ? $searchCreated : '' ?>">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    created
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=date_created<?=$SearchMemory?>" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?order=ASC&field=date_created<?=$SearchMemory?>" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                            </div>
                        </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                            <input type="date" name="searchUpdated" value="<?=isset($searchUpdated) ? $searchUpdated : '' ?>">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    updated 
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=date_update<?=$SearchMemory?>" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?order=ASC&field=date_update<?=$SearchMemory?>" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                            </div>
                        </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                            <input type="text" name="searchContent" value="<?= isset($searchContent) ? $searchContent : '' ?>">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    Content
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=text<?=$SearchMemory?>" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?order=DESC&field=text<?=$SearchMemory?>" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                            </div>
                        </div>
                        </th>
                        
                        <th>
                        <div class="d-flex flex-column" >  
                            <div class="d-flex flex-row justify-content-between mb-5">
                                <button type="submit" class="btn">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="d-flex flex-column smallArrow p-2">

                                <a href="index.php?reset=all">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>

                            </div>
                        
                            
                        </div>
                        </th>

                    </tr>
                </thead>
                <tbody>
                   <?php foreach($rows as $r)  {   ?> 
                    <tr>
                        
                        <td style="display:flex; content:start"> 
                                <a class="section-link ml-2" href="addNote.php?action=<?=Constant::$VIEWNOTE?>&noteId=<?=$r->idnote?>&blocknoteId=<?=$r->idblocknote?>&themeId=<?=$r->idtheme?>">
                            
                                    <i class="fa fa-tag mr-2" aria-hidden="true"></i>
                                    <?=$r->labelNote?>
                                </a>
                        </td>
                        <td><?=$r->labelTheme?></td>
                        <td><?=$r->labelBlocknote?></td>
                        <td><?=$r->date_created?></td>
                        <td><?=$r->date_update?></td>
                        <td><?=substr($r->text,0,200) . "..." ?></td>
                        <td></td> 
                    </tr>
                   <?php } ?>
                </table>
            </container>
            </section>

            <section class="cover show">
                <div class="mask"></div>
                <div class="cover-main d-flex justify-content-center card-img-top">
                    <p class="" >
                        <img src="../assets/cre-black.svg" data-origin="_media/icon.svg" alt="logo">
                    </p>
                </div>
            </section>

           


        </form>

</div>



<?php 
    include_once 'bottom.php';
?>



















