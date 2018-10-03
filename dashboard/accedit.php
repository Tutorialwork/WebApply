<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Account</title>
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
    include('../assets/includes/System.php');
    if(getRank($_SESSION["username"]) == "0"){
      header("Location: yourapply.php");
      exit;
    }
    if(getRank($_SESSION["username"]) == "1"){
      header("Location: applications.php");
      exit;
    }
     ?>
    <div class="ui labeled icon menu">
  <?php
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
    echo '<a class="item active" href="admin.php">
      <i class="add user icon"></i>
      Accounts
    </a>';
  } else if(getRank($_SESSION["username"]) == "3"){
    echo '<a class="item" href="applications.php">
      <i class="archive icon"></i>
      Applications
    </a>';
    echo '<a class="item active" href="admin.php">
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
  <a class="item" href="account.php">
    <i class="user icon"></i>
    Account
  </a>
  <a class="item" href="logout.php">
    <i class="lock icon"></i>
    Logout
  </a>
</div>
    <div class="ui container">
      <h1>Edit account</h1>
      <br>
      <?php
      if(isset($_POST["changerank"])){
        $rank = $_POST["rank"];
        $id = $_POST["id"];
        include('../database.php');
        $abfrage = "UPDATE accounts SET rank = '$rank' WHERE id = '$id'";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
        echo '<div class="ui success message">
  <div class="header">
    Success
  </div>
  <p>The rank of the user was changed.</p>
</div>';
        exit;
      }
      if(isset($_POST["ban"])){
        $id = $_POST["id"];
        include('../database.php');
        $abfrage = "UPDATE accounts SET ban = '1' WHERE id = '$id'";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
        echo '<div class="ui success message">
  <div class="header">
    Success
  </div>
  <p>The user was banned.</p>
</div>';
        exit;
      }
      if(isset($_POST["unban"])){
        $id = $_POST["id"];
        include('../database.php');
        $abfrage = "UPDATE accounts SET ban = '0' WHERE id = '$id'";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
        echo '<div class="ui success message">
  <div class="header">
    Success
  </div>
  <p>The user was unban.</p>
</div>';
        exit;
      }
      if(isset($_GET["id"])){
        if(isAccExistByID($_GET["id"])){
          if(!isMasteruser(getUsernameByID($_GET["id"]))){
            echo "<h1>".getUsernameByID($_GET["id"])." | #".$_GET["id"]."</h1>";
            echo '<form class="ui form" action="accedit.php" method="post">
            <p>New rank:</p>
            <select name="rank">
              <option value="0">Applicant</option>
              <option value="1">Team</option>
              <option value="2">Admin</option>
            </select><br>
            <input type="hidden" value="'.$_GET["id"].'" name="id">
            <button class="ui button" type="submit" name="changerank">Change rank</button>
            </form>';
            if(isBanned(getUsernameByID($_GET["id"]))){
              echo '<br><form class="ui form" action="accedit.php" method="post">
              <input type="hidden" value="'.$_GET["id"].'" name="id">
              <button class="ui button green" type="submit" name="unban">Unban</button>
              </form>';
            } else {
              echo '<br><form class="ui form" action="accedit.php" method="post">
              <input type="hidden" value="'.$_GET["id"].'" name="id">
              <button class="ui button red" type="submit" name="ban">Ban</button>
              </form>';
            }
          } else {
            echo '<h1 style="color: red">You cannot edit the masteruser.</h1>';
          }
        } else {
          echo '<h1 style="color: red">The requested account does not exists.</h1>';
        }
      } else {
        echo '<h1 style="color: red">No account requested.</h1>';
      }
       ?>
    </div>
  </body>
</html>
