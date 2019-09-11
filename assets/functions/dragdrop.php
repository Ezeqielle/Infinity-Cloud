<?php
session_start();
$user = $_SESSION['user_id'];
//$getHeader = getallheaders();
//
////Faire les vérifications des informations
//

move_uploaded_file($_FILES['file']['tmp_name'], '../../src/users/'.$user.'/'. $_FILES['file']['name']);



