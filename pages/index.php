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



















