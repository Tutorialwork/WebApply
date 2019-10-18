<?php
if(!file_exists("mysql.php")){
  header("Location: setup/index.php");
  exit;
}
session_start();
require("datamanager.php");
require('assets/languages/lang_'.getSetting("lang").'.php');
if(!isset($_SESSION["username"])){
  ?>
  <meta http-equiv="refresh" content="0; URL=login.php">
  <?php
  exit;
}
 ?>
 <!--
   Created by Tutorialwork
   https://YouTube.com/Tutorialwork
   © 2019 - WebApply
 -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo SETTINGS ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/toast.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="assets/js/toast.min.js" charset="utf-8"></script>
  </head>
  <body>
    <?php
    if(isset($_POST["submit"])){
      if(empty($_POST["pw"])){
        require("mysql.php");
        $stmt = $mysql->prepare("UPDATE accounts SET EMAIL = :mail WHERE USERNAME = :user");
        $stmt->bindParam(":mail", $_POST["email"], PDO::PARAM_STR);
        $stmt->bindParam(":user", $_SESSION["username"], PDO::PARAM_STR);
        $stmt->execute();
        displayToast('success', SAVE_MESSAGE_SUCCESS_TITLE, SAVE_MESSAGE_SUCCESS);
      } else {
        $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
        require("mysql.php");
        $stmt = $mysql->prepare("UPDATE accounts SET EMAIL = :mail, PASSWORD = :pw WHERE USERNAME = :user");
        $stmt->bindParam(":mail", $_POST["email"], PDO::PARAM_STR);
        $stmt->bindParam(":user", $_SESSION["username"], PDO::PARAM_STR);
        $stmt->bindParam(":pw", $hash, PDO::PARAM_STR);
        $stmt->execute();
        displayToast('success', SAVE_MESSAGE_SUCCESS_TITLE, SAVE_MESSAGE_SUCCESS);
      }
    }
     ?>
    <div class="content">
      <h1><?php echo SETTINGS ?></h1>
      <hr>
      <form action="usersettings.php" method="post">
        <p><?php echo USERNAME; ?></p>
        <input type="text" name="username" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>" disabled>
        <p>Email</p>
        <input type="email" name="email" value="<?php echo getEmail($_SESSION["username"]); ?>" placeholder="Email" required>
        <p><?php echo CHANGE_PASSWORD; ?></p>
        <input type="password" name="pw" placeholder="<?php echo NEWPW_FORM; ?>">
        <button type="submit" name="submit"><?php echo SAVE ?></button>
      </form>
      <p></p>
      <br>
      <a href="logout.php" class="btn">Logout</a>
      <a href="admincontrolpanel.php" class="loginicon"><i class="fas fa-arrow-left"></i></a>
    </div>
  </body>
</html>
