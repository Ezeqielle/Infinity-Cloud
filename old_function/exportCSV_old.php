<?php
session_start();
require "../../bdd/connection.php";


$user = $_SESSION['user_id'];

//$selectTable = mysql_query("SELECT * FROM log WHERE users = '".$user."'");
$query = "SELECT * FROM log WHERE users = '".$user."'";
$pdo = connectDB();
$query = $pdo->query($query);

$rows = $query->fetch_assoc();
if($rows){
    makecsv(array_keys($rows));
}
while($rows){
    makecsv($rows);
    $rows = $query->fetch_assoc();
}

function makecsv($num_field_names){
    $separate = '';

    foreach($num_field_names as $field_name){
        $field_name = str_replace(array('<br>', '<br />', "n", "r", ",", ";"), array( '-', '-', '-', '-', '-', '-'), $field_name);
        echo $separate.$field_name;
        $separate = ';';
    }
    echo "\rn";
}
header("Content-Type: application/csv-tab-delimited-table");
header("Content-disposition: attachemnt; filename=log.csv");

header("location: ../../src/views/view_account.php");