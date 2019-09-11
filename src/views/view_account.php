<?php
session_start();
require "../../assets/functions/function.php";
require "../../bdd/connection.php";
require "../../assets/functions/arboresence/liste_arbo.php";
require "../../assets/functions/arboresence/liste_arbo_modal.php";

$user = $_SESSION['user_id'];

$pdo = connectDB();
$query =$pdo->prepare("
                        SELECT * 
                        FROM users LEFT JOIN bill ON  users.user_id = bill.users 
                        WHERE user_id= '".$user."'
                        ORDER BY `bill`.`bill_date` DESC");
$query->execute();
$profil_data = $query->fetchAll(PDO::FETCH_OBJ);

$user = $_SESSION["user_id"];
$folder = "../users/".$user;
$iter = new DirectoryIterator($folder);

//convertion des tailles de fichier
function sizeFile($size){
    $result = $size;
    for($i = 0; $i < 8 && $result >= 1024; $i++){
        $result = $result / 1024;
    }
    if($i > 0){
        return preg_replace('/,00$/', '', number_format($result, 2, ',', '')).' '.substr('kMGTPEZY',$i-1,1).'o';
    }else{
        return $result.' o';
    }
}

//data canvas
$max_size_user = (int)$profil_data[0]->storage_cloudPackage;
$max_size_user = (($max_size_user * 1024) * 1024) * 1024;

//calcule taille dossier
$size_folder = 0;
foreach($iter as $size_file){
    if(!$size_file->isDot()){  
        $size_folder += $size_file->getSize();
    }
}

//calcule ratio canvas
$ratio = ($size_folder / $max_size_user) * 100;
$ratio = round($ratio, 2);

//get user name
$_SESSION['user_name'] = $profil_data[0]->user_name;

?>

<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel='icon' type='image/png' sizes='32x20' href='assets/imgs/favicon/favicon-32x20.jpg'>
    <link rel='icon' type='image/png' sizes='16x10' href='assets/imgs/favicon/favicon-16x10.jpg'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../../assets/css/view_account.css">
    <title>View account</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script type="text/javascript" src="../../assets/js/dragdrop.js"></script>
    <script type="text/javascript" src="../../assets/js/modal.js"></script>

    <script type="text/javascript">
        jQuery(function($){
            $('.ZoneDeDrop').ZoneDeDrop();
        });
    </script>

</head>
<body>

<!--navigation-->
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white fixed-top">
        <a href="../../index.html" class="myBRAND"><img src="../../assets/imgs/logo_navbar.png" class="d-inline-block align-top" alt=""></a>
        <h5 class="my-0 mr-md-auto font-weight-normal"><strong>infinity cloud</strong></h5>
        <nav class="my-2 my-md-0">
            <a href="../../src/views/view_UPDATE_register.php" class="badge badge-light">
                <button type="button" class="btn_profil btn btn-outline-primary">
                    Hi, <?php echo $profil_data[0]->user_name ;?>
                    <img src="../../assets/imgs/Profil.jpg" class="d-inline-block align-top" alt="">
                </button>
            </a>
            <a href="../../assets/functions/logout.php" class="btn btn-outline-primary" >disconnect</a>
        </nav>
    </div>

    <div class="container-fluid">
            <div class="dashboard_title row">
                <div class="col-sm-4">
                    <h3>Dashboard</h3>
                    <a href="../../assets/functions/exportCSV.php" class="form-sublink">Log connexions</a>
                    <h4>Storage : <strong><?php echo $profil_data[0]->storage_cloudPackage ;?> GB</strong></h4>
                    <h7>Current package : <strong><?php echo $profil_data[0]->name_cloudPackage ;?></strong></h7>
                    <br>
                        <a href="../../src/views/view_update_SUBSCRIPTION.php"
                            class="form-sublink linkPackage"
                            data_packages = "<?php echo $profil_data[0]->name_cloudPackage ;?>" >change package ?</a>

                </div>
                <div class="col-sm-3">
                    <ul class="lliste">
                        <li><?php echo sizeFile($size_folder)." utilisés"; ?></li>
                        <li><?php $free = $max_size_user - $size_folder; echo sizeFile($free)." dispo"; ?></li>
                    </ul>
                </div>
                <div class="col-sm-5">
                    <input type="text"  name="round" class="round"
                                        data-min="0" data-max="<?php echo $max_size_user ?>"
                                        data-size="<?php echo $size_folder ?>" value="<?php echo $ratio."%"; ?>"
                                        data-color="#00BFFF"/>
                </div>

            </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal_window"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo list_dir_modal("../../src/users/".$user."/"); ?>

            </div>
            <div class="modal-footer">
                <span id="target_folder"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="modal_confirm" class="btn btn-primary" data-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!--end modal-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <h1><a href="" id="arbre">Files manager</a></h1>
                    <div class="alert alert-danger" role="alert">

                        Refresh de page
                    </div>
                    <section class="listArray">
                        <?php echo list_dir("../../src/users/".$user."/"); ?>
                    </section>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <h1>Drop zone</h1>
                    <div class="dropzone">
                        <div class="bloc">
                            <div>
                                <div class="ZoneDeDrop" style="width:100%!important; " data-folder="uploads">
                                    <span class="nfo">Drop the file HERE...</span>
                                </div>
                                <div class="cb"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->



<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="../../assets/js/canvas.js"></script>
<script type="text/javascript" src="../../assets/js/delete_link_package.js"></script>
<script type="text/javascript" src="../../assets/js/deleteFile.js"></script>
<script type="text/javascript" src="../../assets/js/ContextMenu.js"></script>
<script type="text/javascript" src="../../assets/js/arbeo.js"></script>



</body>
</html>