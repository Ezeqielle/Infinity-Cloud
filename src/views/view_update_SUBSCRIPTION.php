<?php
session_start();
require "../../assets/functions/function.php";
require "../../bdd/connection.php";

$user = $_SESSION["user_id"];
//$user = '15';
$pdo = connectDB();

//list package
$query =$pdo->prepare("SELECT * FROM subscription");
$query->execute();
$query_data = $query->fetchAll(PDO::FETCH_OBJ);


//package current userID
$query2 = $pdo->prepare("SELECT name_cloudPackage, bill_date
FROM users INNER JOIN bill ON  users.user_id = bill.users
WHERE user_id='".$user."'
ORDER BY `bill`.`bill_date` DESC
LIMIT 1 ;
");
$query2->execute();
$query2_data = $query2->fetchAll(PDO::FETCH_OBJ);

/*
$packageUser = $query2_data[0]->name_cloudPackage;
var_dump($packageUser);
var_dump($query_data);
$package_data = $query_data[1]->name_subscription;
var_dump($package_data);*/





?>

<!doctype html>

<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel='icon' type='image/png' sizes='32x20' href='assets/imgs/favicon/favicon-32x20.jpg'>
    <link rel='icon' type='image/png' sizes='16x10' href='assets/imgs/favicon/favicon-16x10.jpg'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/view_update_subscription.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>View update subscription</title>

</head>

<body>

<!--navigation-->
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white fixed-top">
    <a href="../../index.html" class="myBRAND"><img src="../../assets/imgs/logo_navbar.png" class="d-inline-block align-top" alt=""></a>
    <h5 class="my-0 mr-md-auto font-weight-normal"><strong>infinity cloud</strong></h5>
    <nav class="my-2 my-md-0">
        <a href="../../src/views/view_account.php" class="badge badge-light">
            <button type="button" class="btn_profil btn btn-outline-primary">
                my account
                <img src="../../assets/imgs/Profil.jpg" class="d-inline-block align-top" alt="">
            </button>
        </a>
        <a href="../../assets/functions/logout.php" class="btn btn-outline-primary" >disconnect</a>
    </nav>
</div>
<div class="my_margin"></div>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Cloud package</h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut non reprehenderit repudiandae sequi voluptatum.</p>
</div>

<div class="container">
    <div class="card-deck mb-3 text-center">
<!--        free package-->

<!--        premium package-->
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal"><?php echo $query_data[1]->name_subscription;  ?></h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">€<?php echo $query_data[1]->cost;?> <small class="text-muted">/ mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>20 users included</li>
                    <li><?php echo $query_data[1]->storage;  ?> GB of storage</li>
                    <li>Priority email support</li>
                    <li>Help center access</li>
                </ul>
                <button type="button" class="btnSUB btn01 btn btn-lg btn-block btn-primary" data_userID = "<?php echo $user ?>" data-listPackage = "<?php echo $query_data[1]->name_subscription;  ?>" data-userPackage = "<?php echo $query2_data[0]->name_cloudPackage  ?>">Get started</button>
            </div>
        </div>
<!--        gold package-->
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal"><?php echo $query_data[2]->name_subscription;  ?></h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">€<?php echo $query_data[2]->cost;?> <small class="text-muted">/ mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>30 users included</li>
                    <li><?php echo $query_data[2]->storage;  ?> GB of storage</li>
                    <li>Phone and email support</li>
                    <li>Help center access</li>
                </ul>
                <button type="button" class="btnSUB btn02 btn btn-lg btn-block btn-primary" data_userID = "<?php echo $user ?>" data-listPackage = "<?php echo $query_data[2]->name_subscription;  ?>" data-userPackage = "<?php echo $query2_data[0]->name_cloudPackage  ?>">Get started</button>
            </div>
        </div>
    </div>


</div>

<!--my own script-->
<script type="text/javascript" src="../../assets/js/js-viewUpdateSubscription.js"></script>

</body>
</html>
