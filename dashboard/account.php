<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Your Account</title>
    <link rel="stylesheet" href="../assets/css/semantic.min.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
  </head>
  <body>
    <?php
    session_start();
    if(!isset($_SESSION['username'])){
      header("Location: index.php");
      exit;
    }
     ?>
    <div class="ui labeled icon menu">
      <?php
      include('../assets/includes/System.php');
      if(getRank($_SESSION["username"]) == "1"){
        echo '<a class="item" href="applications.php">
          <i class="archive icon"></i>
          Applications
        </a>';
      } else if(getRank($_SESSION["username"]) == "2"){
        echo '<a class="item" href="applications.php">
          <i class="archive icon"></i>
          Applications
        </a>';
        echo '<a class="item" href="admin.php">
          <i class="add user icon"></i>
          Accounts
        </a>';
      } else if(getRank($_SESSION["username"]) == "3"){
        echo '<a class="item" href="applications.php">
          <i class="archive icon"></i>
          Applications
        </a>';
        echo '<a class="item" href="admin.php">
          <i class="add user icon"></i>
          Accounts
        </a>';
      }
      if(getRank($_SESSION["username"]) == "0"){
        echo '<a class="item" href="yourapply.php">
          <i class="book icon"></i>
          Your apply
        </a>';
      }
       ?>
      <a class="item active" href="account.php">
        <i class="user icon"></i>
        Account
      </a>
      <a class="item" href="logout.php">
        <i class="lock icon"></i>
        Logout
      </a>
</div>
    <div class="ui container">
      <h1>Your Account</h1>
      <?php
      if(isset($_POST["submit"])){
        include('../database.php');
        $opw = mysqli_real_escape_string($mysqli, $_POST["currentpw"]);
        $pw = mysqli_real_escape_string($mysqli, $_POST["newpassword"]);
        $pw2 = mysqli_real_escape_string($mysqli, $_POST["newpassword2"]);
        $user = $_SESSION["username"];
        if($pw == $pw2){
          $abfrage = "SELECT password FROM accounts WHERE username = '$user'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          while($row = mysqli_fetch_array($ergebnis)){
            if(password_verify($opw, $row["password"])){
              $hash = password_hash($pw, PASSWORD_BCRYPT);
              $abfrage = "UPDATE password FROM accounts WHERE username = '$user'";
              $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
              echo '<div class="ui success message">
      <div class="header">
        Success
      </div>
      <p>Your password was changed.
    </p></div>';
            } else {
              echo '<div class="ui negative message">
      <div class="header">
        Error
      </div>
      <p>Your old passwords is wrong.
    </p></div>';
            }
          }
        } else {
          echo '<div class="ui negative message">
  <div class="header">
    Error
  </div>
  <p>Your passwords do not match.
</p></div>';
        }
      }
       ?>
      <form class="ui form" action="account.php" method="post">
        <div class="field">
          <label>Your current password</label>
          <input type="password" name="currentpw" placeholder="Your current password" required>
        </div>
        <div class="field">
          <label>Your new password</label>
          <input type="password" name="newpassword" placeholder="Your new password" required>
        </div>
        <div class="field">
          <label>Your new password again</label>
          <input type="password" name="newpassword2" placeholder="Your new password again" required>
        </div>
        <button class="ui button" type="submit" name="submit">Change</button>
      </form>
    </div>
  </div>
    </div>
  </body>
</html>
