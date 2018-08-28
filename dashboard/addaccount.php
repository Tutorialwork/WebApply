<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Account</title>
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
      <h1>Add Account</h1>
      <br>
      <?php
      if(isset($_POST["submit"])){
        include('../database.php');
        $user = mysqli_real_escape_string($mysqli, $_POST["username"]);
        $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
        $pw = mysqli_real_escape_string($mysqli, $_POST["password"]);
        $pw2 = mysqli_real_escape_string($mysqli, $_POST["password2"]);
        if($pw == $pw2){
          if(!isEmailExist($email)){
            if(!isUsernameExist($user)){
              $time = time();
              $hashpw = password_hash($pw, PASSWORD_BCRYPT);
              $rank = $_POST["rank"];
              $abfrage = "INSERT INTO accounts (username, email, password, rank, ban, token, created_at, lastlogin) VALUES ('$user', '$email', '$hashpw', '$rank', '0', 'null', '$time', 'null')";
              $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
              echo '<div class="ui icon success message">
                  <i class="add user icon"></i>
                  <div class="content">
                    <div class="header">
                      Success!
                    </div>
                    <p>Account created.</p>
                  </div>
                </div>';
            } else {
              echo '<div class="ui icon warning message">
                <i class="bell icon"></i>
                <div class="content">
                  <div class="header">
                    Failed!
                  </div>
                  <p>Username exist already!</p>
                </div>
              </div>';
              }
          } else {
            echo '<div class="ui icon warning message">
              <i class="bell icon"></i>
              <div class="content">
                <div class="header">
                  Failed!
                </div>
                <p>Email exist already!</p>
              </div>
            </div>';
            }
        } else {
          echo '<div class="ui icon warning message">
              <i class="bell icon"></i>
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
      <form class="ui form" action="addaccount.php" method="post">
        <div class="field">
          <label>Username</label>
          <input type="text" name="username" placeholder="Username">
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
        <div class="field">
          <label>Rank</label>
          <select name="rank">
            <option value="2">Admin</option>
            <option value="1">Team</option>
          </select>
        </div>
        <button type="submit" name="submit" class="ui primary labeled icon button">
          <i class="add user alternate icon"></i>
          Create</button>
      </form>
    </div>
  </body>
</html>
