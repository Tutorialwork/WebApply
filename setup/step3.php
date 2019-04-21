<?php
if(file_exists("../mysql.php")){
  header("Location: ../index.php");
  exit;
}
require("../datamanager.php");
session_start();
if(isset($_SESSION["host"]) && isset($_SESSION["database"]) &&
isset($_SESSION["user"]) && isset($_SESSION["password"])){
  if(isset($_POST["submit"])){
    $mysqlfile = fopen("../mysql.php", "w");
    if(!$mysqlfile){
      ?>
      <head>
        <meta charset="utf-8">
        <title>Setup</title>
        <link rel="stylesheet" href="../assets/css/main.css">
      </head>
      <body>
        <div class="content">
          <img src="../assets/images/cross.png" alt="cross" id="status">
          <h1>Error</h1>
          <p>Installation failed. Reason: Can't write mysql.php <br>
          Please make sure that the WebApply folder is writable.</p>
          <br>
          <a href="step3.php" class="btn">Try again</a>
        </div>
      </body>
      <?php
      exit;
    }
    echo fwrite($mysqlfile, '
    <?php
    $host = "'.$_SESSION["host"].'";
    $name = "'.$_SESSION["database"].'";
    $user = "'.$_SESSION["user"].'";
    $passwort = "'.$_SESSION["password"].'";
    try{
        $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
    } catch (PDOException $e){

    }
    ?>
    ');
    fclose($mysqlfile);
    session_destroy();
    setSetting("lang", $_POST["lang"]);
    setSetting("name", $_POST["servername"]);
    setSetting("tsip", $_POST["tsip"]);
    ?>
    <meta http-equiv="refresh" content="0; URL=../index.php">
    <?php
    exit;
  }
} else {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Setup</title>
    <link rel="stylesheet" href="../assets/css/main.css">
  </head>
  <body>
    <div class="content">
      <h1>Setup</h1>
      <p>Welcome to the setup of WebApply. Thanks that you choose my plugin.
      Before you can start you must be setup the system.</p>
      <h5>Settings</h5>
      <form action="step3.php" method="post">
        <select name="lang">
          <option value="en">English</option>
          <option value="de">German (Deutsch)</option>
        </select>
        <input type="text" name="servername" placeholder="Servername" required>
        <input type="text" name="tsip" placeholder="Your Teamspeak IP">
        <button type="submit" name="submit">Finish</button>
      </form>
    </div>
  </body>
</html>
