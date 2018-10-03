<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Apply</title>
    <link rel="stylesheet" href="../assets/css/semantic.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
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
      <?php
      include('../database.php');
      if(isset($_GET["accept"]) & isset($_GET["type"])){
        $id = $_GET["accept"];
        $type = $_GET["type"];
        if($type == "sup"){
          $abfrage = "UPDATE supporter SET status = '2' WHERE id = '$id'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          echo '<div class="ui positive message">
  <div class="header">
    Success
  </div>
  <p>You have accepted the apply.</p>
</div>';
        } else if($type == "dev"){
          $abfrage = "UPDATE developer SET status = '2' WHERE id = '$id'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          echo '<div class="ui positive message">
  <div class="header">
    Success
  </div>
  <p>You have accepted the apply.</p>
</div>';
        } else if($type == "builder"){
          $abfrage = "UPDATE builder SET status = '2' WHERE id = '$id'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          echo '<div class="ui positive message">
  <div class="header">
    Success
  </div>
  <p>You have accept the apply.</p>
</div>';
        }
      }
      if(isset($_GET["deny"]) & isset($_GET["type"])){
        $id = $_GET["deny"];
        $type = $_GET["type"];
        if($type == "sup"){
          $abfrage = "UPDATE supporter SET status = '1' WHERE id = '$id'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          echo '<div class="ui positive message">
  <div class="header">
    Success
  </div>
  <p>You have deny the apply.</p>
</div>';
        } else if($type == "dev"){
          $abfrage = "UPDATE developer SET status = '1' WHERE id = '$id'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          echo '<div class="ui positive message">
  <div class="header">
    Success
  </div>
  <p>You have deny the apply.</p>
</div>';
        } else if($type == "builder"){
          $abfrage = "UPDATE builder SET status = '1' WHERE id = '$id'";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          echo '<div class="ui positive message">
  <div class="header">
    Success
  </div>
  <p>You have deny the apply.</p>
</div>';
        }
      }
      if(isset($_GET["id"]) & isset($_GET["type"])){
        $type = $_GET["type"];
        $id = $_GET["id"];
        if($type == "sup"){
          $abfrage = "SELECT * FROM supporter WHERE id = '$id';";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          while($row = mysqli_fetch_array($ergebnis)){
            echo '<h1>View Apply #'.$row["id"].' | Supporter apply</h1>
            <br>';
            if($row["status"] == "0"){
              echo '<a class="ui inverted green button" href="apply.php?accept='.$row["id"].'&type=sup">Accept</a>
              <a class="ui inverted red button" href="apply.php?deny='.$row["id"].'&type=sup">Deny</a>';
            } else if($row["status"] == "1"){
              echo '<h4 style="color: red">Apply rejected</h4>';
            } else if($row["status"] == "2"){
              echo '<h4 style="color: green">Apply accepted</h4>';
            }
            echo '<h3>What is your name?</h3>
            <p>'.$row["name"].'</p>
            <h3>What is your name in Minecraft?</h3>
            <p>'.$row["username"].'</p>
            <h3>How old are you?</h3>
            <p>'.$row["age"].'</p>
            <h3>Email</h3>
            <p>'.getEmailByUsername($row["username"]).'</p>
            <h3>What languages do you speak?</h3>
            <p>'.$row["lang"].'</p>
            <h3>How many weeks do you can spend in the server?</h3>
            <p>'.$row["onlinetime"].'</p>
            <h3>Why did you apply to us?</h3>
            <p>'.$row["why"].'</p>
            <h3>Do you have experience in supporting?</h3>
            <p>'.$row["experience"].'</p>
            <h3>Others</h3>';
            if($row["others"] == ""){
              echo '<p style="color: red">No data from the user given.</p>';
            } else {
              echo '<p>'.$row["others"].'</p>';
            }
            echo "<br>";
          }
        } else if($type == "dev"){
          $abfrage = "SELECT * FROM developer WHERE id = '$id';";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          while($row = mysqli_fetch_array($ergebnis)){
            echo '<h1>View Apply #'.$row["id"].' | Developer apply</h1>
            <br>';
            if($row["status"] == "0"){
              echo '<a class="ui inverted green button" href="apply.php?accept='.$row["id"].'&type=dev">Accept</a>
              <a class="ui inverted red button" href="apply.php?deny='.$row["id"].'&type=dev">Deny</a>';
            } else if($row["status"] == "1"){
              echo '<h4 style="color: red">Apply rejected</h4>';
            } else if($row["status"] == "2"){
              echo '<h4 style="color: green">Apply accepted</h4>';
            }
            echo '<br>
            <h3>What is your name?</h3>
            <p>'.$row["name"].'</p>
            <h3>What is your name in Minecraft?</h3>
            <p>'.$row["username"].'</p>
            <h3>How old are you?</h3>
            <p>'.$row["age"].'</p>
            <h3>Email</h3>
            <p>'.getEmailByUsername($row["username"]).'</p>
            <h3>Since when do you develop?</h3>
            <p>'.$row["since"].'</p>
            <h3>What programming languages do you use?</h3>
            <p>'.$row["lang"].'</p>
            <h3>How many weeks do you can spend in the server?</h3>
            <p>'.$row["online"].'</p>
            <h3>Why did you apply to us?</h3>
            <p>'.$row["why"].'</p>
            <h3>Do you have experience in developing?</h3>
            <p>'.$row["experience"].'</p>
            <h3>Others</h3>';
            if($row["others"] == ""){
              echo '<p style="color: red">No data from the user given.</p>';
            } else {
              echo '<p>'.$row["others"].'</p>';
            }
            echo "<br>";
            echo "<h1>Comments</h1><p>Do you want to share your opinion with the team? Write a comment and say if you want to accept or deny the apply.</p><br>";

            if(!hasAlreadyCommented($_SESSION["username"], $id, $type)){
              echo '<form action="apply.php?submitcomment" method="post">
                <h3>Your opinion</h3>
                <select name="opinion">
                  <option value="1">Accept</option>
                  <option value="0">Deny</option>
                </select><br>
                <h3>Your comment</h3>
                <textarea name="comment" rows="8" cols="95"></textarea><br>
                <input type="hidden" name="type" value="'.$type.'">
                <input type="hidden" name="applyid" value="'.$id.'">
                <button type="submit" class="myButton">Comment</button><br>
                <br>
              </form>';
            } else {
              echo "<p><strong>You have already commented the apply.</strong></p>";
            }

            showComments($id, $type);
          }
        } else if($type == "builder"){
          $abfrage = "SELECT * FROM builder WHERE id = '$id';";
          $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
          while($row = mysqli_fetch_array($ergebnis)){
            echo '<h1>View Apply #'.$row["id"].' | Builder apply</h1>
            <br>';
            if($row["status"] == "0"){
              echo '<a class="ui inverted green button" href="apply.php?accept='.$row["id"].'&type=builder">Accept</a>
              <a class="ui inverted red button" href="apply.php?deny='.$row["id"].'&type=builder">Deny</a>';
            } else if($row["status"] == "1"){
              echo '<h4 style="color: red">Apply rejected</h4>';
            } else if($row["status"] == "2"){
              echo '<h4 style="color: green">Apply accepted</h4>';
            }
            echo '<h3>What is your name?</h3>
            <p>'.$row["name"].'</p>
            <h3>What is your name in Minecraft?</h3>
            <p>'.$row["username"].'</p>
            <h3>How old are you?</h3>
            <p>'.$row["age"].'</p>
            <h3>Email</h3>
            <p>'.getEmailByUsername($row["username"]).'</p>
            <h3>Since when do you build?</h3>
            <p>'.$row["since"].'</p>
            <h3>How many weeks do you can spend in the server?</h3>
            <p>'.$row["online"].'</p>
            <h3>Why did you apply to us?</h3>
            <p>'.$row["why"].'</p>
            <h3>Do you have experience in building from other servers?</h3>
            <p>'.$row["experience"].'</p>
            <h3>Enter here imagelinks from your buildings?</h3>
            <p>'.$row["example"].'</p>
            <h3>Others</h3>';
            if($row["others"] == ""){
              echo '<p style="color: red">No data from the user given.</p>';
            } else {
              echo '<p>'.$row["others"].'</p>';
            }
            echo "<br>";
          }
        } else {
          echo '<h1 style="color: red">Wrong apply type was given.</h1>';
        }
      } else if(isset($_GET["submitcomment"])){
        if(isset($_POST["comment"]) && isset($_POST["opinion"]) && isset($_POST["applyid"]) && isset($_POST["type"])){
          insertComment($_POST["comment"], $_POST["opinion"], $_POST["applyid"], $_POST["type"], $_SESSION["username"]);
          header('Location: apply.php?id='.$_POST["applyid"].'&type='.$_POST["type"]);
        } else {
          echo "No comment was submitted";
        }
      } else {
        if(!isset($_GET["accept"]) & !isset($_GET["deny"])){
          echo '<h1 style="color: red">No application was requested.</h1>';
        }
      }
       ?>
    </div>
  </body>
</html>
