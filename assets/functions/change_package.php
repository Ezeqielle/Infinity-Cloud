<?php

require "../../bdd/connection.php";
require "../../assets/functions/function.php";
$pdo = connectDB();

if(isset($_POST['id'])) {

    $id_name_package = $_POST['id'];
    $idUser = $_POST['idUSER'];

//list package
    $query = $pdo->prepare("SELECT * FROM subscription
                                WHERE name_subscription = '" . $id_name_package . "' ");
    $query->execute();
    $query_data = $query->fetchAll(PDO::FETCH_OBJ);

    $item_storage = $query_data[0]->storage;
    $item_cost = $query_data[0]->cost;


    $sql = "
    INSERT INTO `bill` (`bill_id`, `users`, `bill_date`, `name_cloudPackage`, `storage_cloudPackage`, `cost_cloudPackage`) 
    VALUES (NULL, '" . $idUser . "', CURRENT_TIMESTAMP, '" . $id_name_package . "', '".$item_storage."', '".$item_cost."')
";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
}