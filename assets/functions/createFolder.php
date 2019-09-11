<?php

$path = $_POST['path'];
$new = $_POST['new'];
$name = $_POST['name'];
$folder = $path."/".$name."/".$new;
mkdir($folder);
chmod($folder, 0777);
