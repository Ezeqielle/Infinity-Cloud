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

    <link rel="stylesheet" href="../../assets/css/view_register.css">
    <title>infinity drive</title>

</head>
<body>

<?php

if(isset($_SESSION["errors"])){
    echo "<div class='alert alert-danger'>";
    foreach ($_SESSION["errors"] as $error) {
        echo "<li>".$error."</li>";
    }
    echo "</div>";
}
?>

<!--navigation-->
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow fixed-top">
    <a href="../../index.html" class="myBRAND"><img src="../../assets/imgs/logo_navbar.png" class="d-inline-block align-top" alt=""></a>
    <h5 class="my-0 mr-md-auto font-weight-normal"><strong>infinity cloud</strong></h5>
    <nav class="my-2 my-md-0">
        <a class="btn btn-outline-primary" href="view_login.php">Sign in</a>
    </nav>
</div>

<!--contenu-->
<!--<span class="required">*</span></label>-->
<div class="container">

    <div class="row">

        <div class="container container--xs">

            <div id="signup_div_wrapper">
                <img class="logo_form img-fluid mx-auto d-block mb-3" src="../../assets/imgs/Logo_index.png" width="300" height="191">
                <h1 class="mb-1 text-center">Sign up</h1>

                <!--FORMULAIRE-->
                <form action="../../assets/functions/addUser.php" method="POST">
                    <form>
                        <div class="form-row">
                            <!-- username-->
                            <div class="form-group col-md-4">
                                <label for="inputUserName">User Name<span class="required">*</span></label>
                                <input type="text" id="username"
                                       name="username"
                                       class="form-control"
                                       placeholder="User name"
                                       required="required"
                                       autofocus="autofocus"
                                       value="<?php echo (isset($_SESSION["errorsInput"]))?$_SESSION["errorsInput"]["username"]:"";?>">
                            </div>
                            <!--phone number-->
                            <div class="form-group col-md-3">
                                <label for="inputUserName">Phone Number</label>
                                <input type="text" id="phone"
                                       name="phone"
                                       class="form-control"
                                       placeholder="Phone Number" required="required"
                                       value="<?php echo (isset($_SESSION["errorsInput"]))?$_SESSION["errorsInput"]["phone"]:"";?>">
                            </div>
                            <!--email-->
                            <div class="form-group col-md-5">
                                <label for="inputEmail4">Email<span class="required">*</span></label>
                                <input type="email" id="inputEmail" name="inputEmail" class="form-control"
                                       placeholder="Email address" required="required"
                                       value="<?php echo (isset($_SESSION["errorsInput"]))?$_SESSION["errorsInput"]["inputEmail"]:"";?>">
                            </div>
                            <!--PASSWORD 8 caractères - 1 majuscule - 1 chiffre-->
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Password <span class="pswd">(8 characters 1 number 1 uppercase)<span class="required">*</span></label>
                                <input type="password" id="inputPassword"
                                       name="inputPassword" class="form-control"
                                       placeholder="Password" required="required">
                            </div>
                            <!--confirm password-->
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Confirm Password<span class="required">*</span></label>
                                <input type="password" id="confirmPassword" name="confirmPassword"
                                       class="form-control"
                                       placeholder="Confirm password"
                                       required="required">
                            </div>
                        </div><!-- end flow-row -->

                        <button type="submit" class="btn btn-primary col-md-12">Sign up</button>
                    </form>

                </form>
                <p class="text-gray-soft text-center small mb-2">Already have an account? <a href="">Sign in</a></p>

            </div><!--end wraper-->

        </div><!-- end containerXS---->
    </div><!--end row-->





</div><!--end container-->




















<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>