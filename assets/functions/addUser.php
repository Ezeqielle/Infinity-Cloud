<?php
session_start();

require "function.php";
require "../../bdd/connection.php";

//S'assurer que l'on a bien reçu 5 valeurs
//Vérifier que les champs ne soient pas vides
print_r($_POST);


if( count($_POST) == 5
 && !empty($_POST["username"]) 
 && !empty($_POST["phone"]) 
 && !empty($_POST["inputEmail"]) 
 && !empty($_POST["inputPassword"]) 
 && !empty($_POST["confirmPassword"]) 
 /*&& !empty($_POST["captcha"])*/){


	//Nettoyer les champs
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


	//captcha valide : format valide
	/*if( $_SESSION["captcha"] == $_POST["captcha"] ){
		$error = true;
		$listOfErrors[] = "Le captcha n'est pas correct";
    } */


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
        if(!empty($result)){
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
		header("Location: ../../src/views/view_register.php");
		

	}else{

		//Tentative de connection à la bdd

		$query = "INSERT INTO users
		(user_name, phone_number, email, password)
		VALUES
        (:username,:phone,:email,:pwd)";
        
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

		$queryPrepared = $pdo->prepare($query);

		$queryPrepared->bindParam(':username',$username);
        $queryPrepared->bindParam(':phone',$phone);
        $queryPrepared->bindParam(':email',$email);
        $queryPrepared->bindParam(':pwd',$pwd);
        $queryPrepared->execute();

        $lastId = $pdo->lastInsertId();
        addFolder($lastId);

        //selection des données du forfait free
        $query = $pdo->prepare("SELECT * FROM subscription WHERE id_subscription = '1'");
        $query->execute();
        $query_data = $query->fetchAll(PDO::FETCH_OBJ);
        $name_storage = $query_data[0]->name_subscription;
        $capacity_storage = $query_data[0]->storage;
        $cost_storage = $query_data[0]->cost;

        $query = "INSERT INTO `bill` (`users`, `name_cloudPackage`, `storage_cloudPackage`, `cost_cloudPackage`)
                                VALUES ('".$lastId."', '".$name_storage."', '".$capacity_storage."', '".$cost_storage."')";
        $cloudPackage_query = $pdo->prepare($query);
        $cloudPackage_query->execute();


    }
    
    header('Location: ../../src/views/view_login.php');


}else{
	die("Tentative de Hack .... !!!!");
}








