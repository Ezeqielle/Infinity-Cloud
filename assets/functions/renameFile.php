<?php


$old = $_POST['name'];
$path = $_POST['path'];
$new = $_POST['new'];
$type = $_POST['type'];
$file = $path."/".$old;
chmod($file, 0666);
//print_r($path."/".$old);
print_r($type);

rename($path."/".$old, $path."/".$new.".".$type);