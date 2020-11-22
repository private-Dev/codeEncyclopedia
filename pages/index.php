<?php 
    include_once 'top.php';
?>
<?php
    
    $msgStatus = isset($_GET['msgStatus']) ? $_GET['msgStatus'] : '';

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


    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC ';
    $field = isset($_GET['field']) ? $_GET['field'] : null;
   
    //var_dump($_POST);
    //var_dump($_GET);

    $labelNote      =   isset($_POST['labelNote']) ? $_POST['labelNote'] : null;
    $labelTheme     =   isset($_POST['labelTheme']) ? $_POST['labelTheme'] : null;
    $labelBlocknote =   isset($_POST['labelBlocknote']) ? $_POST['labelBlocknote'] : null;
    $created        =   isset($_POST['created']) ? $_POST['created'] : null;
    $updated        =   isset($_POST['updated']) ? $_POST['updated'] : null;



    include_once     "../classes/class.Constants.php";
    include_once     "../classes/db/class.Database.php";
    include_once     "../classes/metier/paragraph.class.php";

    $db = new Database();
    

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
            
    $sqlFrom =" FROM paragraph p ";
    $sqlFrom .=" INNER JOIN note n ON p.fk_note = n.id";
    $sqlFrom .=" INNER JOIN blocknote b ON n.fk_blocknote = b.id";
    $sqlFrom .=" INNER JOIN theme t ON b.fk_theme = t.id";

    $sqlWhere =" WHERE 1 = 1 ";

    if (!empty($labelNote)){
        $sqlWhere .=" AND n.label  LIKE '%".$labelNote."%' ";
    }

   


    if (!empty($labelTheme)){
        $sqlWhere .=" AND t.label  LIKE '%".$labelTheme."%' ";
    }
   
    if (!empty($labelBlocknote)){
        $sqlWhere .=" AND b.label  LIKE '%".$labelBlocknote."%' ";
    }

$sqlOrder = ' ';
    if (!is_null($field)){
        $sqlOrder =" ORDER BY ". $field . ' '. $order ;

    }
    

    $sqlLimit = " ";

    $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlOrder . $sqlLimit ;
    //var_dump($sql);
    $stmt = $db->getInstance()->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
 ?> 
           <form  action="" method="POST">   
           <section class="Liste">
           <container>
               <table style="width:100%;">
                <thead>
                    <tr>
                        <th>
                           <div class="d-flex flex-column" >  
                            <input type="text" name="labelNote" value="<?= isset($labelNote) ? $labelNote : '' ?>">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    Note
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=labelNote" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?field=labelNote" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>

                           </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                                <input type="text" value="<?= isset($labelTheme) ? $labelTheme : '' ?>" name="labelTheme" >
                                <div class="d-flex flex-row justify-content-between p-2">
                                    Thème
                                    <div class="d-flex flex-column smallArrow p-2">
                                   
                                            <a href="index.php?order=DESC&field=labelTheme">
                                       
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?field=labelTheme" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                        </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                            <input type="text" value="<?= isset($labelBlocknote) ? $labelBlocknote : '' ?>" name="labelBlocknote">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    Blocknote
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=labelBlocknote" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?field=labelBlocknote" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                            </div>
                        </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                            <input type="date">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    created
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=date_created" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?field=date_created" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                            </div>
                        </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                            <input type="date">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    updated 
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=date_update" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?field=date_update" >
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    </div>
                            </div>
                        </div>
                        </th>
                        <th>
                        <div class="d-flex flex-column" >  
                            <input type="text">
                            <div class="d-flex flex-row justify-content-between p-2">
                                    Content
                                    <div class="d-flex flex-column smallArrow p-2">
                                        <a href="index.php?order=DESC&field=text" >
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>
                                        <a href="index.php?field=text" >
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

           


        </div>

</div>



<?php 
    include_once 'bottom.php';
?>



















