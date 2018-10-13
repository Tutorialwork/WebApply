<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Archive</title>
    <link rel="stylesheet" href="../assets/css/semantic.min.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <style media="screen">
      .material-icons.red{
        color: #e03333;
      }
      .material-icons.green{
        color: #35e082;
      }
      .material-icons.yellow{
        color: #ef8d04;
      }
    </style>
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
     ?>
    <div class="ui labeled icon menu">
      <?php
      if(getRank($_SESSION["username"]) == "1"){
        echo '<a class="item active" href="applications.php">
          <i class="archive icon"></i>
          Applications
        </a>';
      } else if(getRank($_SESSION["username"]) == "2"){
        echo '<a class="item active" href="applications.php">
          <i class="archive icon"></i>
          Applications
        </a>';
        echo '<a class="item" href="admin.php">
          <i class="add user icon"></i>
          Accounts
        </a>';
      } else if(getRank($_SESSION["username"]) == "3"){
        echo '<a class="item active" href="applications.php">
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
      <h1>Archive</h1>
      <br>
      <a class="ui labeled icon button" href="applications.php">
        <i class="list icon"></i>
        Go back
      </a>
      <hr>
      <br>

      <h1>Supporter applications</h1>

      <table class="ui red table" id="supporter">
  <thead>
    <tr><th>ID</th>
    <th>Username</th>
    <th>Status</th>
    <th>Applied at</th>
    <th>Actions</th>
  </tr></thead><tbody>
    <tr>
      <?php
      include('../database.php');
      $abfrage = "SELECT * FROM supporter ORDER BY created_at DESC;";
      $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
      $data = 0;
      while($row = mysqli_fetch_array($ergebnis)){
        $data++;
        echo "<tr>";
        echo '<td>'.$row["id"].'</td>
        <td>'.$row['username'].'</td>';
        if($row["status"] == "0"){
          echo '<td><i class="material-icons yellow">watch_later</i></td>';
        }
        if($row["status"] == "1"){
          echo '<td><i class="material-icons red">block</i></td>';
        }
        if($row["status"] == "2"){
          echo '<td><i class="material-icons green">done</i></td>';
        }
        echo '<td>'.date("D dS M Y", $row["created_at"]).'</td>';
        echo '<td><a href="apply.php?id='.$row["id"].'&type=sup"><i class="material-icons">visibility</i></a></td>';
        echo "</tr>";
      }
      if($data == 0){
        echo "<strong>No applications are available.</strong>";
      }
       ?>
    </tr>
  </tbody>
</table>

<h1>Developer applications</h1>

<table class="ui blue table" id="developer">
<thead>
<tr><th>ID</th>
<th>Username</th>
<th>Status</th>
<th>Applied at</th>
<th>Actions</th>
</tr></thead><tbody>
<tr>
<?php
include('../database.php');
$abfrage = "SELECT * FROM developer ORDER BY created_at DESC;";
$ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
$data = 0;
while($row = mysqli_fetch_array($ergebnis)){
  $data++;
  echo "<tr>";
  echo '<td>'.$row["id"].'</td>
  <td>'.$row['username'].'</td>';
  if($row["status"] == "0"){
    echo '<td><i class="material-icons yellow">watch_later</i></td>';
  }
  if($row["status"] == "1"){
    echo '<td><i class="material-icons red">block</i></td>';
  }
  if($row["status"] == "2"){
    echo '<td><i class="material-icons green">done</i></td>';
  }
  echo '<td>'.date("D dS M Y", $row["created_at"]).'</td>';
  echo '<td><a href="apply.php?id='.$row["id"].'&type=dev"><i class="material-icons">visibility</i></a></td>';
  echo "</tr>";
}
if($data == 0){
  echo "<strong>No applications are available.</strong>";
}
 ?>
</tr>
</tbody>
</table>

<h1>Builder applications</h1>

<table class="ui green table" id="builder">
<thead>
<tr><th>ID</th>
<th>Username</th>
<th>Status</th>
<th>Applied at</th>
<th>Actions</th>
</tr></thead><tbody>
<tr>
<?php
include('../database.php');
$abfrage = "SELECT * FROM builder ORDER BY created_at DESC;";
$ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
$data = 0;
while($row = mysqli_fetch_array($ergebnis)){
  $data++;
  echo "<tr>";
  echo '<td>'.$row["id"].'</td>
  <td>'.$row['username'].'</td>';
  if($row["status"] == "0"){
    echo '<td><i class="material-icons yellow">watch_later</i></td>';
  }
  if($row["status"] == "1"){
    echo '<td><i class="material-icons red">block</i></td>';
  }
  if($row["status"] == "2"){
    echo '<td><i class="material-icons green">done</i></td>';
  }
  echo '<td>'.date("D dS M Y", $row["created_at"]).'</td>';
  echo '<td><a href="apply.php?id='.$row["id"].'&type=builder"><i class="material-icons">visibility</i></a></td>';
  echo "</tr>";
}
if($data == 0){
  echo "<strong>No applications are available.</strong>";
}
 ?>
</tr>
</tbody>
</table>

    </div>
  </body>
</html>
