<?php
// deplacement des fichiers
// 1) rename() les fichiers de leurs origines vers le dossier pathTarget

$path = $_POST['path'];
$newPath = $_POST['newpath'];
$name = $_POST['name'];

rename($path."/".$name, $newPath."/".$name);