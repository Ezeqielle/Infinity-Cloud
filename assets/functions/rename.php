<?php
//session_start();

$old = $_POST['name'];
$path = $_POST['path'];
$new = $_POST['new'];
//var_dump($_POST);
//$path = "../../src/users/2/";
//$old = "dossier 02";
//$new = "toto";

rename($path."/".$old, $path."/".$new);