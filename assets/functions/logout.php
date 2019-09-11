<?php 
session_start();
require "../../bdd/connection.php";

if(!empty($_SESSION["email"])){

    $query = "UPDATE users SET token=NULL WHERE user_id='".$_SESSION["user_id"]."'";
    $pdo = connectDB();
    $query = $pdo->query($query);
    session_destroy();
    header('location: ../../src/views/view_login.php');
        exit;
}