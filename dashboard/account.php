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

    include('../database.php');
    $abfrage = "CREATE TABLE IF NOT EXISTS profileimages(
id INT(6) UNIQUE,
username VARCHAR(255),
url VARCHAR(255),
updated_at VARCHAR(255)
)";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
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
              $abfrage = "UPDATE accounts SET password = '$hash' WHERE username = '$user'";
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
      if(isset($_POST["pb"])){
        $upload_folder = '../assets/images/profileimages/';
$filename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
if(!in_array($extension, $allowed_extensions)) {
 die('<div class="ui red message">You can only upload images with the .png, .jpg, .jpeg and .gif extensions.</div><a href="account.php" class="ui inverted red button">Return</a>');
}

$max_size = 2500*1024;
if($_FILES['file']['size'] > $max_size) {
 die('<div class="ui red message">The image is too big it may be a maximum of 2 MB.</div><a href="account.php" class="ui inverted red button">Return</a>');
}

if(function_exists('exif_imagetype')) {
 $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
 $detected_type = exif_imagetype($_FILES['file']['tmp_name']);
 if(!in_array($detected_type, $allowed_types)) {
 die('<div class="ui red message">You can only upload images.</div><a href="account.php" class="ui inverted red button">Return</a>');
 }
}

$new_path = $upload_folder.$filename.'.'.$extension;

if(file_exists($new_path)) {
 $id = 1;
 do {
 $new_path = $upload_folder.$filename.'_'.$id.'.'.$extension;
 $id++;
 } while(file_exists($new_path));
}

move_uploaded_file($_FILES['file']['tmp_name'], $new_path);
$time = time();
$user = $_SESSION["username"];
$abfrage = "UPDATE profileimages SET url = '$new_path', updated_at = '$time' WHERE username = '$user'";
$ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
      }
      if(isset($_GET["deletepb"])){
        $time = time();
        $user = $_SESSION["username"];
        $abfrage = "UPDATE profileimages SET url = 'null', updated_at = '$time' WHERE username = '$user'";
        $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
        echo '<div class="ui green message">Your Profile Image was removed.</div>';
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
      <?php
      if(getRank($_SESSION["username"]) != "0"){
        echo '<br>
        <h1>Profile Image</h1>
        <p>In this section you can upload simply a profile image select you must be only the image and done.</p>
        <br>
        <h3>Current Profile Image</h3>';
        if(hasPB($_SESSION["username"])){
          echo '<img class="ui circular image" src="'.getPBUrl($_SESSION["username"]).'" width="100" height="100">';
        } else {
          echo '<img class="ui circular image" src="https://i.imgur.com/BS1pqFp.jpg" width="100" height="100">';
        }
        echo '<br><br>
        <form class="" action="account.php" method="post" enctype="multipart/form-data">
          <input type="file" name="file" required><br><br>
          <button type="submit" name="pb" class="ui primary button">Upload</button>
        </form>
        <br>';
        if(hasPB($_SESSION["username"])){
          echo '<a class="ui red inverted button" href="account.php?deletepb">Delete Profile Image</a>';  
        }
      }
      ?>
    </div>
  </div>
    </div>
  </body>
</html>
