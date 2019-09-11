<?php
function writeLog($text, $file){
    $handle = fopen("logFailed.txt", 'a+');
    fwrite($handle, $text);
    fclose($handle);
    //ou file_put_contents
}

function createToken(){
    $token = md5(uniqid()."jaduqa,?&èhf%58".time());
    $token = substr($token, 0, rand(10,20));
    $token = str_shuffle($token);
    return $token;
}

//$user = ["id"=>"3", "email"=>"xxxxx@xxxx.xxx", "pwd"=>"xxxxx"]
function login($user){
    $token = createToken();
    $_SESSION["token"]=$token;
    $_SESSION["user_id"]=$user["user_id"];
    $_SESSION["email"]=$user["email"];

    $userID = $user["user_id"];

    // mise en base de données des log de connexion
    $ipUser = $_SERVER['REMOTE_ADDR'];


    $query = "UPDATE users SET token='".$token."' WHERE user_id='".$user['user_id']."' AND email='".$user['email']."'";

    $pdo = connectDB();
    $pdo->query($query);


    $queryINSERT = "INSERT INTO `log` (`log_id`, `users`, `connect_date`, `ip`, `connect_hour`) VALUES (NULL, $userID, CURRENT_DATE, '$ipUser', CURRENT_TIME);";
    $query = $queryINSERT;

    $queryPrepared = $pdo->prepare($query);
    $queryPrepared->execute();

}

//vérifie si l'user est tjrs connecté
function isConnected(){

    //Est ce que les sessions existent
    if( !empty($_SESSION["token"])
        && !empty($_SESSION["user_id"])
        && !empty($_SESSION["email"]) ){
        //-> si oui
        //comparaison des variables de session avec la bdd
        $query = "SELECT user_id FROM users WHERE 
					token= '".$_SESSION["token"]."'  
					AND user_id='".$_SESSION["user_id"]."' 
					AND email='".$_SESSION["email"]."'";

        $pdo = connectDB();
        $query = $pdo->query($query);
        $result = $query->fetch();

        if(!empty($result)){
            //-> si oui
            //Nouveau token
            $user = [ "user_id"=>$_SESSION["user_id"], "email"=>$_SESSION["email"]];
            login($user);
            return true;
        }
    }

    return false;
}

function canvas ($min, $max, $value, $color){
    echo "<input type='text' name='round' class='round' data-min='".$min."' data-max='".$max."'' value='".$value."' data-color='".$color."'/>";

}

//supprimer un dossier
function deleteFolder($userID){
    $folder = "../../src/users/".$userID;
    $dir_iterator = new RecursiveDirectoryIterator($folder);
    $iteratorDelete = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);
    foreach($iteratorDelete as $object){
        $object->isDir() ? rmdir($object) : unlink($object);
    }
    rmdir($folder);
}

//création dossier
function addFolder($userID){
    $folder = "../../src/users/".$userID;
    mkdir($folder);
    chmod($folder, 0755);
}

//calculer la taille du dossier
function sizeFolder($Rep){
    $Racine=opendir($Rep);
    $size=0;
    while($folder = readdir($Racine)){
        if($folder != '..' And $folder !='.'){
            if(is_dir($Rep.'/'.$folder)) $size += TailleDossier($Rep.'/'.$folder); //Ajoute la taille du sous dossier
            else $size += filesize($Rep.'/'.$folder);
//Ajoute la taille du fichier
        }
    }
    closedir($Racine);
    return $size;
}
