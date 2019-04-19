<?php
if(!file_exists("mysql.php")){
  header("Location: setup/index.php");
  exit;
}
require("datamanager.php");
require('assets/languages/lang_'.getSetting("lang").'.php');
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
    <title><?php echo INDEX_HEADLINE; ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  </head>
  <body>
    <div class="content">
      <h1><?php echo INDEX_HEADLINE; ?></h1>
      <p><?php echo INDEX_DESC; ?>
      </p>
      <hr>
      <p><br>
      <a href="apply.php?type=supporter" class="btn">Supporter</a>
      <a href="apply.php?type=developer" class="btn">Developer</a>
      <a href="apply.php?type=builder" class="btn">Builder</a>
      <a href="login.php" class="loginicon"><i class="fas fa-sign-in-alt"></i></a>
    </div>
  </body>
</html>
