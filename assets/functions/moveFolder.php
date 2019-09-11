<?php
// deplacement des fichiers et dossiers
// 1) copy() des dossiers de leurs origines vers le dossier pathTarget
// 2) rename() les fichiers de leurs origines vers le dossier pathTarget
// 3) rmdir() les anciens dossiers

//////////////////////////////////////////////////////////////////////////


$nameParent = $_POST['name'];
$pathOrigins = $_POST['path']."/".$_POST['name'];
$pathTarget = $_POST['newpath'];
$wherePast = $pathTarget."/".$nameParent;

mkdir($pathTarget."/".$nameParent);
//on parcourt le dossier que je veux copier en supprimant les DOTS
$dir_iterator = new RecursiveDirectoryIterator($pathOrigins, RecursiveDirectoryIterator::SKIP_DOTS);

//
$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

//
$iteratorDelete = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);


foreach($iterator as $items){

    echo '<br>';
    if($items->isDir()){
        mkdir($wherePast . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
    } else{
        copy($items, $wherePast . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
    }
}


foreach($iteratorDelete as $object){
    $object->isDir() ? rmdir($object) : unlink($object);
}
rmdir($pathOrigins);