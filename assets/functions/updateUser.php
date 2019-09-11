<?php
session_start();
require "../../bdd/connection.php";
require "function.php";

//S'assurer que l'on a bien reçu 5 valeurs
//Vérifier que les champs ne soient pas vides
print_r($_POST);


if( count($_POST) == 6
 && !empty($_POST["user_id"])
 && !empty($_POST["username"]) 
 && !empty($_POST["phone"]) 
 && !empty($_POST["inputEmail"]) 
 && !empty($_POST["inputPassword"]) 
 && !empty($_POST["confirmPassword"])){


    //Nettoyer les champs
    $user = $_POST["user_id"];
	$username = ucwords(strtolower(trim($_POST["username"])));
	$phone = $_POST["phone"];
	$email = strtolower(trim($_POST["inputEmail"]));
	$pwd = $_POST["inputPassword"];
	$pwdConfirm = $_POST["confirmPassword"];

	//Vérification des champs

	$error = false;
	$listOfErrors = [];

	//firstName : entre 2 et 50
	if(strlen($username)<2 || strlen($username)>50){
		$error = true;
		$listOfErrors[] = "Le prenom doit faire entre 2 et 50 caractères";
	}

	//pwd : entre 8 et 25
	// -> majuscules, minuscules et chiffres
	if(strlen($pwd)<8 
		|| strlen($pwd)>25
		|| !preg_match("#[a-z]#", $pwd)
		|| !preg_match("#[0-9]#", $pwd)
		|| !preg_match("#[A-Z]#", $pwd)){
		$error = true;
		$listOfErrors[] = "Le mot de passe doit faire entre 8 et 25 caractères avec des minuscules, des majuscules et des chiffres";
	}


	//pwdConfirm : correspond à pwd
	if( $pwd != $pwdConfirm){
		$error = true;
		$listOfErrors[] = "Le mot de passe de confirmation ne correspond pas";
    }

    //email : format valide
    if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
        $error = true;
        $listOfErrors[] = "L'email n'est pas valide";
    }else if(!$error){
        $pdo = connectDB();
        $query = "SELECT user_id FROM users WHERE email = :email";
        $queryPrepared = $pdo->prepare($query);
        $queryPrepared->execute([":email"=>$email]);
        $result = $queryPrepared->fetch();
        if($result["user_id"] == $user){
        }else{
            $error = true;
            $listOfErrors[] = "L'email existe déjà";
        }
    }

	//if($error == true){
	if($error){
		
		unset($_POST["inputPassword"]);
		unset($_POST["confirmPassword"]);

		$_SESSION["errors"] = $listOfErrors;
		$_SESSION["errorsInput"] = $_POST;

		//Redirection register.php avec les messages d'erreurs
		header("Location: ../../src/views/view_UPDATE_register.php");

	}else{

        //Tentative de connection à la bdd
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $query = "UPDATE users SET
        user_name = '".$username."', phone_number = '".$phone."', email = '".$email."', password = '".$pwd."'
		WHERE
        user_id = '".$user."'";

        $queryPrepared = $pdo->prepare($query);
		$queryPrepared->execute();

		header('Location: ../../src/views/view_account.php');
    }

}else{
	die("Tentative de Hack .... !!!!");
}