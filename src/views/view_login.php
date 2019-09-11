<?php

session_start();
require "../../assets/functions/function.php";
require "../../bdd/connection.php";

if (isConnected())
{
    header("location: view_account.php");
}

$logError = "";

//est ce que j'ai un email un mot de passe dans $_POST
if(count($_POST) == 3 && !empty($_POST["email"]) && !empty($_POST["password"])){
//SI oui
    //connexion à la bdd
    $pdo = connectDB();
    //"SELECT password FROM n2p_users WHERE email=:email"
    $queryPrepare = $pdo->prepare("SELECT user_id, email, password, statut FROM users WHERE email=:email");
    //execute
    $queryPrepare->execute([":email" => strtolower($_POST['email'])]);
    //fetch
    $result = $queryPrepare->fetch();
    //SI password non vide alors


    if (!empty($result["password"]) && password_verify($_POST["password"], $result["password"]))
    {
        //password _verify
        //SI oui -> Afficher OK
        if ($result["statut"] != 1)
        {
            //$result = ["id"=>"3", "email"=>"xxxxxx@xxxxx.xxx", "password"=>"xxx"]
            login($result);

            header("Location: view_account.php");
        }
        else
        {
            $logError =  "<div class='alert alert-danger'>ce compte a été banni</div>";
        }

        //SI non -> Afficher dans une alerte rouge "identifiants incorrects
    } else {
        $logError =  "<div class='alert alert-danger'>identifiants incorrects</div>";

        //A travers une fonction (writeLog) écrivez dans un fichier txt à la racine du projet la combinaison email et mdp dedans Attention si le fichier txt n'existe pas il doi se créer automatiquement et une écriture ne doit pas écraser ce qu'il y avait avant.
        writeLog($_POST['email']." ---> ".$_POST['password']."\r\n","logFailed.txt");
    }

}

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

    <link rel="stylesheet" href="../../assets/css/view_login.css">
    <title>infinity drive</title>

</head>
<body>

<?php

if(isset($_SESSION["errors"])){
    echo "<div class='alert alert-danger'>";
    foreach ($_SESSION["errors"] as $error) {
        echo "<li>".$error."</li>";
    }
    echo "</div>";
}
?>

<!--navigation-->
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow fixed-top">
    <a href="../../index.html" class="myBRAND"><img src="../../assets/imgs/logo_navbar.png" class="d-inline-block align-top" alt=""></a>
    <h5 class="my-0 mr-md-auto font-weight-normal"><strong>infinity cloud</strong></h5>
</div>

<!--contenu-->
<!--<span class="required">*</span></label>-->
<div class="container">

    <div class="row">

        <div class="container container--xs">

            <div id="signup_div_wrapper">
                <img class="logo_form img-fluid mx-auto d-block mb-3" src="../../assets/imgs/Logo_index.png" width="300" height="191">
                <h1 class="mb-1 text-center">Sign in</h1>

                <!--FORMULAIRE-->
                <form class="user" method="POST" action="" autocomplete="off">
                    <form>
                        <div class="form-row">
                            <!--email-->
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email<span class="required">*</span></label>
                                <input type="email" id="exampleInputEmail"
                                       class="form-control form-control-user"
                                       placeholder="Email address"
                                       required="required"
                                       autofocus="autofocus" name="email">
                            </div>
                            <!--PASSWORD 8 caractères - 1 majuscule - 1 chiffre-->
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Password <span class="pswd">(8 characters 1 number 1 uppercase)<span class="required">*</span></label>
                                <a href="view_forgot_password.php" class="form-sublink">Forgot password?</a>
                                <input type="password" id="exampleInputPassword"
                                       class="form-control form-control-user"
                                       placeholder="Password"
                                       required="required"
                                       name="password"
                                       autocomplete="off">
                            </div>
                        </div><!-- end flow-row -->

                        <button type="submit" class="btn btn-success col-md-12" name="valid">Sign up</button>
                    </form>

                </form>
                <p class="text-gray-soft text-center small mb-2">Already have an account? <a href="view_register.php">Sign up</a></p>

            </div><!--end wraper-->

        </div><!-- end containerXS---->
    </div><!--end row-->





</div><!--end container-->




















<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script