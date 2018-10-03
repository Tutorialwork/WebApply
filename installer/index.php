<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Installer</title>
    <link rel="stylesheet" href="../assets/css/semantic.min.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
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
  <body>
    <div class="page-login">
      <div class="ui centered grid container">
        <div class="nine wide column">
          <div class="ui fluid card">
            <div class="text">
              <?php
              if(isset($_POST["submit"])){
                include('../database.php');
                //Gen tables
                $abfrage = "CREATE TABLE IF NOT EXISTS supporter (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
          status VARCHAR(10),
          name VARCHAR(30),
          username VARCHAR(30),
          age VARCHAR(20),
          lang VARCHAR(100),
          onlinetime VARCHAR(50),
          why VARCHAR(2000),
          experience VARCHAR(2000),
          others VARCHAR(512),
          created_at VARCHAR(100)
          ) ";

                $abfrage2 = "CREATE TABLE IF NOT EXISTS developer (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
          status VARCHAR(10),
          name VARCHAR(30),
          username VARCHAR(30),
          age VARCHAR(20),
          since VARCHAR(20),
          lang VARCHAR(255),
          online VARCHAR(50),
          why VARCHAR(2000),
          experience VARCHAR(2000),
          others VARCHAR(512),
          created_at VARCHAR(100)
          ) ";


                $abfrage3 = "CREATE TABLE IF NOT EXISTS builder (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
          status VARCHAR(10),
          name VARCHAR(30),
          username VARCHAR(30),
          age VARCHAR(20),
          since VARCHAR(20),
          online VARCHAR(50),
          why VARCHAR(2000),
          experience VARCHAR(2000),
          example VARCHAR(512),
          others VARCHAR(512),
          created_at VARCHAR(100)
          ) ";

              $abfrage4 = "CREATE TABLE IF NOT EXISTS accounts(
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
          username VARCHAR(30),
          email VARCHAR(100),
          password VARCHAR(255),
          rank VARCHAR(10),
          ban VARCHAR(10),
          token VARCHAR(100),
          created_at VARCHAR(100),
          lastlogin VARCHAR(100)
          )";

          $abfrage5 = "CREATE TABLE IF NOT EXISTS comments(
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
      applyid INT(6),
      type VARCHAR(100),
      comment VARCHAR(2500),
      author VARCHAR(100),
      written_at VARCHAR(100),
      opinion VARCHAR(50)
      )";

          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          $ergebnis2 = mysqli_query($mysqli,$abfrage2) or die(mysqli_error($mysqli));
          $ergebnis3 = mysqli_query($mysqli,$abfrage3) or die(mysqli_error($mysqli));
          $ergebnis4 = mysqli_query($mysqli,$abfrage4) or die(mysqli_error($mysqli));
          $ergebnis5 = mysqli_query($mysqli,$abfrage5) or die(mysqli_error($mysqli));
                $user = mysqli_real_escape_string($mysqli, $_POST["username"]);
                $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
                $pw = mysqli_real_escape_string($mysqli, $_POST["password"]);
                $pw2 = mysqli_real_escape_string($mysqli, $_POST["password2"]);
                if($pw == $pw2){
                  include('../database.php');
                  $time = time();
                  $hashpw = password_hash($pw, PASSWORD_BCRYPT);
                  $abfrage = "INSERT INTO accounts (username, email, password, rank, ban, token, created_at, lastlogin) VALUES ('$user', '$email', '$hashpw', '3', '0', 'null', '$time', 'null')";
                  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
                  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                  $newurl = str_replace("installer", "dashboard", $url);
                  echo '<div class="ui icon success message">
                      <i class="unlock icon"></i>
                      <div class="content">
                        <div class="header">
                          Success!
                        </div>
                        <p>Account created <a href="'.$newurl.'">HERE</a> can you log in.</p>
                      </div>
                    </div>';
                } else {
                  echo '<div class="ui icon warning message">
                      <i class="lock icon"></i>
                      <div class="content">
                        <div class="header">
                          Failed!
                        </div>
                        <p>Passwords not matching!</p>
                      </div>
                    </div>';
                }
              }
               ?>
              <h1>Installer</h1>
              <p>With the installer you can create a masteruser account when you have created it delete it.</p>
              <h3 style="color: red">DELETE THE FOLDER "installer" WHEN YOU HAVE CREATED THE ACCOUNT!</h3>
            </div>
            <div class="content">
            <form class="ui form" method="POST" action="index.php">
              <div class="field">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" required>
              </div>
              <div class="field">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email" required>
              </div>
              <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
              </div>
              <div class="field">
                <label>Password again</label>
                <input type="password" name="password2" placeholder="Password again" required>
              </div>
              <button class="ui primary labeled icon button" type="submit" name="submit">
                <i class="add user alternate icon"></i>
                Create masteruser
              </button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
