<?php
$path = $_POST['path'];
$name = $_POST['name'];
$folder = $path."/".$name;
if(is_dir($folder)){
    $objects = scandir($folder);
    foreach($objects as $object){
        if(filetype($folder."/".$object) == "dir") rmdir($folder."/".$object); else unlink($folder."/".$object);
    }
}
reset($objects);
rmdir($folder);