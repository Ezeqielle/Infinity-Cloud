<?php
//session_start();

$old = $_POST['name'];
$path = $_POST['path'];
$new = $_POST['new'];

rename($path."/".$old, $path."/".$new);