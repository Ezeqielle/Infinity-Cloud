<?php
session_start();
require "../../bdd/connection.php";

$user = $_SESSION['user_id'];

$query = "SELECT connect_date, ip, connect_hour FROM log WHERE users = '".$user."'";
$pdo = connectDB();
$query = $pdo->query($query);

if($query->rowCount() > 0){
    $delimiter = ";";
    $filename = "log_".date('Y-m-d').".csv";

    $f = fopen('php://memory', 'w');

    $fields = array('Connect date', 'IP', 'Connect hour');
    fputcsv($f, $fields, $delimiter);

    while($row = $query->fetch()){
        $lineData = array($row['connect_date'], $row['ip'], $row['connect_hour']);
        fputcsv($f, $lineData, $delimiter);
    }
    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachement; filename="'.$filename.'";');
    fpassthru($f);
}
exit;

?>