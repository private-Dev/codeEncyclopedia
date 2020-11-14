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
    

 ?> 

   

            <?php if (isset($action) && $action != '' && $action = "viewNote") {

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

            <section class="cover show">
                <div class="mask"></div>
                <div class="cover-main d-flex justify-content-center">
                    <p>
                        <img src="../assets/cre-black.svg" data-origin="_media/icon.svg" alt="logo">
                    </p>
                    <h1 id="">
                            <span><small>1.1.0</small></span>
                    </h1>


                </div>
            </section>

            <?php  } ?>


        </div>

</div>


<?php 
    include_once 'bottom.php';
?>



















