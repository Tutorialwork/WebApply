<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/semantic.min.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="semantic/dist/semantic.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <style media="screen">
        body {
          background-color: #ECF0F1;
        }
        .page-login {
          margin-top: 25px;
        }
        .text{
          text-align: center;
          margin: 10px;
        }
      </style>
  </head>

<div class="page-login">
  <div class="ui centered grid container">
    <div class="nine wide column">

      <?php

        if(isset($_GET["login"])){
          include('../database.php');

          $user = mysqli_real_escape_string($mysqli, $_POST['username']);
          $pw = mysqli_real_escape_string($mysqli, $_POST['password']);

          $data = 0;

          $abfrage = "SELECT * FROM accounts WHERE username = '$user'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));

          while($row = mysqli_fetch_object($ergebnis)){
                $data++;
          }

          if($data != 0){
            $abfrage = "SELECT * FROM accounts WHERE username = '$user'";
            $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));

            while($row = mysqli_fetch_array($ergebnis)){
                  $dbpw = $row["password"];
                  if(password_verify($pw, $dbpw)){
                    include('../assets/includes/System.php');
                    if(isBanned($user)){
                      echo '<div class="ui icon error message">
                          <i class="lock icon"></i>
                          <div class="content">
                            <div class="header">
                              Login failed!
                            </div>
                            <p>You are banned!</p>
                          </div>
                        </div>';
                    } else {
                      $time = time();
                      $abfrage = "UPDATE accounts SET lastlogin = '$time' WHERE username = '$user'";
                      $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
                      session_start();
                      $_SESSION['username'] = $user;
                      if($row["rank"] == "0"){
                        header('Location: yourapply.php');
                        exit;
                      } else {
                        header('Location: applications.php');
                        exit;
                      }
                    }
                  } else {
                    echo '<div class="ui icon warning message">
                        <i class="lock icon"></i>
                        <div class="content">
                          <div class="header">
                            Login failed!
                          </div>
                          <p>You have entered wrong userdatas!</p>
                        </div>
                      </div>';
                  }
            }
          } else {
            echo '<div class="ui icon warning message">
                <i class="lock icon"></i>
                <div class="content">
                  <div class="header">
                    Login failed!
                  </div>
                  <p>You have entered wrong userdatas!</p>
                </div>
              </div>';
          }
        }

       ?>

      <div class="ui fluid card">
        <div class="text">
          <h1>Login</h1>
          <p>Please enter your logindatas to access the applydashboard.</p>
        </div>
        <div class="content">
        <form class="ui form" method="POST" action="index.php?login">
          <div class="field">
            <label>Username</label>
            <input type="text" name="username" placeholder="Username" required>
          </div>
          <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>
          </div>
          <button class="ui primary labeled icon button" type="submit">
            <i class="unlock alternate icon"></i>
            Login
          </button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

</html>
