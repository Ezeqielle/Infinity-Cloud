<?php
session_start();

$file = "logFailed.txt";

if(($file != "") && (file_exists("../../src/views/".basename($file)))){
    $size = filesize("../../src/views/".basename($file));
    header("Content-Type: application/force-download; name=\"".basename($file)."\"");
    header("Content-Transfert-Encoding: binary");
    header("Content-Length: $size");
    header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
    header("Expires: 0");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    readfile("../../src/views/".basename($file));
    exit();
}