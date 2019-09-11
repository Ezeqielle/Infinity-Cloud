<?php
session_start();
require "../../bdd/connection.php";

$logError = "";

//est ce que j'ai un email dans $_POST
if(count($_POST) == 2 && !empty($_POST["email"])){
//SI oui
    $email = $_POST["email"];
    $_SESSION['email'] = $email;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
        $error = true;
        $listOfErrors[] = "L'email n'est pas valide";
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
            $pwd = "1452faze789fazef41352fnjendhferkd5198sleod";
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $query = $pdo->prepare("UPDATE users SET password = '".$pwd."' WHERE email = '".$email."'");
            //execute
            $query->execute();

            header("Location: ../../src/views/view_new_password.php");
        }
    }
}


?>
