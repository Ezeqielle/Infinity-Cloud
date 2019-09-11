<?php
session_start();

// recuperer l id de l user dans la session
// chemin d acces vers le dossier users + le sous dossier user_id
// affichage en tableau des resultats avec nom-taille-type
// utilisation de la classe native a php -> DirectoryIteratior
// utilisation de la fonction isDot pour trouver ls fichier en " . " et " .. "

$user = $_SESSION["user_id"];

$folder = "../../src/users/".$user;
$iter = new DirectoryIterator($folder);

foreach($iter as $file){
    if(!$file->isDot()){
        echo $file->getFilename(). ' ' ;
        echo $file->getSize(). ' ' ;
        echo $file->getExtension(). ' ' ;
    }
    echo '<br>';
}