<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Applications</title>
    <link rel="stylesheet" href="../assets/css/semantic.min.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
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
      <h1>Applications</h1>
      <br>
      <a class="ui labeled icon button" href="archive.php">
        <i class="archive icon"></i>
        Archive
      </a>
      <hr>
      <br>
      <div class="ui three column doubling grid" id="space">
  <div class="column">
    <h1 style="text-align: left;">Supporter applications</h1>
    <div class="ui segment"><table class="ui celled table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Applied at</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
      <?php
      include('../database.php');
      $abfrage = "SELECT * FROM supporter WHERE status = '0' ORDER BY created_at DESC;";
      $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
      $data = 0;
      while($row = mysqli_fetch_array($ergebnis)){
        $data++;
        echo "<tr>";
        echo '<td>'.$row["id"].'</td>
        <td>'.$row['username'].'</td>';
        echo '<td>'.date("D dS M Y", $row["created_at"]).'</td>';
        echo '<td><a href="apply.php?id='.$row["id"].'&type=sup"><i class="material-icons">visibility</i></a></td>';
        echo "</tr>";
      }
      if($data == 0){
        echo "<strong>No applications are available.</strong>";
      }
       ?>
  </tbody>
</table></div>
  </div>
  <div class="column">
    <h1 style="text-align: left;">Developer applications</h1>
    <div class="ui segment"><table class="ui celled table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Applied at</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include('../database.php');
    $abfrage = "SELECT * FROM developer WHERE status = '0' ORDER BY created_at DESC;";
    $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
    $data = 0;
    while($row = mysqli_fetch_array($ergebnis)){
      $data++;
      echo "<tr>";
      echo '<td>'.$row["id"].'</td>
      <td>'.$row['username'].'</td>';
      echo '<td>'.date("D dS M Y", $row["created_at"]).'</td>';
      echo '<td><a href="apply.php?id='.$row["id"].'&type=dev"><i class="material-icons">visibility</i></a></td>';
      echo "</tr>";
    }
    if($data == 0){
      echo "<strong>No applications are available.</strong>";
    }
     ?>
 </tbody>
</table></div>
  </div>
  <div class="column">
    <h1 style="text-align: left;">Builder applications</h1>
    <div class="ui segment"><table class="ui celled table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Applied at</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include('../database.php');
    $abfrage = "SELECT * FROM builder WHERE status = '0' ORDER BY created_at DESC;";
    $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
    $data = 0;
    while($row = mysqli_fetch_array($ergebnis)){
      $data++;
      echo "<tr>";
      echo '<td>'.$row["id"].'</td>
      <td>'.$row['username'].'</td>';
      echo '<td>'.date("D dS M Y", $row["created_at"]).'</td>';
      echo '<td><a href="apply.php?id='.$row["id"].'&type=builder"><i class="material-icons">visibility</i></a></td>';
      echo "</tr>";
    }
    if($data == 0){
      echo "<strong>No applications are available.</strong>";
    }
     ?>
 </tbody>
</table></div>
  </div>
    </div>
  </div>
    </div>
  </body>
</html>
