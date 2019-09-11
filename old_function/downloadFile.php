<?php


$path = $_POST['path']."/";
$file = $_POST['name'];

//print_r($path);

echo $file;

if (($file != "") && (file_exists(''.$path . basename($file))))
{

    $size = filesize("".$path . basename($file));
    header("Content-Type: application/force-download; name=\"" . basename($file) . "\"");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: $size");
    header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
    header("Expires: 0");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    readfile("".$path . basename($file));
    exit();
}
