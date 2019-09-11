<?php
session_start();
require "../../assets/functions/function.php";
require "../../bdd/connection.php";

$user = $_SESSION["user_id"];
$pdo = connectDB();
$query = "SELECT * FROM users WHERE user_id = '".$user."'";
$query = $pdo->query($query);
$profil_data = $query->fetchALL(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Update profil</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Update your profil</div>
        <div class="card-body">

          <?php
            if(isset($_SESSION["errors"])){
              echo "<div class='alert alert-danger'>";
              foreach ($_SESSION["errors"] as $error) {
                echo "<li>".$error."</li>";
              }
              echo "</div>";
            }
          ?>
          <form action="../../assets/functions/updateUser.php" method="POST">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input type="hidden" id="user_id" name="user_id" class="form-control" required="required" autofocus="autofocus" value="<?php echo $profil_data[0]->user_id;?>">
                    </div>
                    <div class="form-label-group">
                    <input type="text" id="username" name="username" class="form-control" required="required" autofocus="autofocus" value="<?php echo $profil_data[0]->user_name;?>">
                    <label for="username">User name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="phone" name="phone" class="form-control" required="required"
                      value="<?php echo $profil_data[0]->phone_number;?>">
                    <label for="phone">phone</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="hidden" id="inputEmail" name="inputEmail" class="form-control" required="required"
                      value="<?php echo $profil_data[0]->email;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required">
                    <label for="inputPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                    <label for="confirmPassword">Confirm password</label>
                  </div>
                </div>
              </div>
            </div>            
            <input type="submit"  class="btn btn-primary btn-block" value="Update">

          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="view_account.php">Back to you account</a>
          </div>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>

