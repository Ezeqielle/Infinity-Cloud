<?php 
session_start();
require "../../bdd/connection.php";

$logError = "";

$email = $_SESSION['email'];
//est ce que j'ai un password dans $_POST
if(count($_POST) == 3 && !empty($_POST["inputPassword"]) && !empty($_POST["confirmPassword"])){
//SI oui
    $email = $_SESSION['email'];
    $pwd = $_POST["inputPassword"];
    $pwdConfirm = $_POST["confirmPassword"];
    if( $pwd != $pwdConfirm){
        $error = true;
        $listOfErrors[] = "Le mot de passe de confirmation ne correspond pas";
    }else if(!$error){
        $pdo = connectDB();
        $query = "SELECT user_id FROM users WHERE email = '".$email."'";
        $queryPrepared = $pdo->prepare($query);
        $queryPrepared->execute();
        $result = $queryPrepared->fetch();
        if(empty($result)){
            $error = true;
            $listOfErrors[] = "L'email n'existe pas";
        }else{
            //connexion à la bdd
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $query = $pdo->prepare("UPDATE users SET password = '".$pwd."' WHERE email = '".$email."'");
            //execute
            $query->execute();
            header("Location: view_login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <title>New Password</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<body>
    

<h2>Setup your password</h2>
<form class="user" method="POST" action="">
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-label-group">
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required">
                    <label for="inputPassword">Password</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-label-group">
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                    <label for="confirmPassword">Confirm password</label>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-warning btn-user btn-block" name="update" value="Update">
    </div>
</form>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>