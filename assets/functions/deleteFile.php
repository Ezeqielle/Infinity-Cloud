<?php
//session_start();

$path = $_POST['path'];
$name = $_POST['name'];
$folder = $path."/".$name;
//print_r($folder);
unlink($folder);




