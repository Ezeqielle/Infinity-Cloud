<?php
$user = $_SESSION['user_id'];
$folder = "../../src/users/".$user."/";
$iter = new DirectoryIterator($folder);


function sizeFolder(){
        $size = 0;
        foreach($iter as $file){
                if(!$file->isDot()){
                    $size += $file->getSize();
                }
        }
}


