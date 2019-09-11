<?php

require "../../bdd/connection.php";
require "../../assets/functions/function.php";
$pdo = connectDB();

if(isset($_GET['id']))
{
    deleteFolder($_GET['id']);

    $sql = "DELETE FROM users WHERE user_id=".$_GET['id'];
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':users', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
}