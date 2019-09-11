<?php
session_start();

// convertion de octet een ko, Mo, Go, To, Po, Eo, Zo, Yo

function sizeFile($size){
    $result = $size;
    for($i = 0; $i < 8 && $result >= 1024; $i++){
        $result = $result / 1024;
    }
    if($i > 0){
        return preg_replace('/,00$/', '', number_format($result, 2, ',', '')).' '.substr('kMGTPEZY',$i-1,1).'o';
    }else{
        return $result.' o';
    }
}