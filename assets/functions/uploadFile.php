<?php
session_start();

// recuperer l id de l user dans la session
// chemin d acces vers le folder users + le sous folder user_id
// upload du fichier
$user = $_SESSION["user_id"];
$folder = "../../src/users/".$user."/";
$file = basename($_FILES['file']['name']);
$size_max = 5000000;
$size = $_FILES['file']['size'];

if($size>$size_max){
     $erreur = 'Le file est trop gros...';
}
//s'il n'y a pas d'erreur, on upload
if(!isset($erreur)) {
     //on formate le nom du file ici on replace les lettres spéciale par leur origine et tout ce qui n'est pas lettre ou chiffre par un " - "
     $file = strtr($file, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);
     //var_dump($file);
     //die;
     //si la fonction renvoie TRUE, c'est que ça a fonctionné
     if(file_exists($folder . $_FILES['file']['name'])){
          echo $_FILES['file']['name'] . " existe déjà.";

     }elseif(is_uploaded_file($_FILES['file']['tmp_name'])){ 
          if(move_uploaded_file($_FILES['file']['tmp_name'], $folder.$_FILES['file']['name'])){
               echo "Fichier".$_FILES['file']['name']." uploadé avec succès.";
               header("Location: ../../src/views/view_account.php");
          }
     //sinon (la fonction renvoie FALSE).     
     }/*else{
          echo "Error: " . $_FILES['file']['error'];
          echo " Echec de l'upload !";
     }*/
}else{
     echo $erreur;
}



/*
<form enctype="multipart/form-data" action="../../assets/functions/uploadFile.php" method="POST">
     <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
     <input name="file" type="file" />
     <input type="submit" value="Upload" />

</form>
*/