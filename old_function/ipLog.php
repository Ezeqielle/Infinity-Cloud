<?php
session_start();
require "../../bdd/connection.php";

// recuperation de l'adresse ip
// mise en base de données de l'adresse ip de connexion
// mise en base de données de la date de connexion
// mise en base de données de l'heure de connexion

$ipUser = $_SERVER['REMOTE_ADDR'];

// curdate() --> obtention de la date actuelle en sql format DATE
// curtime() --> obtention de l'heure actuelle en sql format TIME

// INSERT INTO log (connect_date) VALUES curdate();
// INSERT INTO log (connect_hour) VALUES curtime();
// INSERT INTO log (ip) VALUES :ip;
// INSERT INTO log (users) VALUES :user;

$user = $_SESSION["user_id"];

$query = "INSERT INTO log (connect_date, connect_hour, ip, users) VALUES (curdate(), curtime(), :ip, :user)";

$queryPrepared = $pdo->prepare($query);
$queryPrepared->bindParam(':ip',$ipUser);
$queryPrepared->bindParam(':user',$user);
$queryPrepared->execute();
