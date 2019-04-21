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
} else if(getRankID($_SESSION["username"]) > 0){
  ?>
  <meta http-equiv="refresh" content="0; URL=admincontrolpanel.php">
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
    <title><?php echo PANEL_HEADLINE ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  </head>
  <body>
    <div class="content">
      <h1>Hey, <?php echo $_SESSION["username"] ?></h1>
      <hr>
      <h5><i class="fas fa-paper-plane"></i> <?php echo PANEL_HEADLINE ?></h5>
      <?php
      if(getApplyStatus(getApplyByAccountID(getAccountIDByUsername($_SESSION["username"]))) == 0){
        echo PANEL_NEUTRAL;
      } else if(getApplyStatus(getApplyByAccountID(getAccountIDByUsername($_SESSION["username"]))) == 1){
        ?>
        <img src="assets/images/cross.png" alt="icon" id="status">
        <?php echo PANEL_NEGATIVE ?>
        <?php
      } else if(getApplyStatus(getApplyByAccountID(getAccountIDByUsername($_SESSION["username"]))) == 2){
        ?>
        <img src="assets/images/tick.png" alt="icon" id="status">
        <?php echo PANEL_POSITIVE ?>
        <p><i class="fas fa-calendar"></i> <?php echo INTERVIEW; ?>: <?php
        $timestamp = strtotime(getInterviewdate(getApplyByAccountID(getAccountIDByUsername($_SESSION["username"]))));
        echo displayTimestamp($timestamp);
        ?>
          <?php
          if(getSetting("tsip") != "YourTSIP.com"){
            $ts = str_replace(' ', '', getSetting("tsip"));
            ?>
            <a href="ts3server://<?php echo $ts; ?>" class="loginicon"><i class="fab fa-teamspeak"></i></i></a>
            <?php
          }
          ?>
        </p>
        <?php
      }
       ?>
      <br><br>
      <a href="logout.php" class="btn">Logout</a>
      <a href="usersettings.php" class="loginicon"><i class="fas fa-user-cog"></i></a>
    </div>
  </body>
</html>
