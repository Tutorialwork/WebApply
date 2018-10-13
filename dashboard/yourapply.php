<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Your apply</title>
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
    if(!getRank($_SESSION["username"]) == "0"){
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
        echo '<a class="item active" href="yourapply.php">
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
      <h1>Your apply</h1>
      <?php
      include('../database.php');
      $user = $_SESSION["username"];
      $abfrage = "SELECT username FROM supporter WHERE username = '$user'";
      $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
      $data = 0;
      while($row = mysqli_fetch_object($ergebnis)){
        $data++;
      }
      if($data != 0){
        $abfrage = "SELECT status FROM supporter WHERE username = '$user'";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
        while($row = mysqli_fetch_array($ergebnis)){
          if($row["status"] == "0"){
            echo '<div class="ui ordered steps">
        <div class="completed step">
          <div class="content">
            <div class="title">Send</div>
            <div class="description">Your apply was sent to our.</div>
          </div>
        </div>
        <div class="active step">
          <div class="content">
            <div class="title">Processing</div>
            <div class="description">Your apply will be processed by a staff member.</div>
          </div>
        </div>
        <div class="step">
          <div class="content">
            <div class="title">Result</div>
            <div class="description">You will receive the result of your application.</div>
          </div>
        </div>
      </div>';
    } else if($row["status"] == "1"){
      echo '<div class="ui ordered steps">
  <div class="completed step">
    <div class="content">
      <div class="title">Send</div>
      <div class="description">Your apply was sent to our.</div>
    </div>
  </div>
  <div class="completed step">
    <div class="content">
      <div class="title">Processing</div>
      <div class="description">Your apply will be processed by a staff member.</div>
    </div>
  </div>
  <div class="completed step">
    <div class="content">
      <div class="title">Result</div>
      <div class="description">You will receive the result of your application.</div>
    </div>
  </div>
</div>
<br>
<h1 style="color: red">Applystatus: REJECTED</h1>';
} else if($row["status"] == "2"){
      echo '<div class="ui ordered steps">
  <div class="completed step">
    <div class="content">
      <div class="title">Send</div>
      <div class="description">Your apply was sent to our.</div>
    </div>
  </div>
  <div class="completed step">
    <div class="content">
      <div class="title">Processing</div>
      <div class="description">Your apply will be processed by a staff member.</div>
    </div>
  </div>
  <div class="completed step">
    <div class="content">
      <div class="title">Result</div>
      <div class="description">You will receive the result of your application.</div>
    </div>
  </div>
</div>
<br>
<h1 style="color: green">Applystatus: ACCEPTED</h1>';
    }
        }
      } else {
        $abfrage = "SELECT username FROM developer WHERE username = '$user'";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
        $data = 0;
        while($row = mysqli_fetch_object($ergebnis)){
          $data++;
        }
        if($data != 0){
          $abfrage = "SELECT status FROM developer WHERE username = '$user'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          while($row = mysqli_fetch_array($ergebnis)){
            if($row["status"] == "0"){
              echo '<div class="ui ordered steps">
          <div class="completed step">
            <div class="content">
              <div class="title">Send</div>
              <div class="description">Your apply was sent to our.</div>
            </div>
          </div>
          <div class="active step">
            <div class="content">
              <div class="title">Processing</div>
              <div class="description">Your apply will be processed by a staff member.</div>
            </div>
          </div>
          <div class="step">
            <div class="content">
              <div class="title">Result</div>
              <div class="description">You will receive the result of your application.</div>
            </div>
          </div>
        </div>';
      } else if($row["status"] == "1"){
        echo '<div class="ui ordered steps">
    <div class="completed step">
      <div class="content">
        <div class="title">Send</div>
        <div class="description">Your apply was sent to our.</div>
      </div>
    </div>
    <div class="completed step">
      <div class="content">
        <div class="title">Processing</div>
        <div class="description">Your apply will be processed by a staff member.</div>
      </div>
    </div>
    <div class="completed step">
      <div class="content">
        <div class="title">Result</div>
        <div class="description">You will receive the result of your application.</div>
      </div>
    </div>
  </div>
  <br>
  <h1 style="color: red">Applystatus: REJECTED</h1>';
  } else if($row["status"] == "2"){
        echo '<div class="ui ordered steps">
    <div class="completed step">
      <div class="content">
        <div class="title">Send</div>
        <div class="description">Your apply was sent to our.</div>
      </div>
    </div>
    <div class="completed step">
      <div class="content">
        <div class="title">Processing</div>
        <div class="description">Your apply will be processed by a staff member.</div>
      </div>
    </div>
    <div class="completed step">
      <div class="content">
        <div class="title">Result</div>
        <div class="description">You will receive the result of your application.</div>
      </div>
    </div>
  </div>
  <br>
  <h1 style="color: green">Applystatus: ACCEPTED</h1>';
      }
          }
        } else {
          $abfrage = "SELECT username FROM builder WHERE username = '$user'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          $data = 0;
          while($row = mysqli_fetch_object($ergebnis)){
            $data++;
          }
          if($data != 0){
            $abfrage = "SELECT status FROM builder WHERE username = '$user'";
            $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
            while($row = mysqli_fetch_array($ergebnis)){
              if($row["status"] == "0"){
                echo '<div class="ui ordered steps">
            <div class="completed step">
              <div class="content">
                <div class="title">Send</div>
                <div class="description">Your apply was sent to our.</div>
              </div>
            </div>
            <div class="active step">
              <div class="content">
                <div class="title">Processing</div>
                <div class="description">Your apply will be processed by a staff member.</div>
              </div>
            </div>
            <div class="step">
              <div class="content">
                <div class="title">Result</div>
                <div class="description">You will receive the result of your application.</div>
              </div>
            </div>
          </div>';
        } else if($row["status"] == "1"){
          echo '<div class="ui ordered steps">
      <div class="completed step">
        <div class="content">
          <div class="title">Send</div>
          <div class="description">Your apply was sent to our.</div>
        </div>
      </div>
      <div class="completed step">
        <div class="content">
          <div class="title">Processing</div>
          <div class="description">Your apply will be processed by a staff member.</div>
        </div>
      </div>
      <div class="completed step">
        <div class="content">
          <div class="title">Result</div>
          <div class="description">You will receive the result of your application.</div>
        </div>
      </div>
    </div>
    <br>
    <h1 style="color: red">Applystatus: REJECTED</h1>';
    } else if($row["status"] == "2"){
          echo '<div class="ui ordered steps">
      <div class="completed step">
        <div class="content">
          <div class="title">Send</div>
          <div class="description">Your apply was sent to our.</div>
        </div>
      </div>
      <div class="completed step">
        <div class="content">
          <div class="title">Processing</div>
          <div class="description">Your apply will be processed by a staff member.</div>
        </div>
      </div>
      <div class="completed step">
        <div class="content">
          <div class="title">Result</div>
          <div class="description">You will receive the result of your application.</div>
        </div>
      </div>
    </div>
    <br>
    <h1 style="color: green">Applystatus: ACCEPTED</h1>';
        }
            }
          }
        }
      }
       ?>
    <?php
    include('../assets/includes/MinecraftUUID.php');
    if(!isset($_SESSION["uuid"])){
      $profile = ProfileUtils::getProfile($_SESSION["username"]);
      if ($profile != null) {
        $result = $profile->getProfileAsArray();
        $uuid = ProfileUtils::formatUUID($result['uuid']);
        $_SESSION["uuid"] = $uuid;
      }
    } else {
      $uuid = $_SESSION["uuid"];
    }
    if($uuid == ""){
      $uuid = "8667ba71-b85a-4004-af54-457a9734eed7";
    }
    echo '<h1 class="ui header">
    <img class="ui medium circular image" src="https://crafatar.com/avatars/'.$uuid.'">
    '.$_SESSION["username"].'
    <h3>Apply as: ';
    include('../database.php');
    $user = $_SESSION["username"];
    $abfrage = "SELECT username FROM supporter WHERE username = '$user'";
    $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
    $data = 0;
    while($row = mysqli_fetch_object($ergebnis)){
      $data++;
    }
    if($data != 0){
      echo "Supporter";
    } else {
      $abfrage = "SELECT username FROM developer WHERE username = '$user'";
      $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
      $data = 0;
      while($row = mysqli_fetch_object($ergebnis)){
        $data++;
      }
      if($data != 0){
        echo "Developer";
      } else {
        $abfrage = "SELECT username FROM developer WHERE username = '$user'";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
        $data = 0;
        while($row = mysqli_fetch_object($ergebnis)){
          $data++;
        }
        if($data != 0){
          echo "Builder";
        }
      }
    }
    echo '</h3>
    <h3>Apply at the: ';
    include('../database.php');
    $user = $_SESSION["username"];
    $abfrage = "SELECT created_at FROM supporter WHERE username = '$user'";
    $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
    $data = 0;
    while($row = mysqli_fetch_object($ergebnis)){
      $data++;
    }
    if($data != 0){
      $abfrage = "SELECT created_at FROM supporter WHERE username = '$user'";
      $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
      while($row = mysqli_fetch_array($ergebnis)){
        echo date("D dS M Y", $row["created_at"]);
      }
    } else {
      $abfrage = "SELECT created_at FROM developer WHERE username = '$user'";
      $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
      $data = 0;
      while($row = mysqli_fetch_object($ergebnis)){
        $data++;
      }
      if($data != 0){
        $abfrage = "SELECT created_at FROM developer WHERE username = '$user'";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
        while($row = mysqli_fetch_array($ergebnis)){
          echo date("D dS M Y", $row["created_at"]);
        }
      } else {
        $abfrage = "SELECT created_at FROM builder WHERE username = '$user'";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
        $data = 0;
        while($row = mysqli_fetch_object($ergebnis)){
          $data++;
        }
        if($data != 0){
          $abfrage = "SELECT created_at FROM builder WHERE username = '$user'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          while($row = mysqli_fetch_array($ergebnis)){
            echo date("D dS M Y", $row["created_at"]);
          }
        }
      }
    }
    echo '</h3>
    </h1>';
     ?>
    </div>
  </div>
    </div>
  </body>
</html>
