<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accounts</title>
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
      <h1>Accounts</h1>
      <br>
      <a href="addaccount.php" class="ui primary button">Add account</a>
      <table class="ui table">
  <thead>
    <tr><th>ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Rank</th>
    <th>Banned</th>
    <th>Created at</th>
    <th>Last login</th>
    <th>Manage</th>
  </tr></thead>
  <tbody>
      <?php
      include('../database.php');
      $abfrage = "SELECT * FROM accounts";
      $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
      $data = 0;
      while($row = mysqli_fetch_array($ergebnis)){
        echo '<tr><td>'.$row["id"].'</td>';
        echo '<td>'.$row["username"].'</td>';
        if($row["email"] == "null"){
          echo '<td>No email</td>';
        } else {
          echo '<td>'.$row["email"].'</td>';
        }
        if($row["rank"] == "3"){
          echo '<td>Masteruser</td>';
        } else if($row["rank"] == "2"){
          echo '<td>Admin</td>';
        } else if($row["rank"] == "1"){
          echo '<td>Team</td>';
        } else if($row["rank"] == "0"){
          echo '<td>Applicant</td>';
        }
        if($row["ban"] == "1"){
          echo '<td>Yes</td>';
        } else if($row["ban"] == "0"){
          echo '<td>No</td>';
        }
        echo '<td>'.date("D dS M Y", $row["created_at"]).'</td>';
        if($row["lastlogin"] == "null"){
          echo '<td>No login</td>';
        } else {
          echo '<td>'.date("D dS M Y", $row["lastlogin"]).'</td>';
        }
        echo '<td><a class="ui button" href="accedit.php?id='.$row["id"].'">Edit</a></td><tr>';
      }
       ?>
  </tbody>
</table>
    </div>
  </body>
</html>
