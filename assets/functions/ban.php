<?php

require "../../bdd/connection.php";
require "../../assets/functions/function.php";
$pdo = connectDB();

if(isset($_POST['id'])) {

    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE `users` SET `statut` = '".$status."' WHERE `users`.`user_id` = '".$id."'";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
}
