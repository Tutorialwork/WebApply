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
} else if(getRankID($_SESSION["username"]) < 2){
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
      if(!empty($_POST["servername"])){
        setSetting("name", $_POST["servername"]);
        setSetting("lang", $_POST["lang"]);
        setSetting("sup", $_POST["sup"]);
        setSetting("dev", $_POST["dev"]);
        setSetting("builder", $_POST["builder"]);
        setSetting("age", $_POST["age"]);
        setSetting("tsip", $_POST["ts"]);
        ?>
        <script type="text/javascript">
        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        toastr.success('<?php echo SAVE_MESSAGE_SUCCESS ?>', '<?php echo SAVE_MESSAGE_SUCCESS_TITLE ?>');
        </script>
        <?php
      } else {
        ?>
        <script type="text/javascript">
        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        toastr.error('<?php echo SAVE_MESSAGE_FAILED ?>', '<?php echo SAVE_MESSAGE_FAILED_TITLE ?>');
        </script>
        <?php
      }
    }
     ?>
    <div class="content">
      <h1><?php echo SETTINGS ?></h1>
      <hr>
      <form action="settings.php" method="post">
        <?php
        //Fixed whitespaces
        $name = str_replace(' ', '', getSetting("name"));
        $age = str_replace(' ', '', getSetting("age"));
        $ts = str_replace(' ', '', getSetting("tsip"));
         ?>
        <p><?php echo SERVERNAME ?></p>
        <input type="text" name="servername" placeholder="<?php echo SERVERNAME ?>" value="<?php echo htmlspecialchars($name); ?>" required>
        <p>Teamspeak 3 IP</p>
        <input type="text" name="ts" placeholder="IP" value="<?php echo htmlspecialchars($ts); ?>" required>
        <p><?php echo MINAGE; ?></p>
        <input type="text" name="age" placeholder="<?php echo FORM_AGE; ?>" value="<?php echo htmlspecialchars($age); ?>" required>
        <p><?php echo LANGUAGE ?></p>
        <select name="lang">
          <?php
          if(getSetting("lang") == "en"){
            ?>
            <option value="en">English</option>
            <option value="de">German (Deutsch)</option>
            <?php
          } else {
            ?>
            <option value="de">German (Deutsch)</option>
            <option value="en">English</option>
            <?php
          }
           ?>
        </select>
        <p><?php echo SUP_APPLY ?></p>
        <select name="sup">
          <?php
          if(getSetting("sup") == "true"){
            ?>
            <option value="true"><?php echo ENABLED ?></option>
            <option value="false"><?php echo DISABLED ?></option>
            <?php
          } else {
            ?>
            <option value="false"><?php echo DISABLED ?></option>
            <option value="true"><?php echo ENABLED ?></option>
            <?php
          }
           ?>
        </select>
        <p><?php echo DEV_APPLY ?></p>
        <select name="dev">
          <?php
          if(getSetting("dev") == "true"){
            ?>
            <option value="true"><?php echo ENABLED ?></option>
            <option value="false"><?php echo DISABLED ?></option>
            <?php
          } else {
            ?>
            <option value="false"><?php echo DISABLED ?></option>
            <option value="true"><?php echo ENABLED ?></option>
            <?php
          }
           ?>
        </select>
        <p><?php echo BUILDER_APPLY ?></p>
        <select name="builder">
          <?php
          if(getSetting("builder") == "true"){
            ?>
            <option value="true"><?php echo ENABLED ?></option>
            <option value="false"><?php echo DISABLED ?></option>
            <?php
          } else {
            ?>
            <option value="false"><?php echo DISABLED ?></option>
            <option value="true"><?php echo ENABLED ?></option>
            <?php
          }
           ?>
        </select>
        <button type="submit" name="submit"><?php echo SAVE ?></button>
      </form>
      <p></p>
      <br>
      <a href="logout.php" class="btn">Logout</a>
      <a href="admincontrolpanel.php" class="loginicon"><i class="fas fa-arrow-left"></i></a>
    </div>
  </body>
</html>
