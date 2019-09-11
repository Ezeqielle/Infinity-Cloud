<?php
function TailleDossier($Rep)
{
        $Racine=opendir($Rep);
        $Taille=0;
        while($Dossier = readdir($Racine))
        {
            if($Dossier != '..' And $Dossier !='.')
            {
                if(is_dir($Rep.'/'.$Dossier)) $Taille += TailleDossier($Rep.'/'.$Dossier); //Ajoute la taille du sous dossier
                else $Taille += filesize($Rep.'/'.$Dossier); 
//Ajoute la taille du fichier
            }
        }
        closedir($Racine);
        return $Taille;
}
?>