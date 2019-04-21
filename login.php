<?php
if(!file_exists("mysql.php")){
  header("Location: setup/index.php");
  exit;
}
session_start();
if(isset($_SESSION["username"])){
  ?>
  <meta http-equiv="refresh" content="0; URL=admincontrolpanel.php">
  <?php
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
    <title><?php echo LOGINFORM_BUTTON; ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/toast.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="assets/js/toast.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="assets/css/jquery.sweet-modal.min.css" />
    <script src="assets/js/jquery.sweet-modal.min.js"></script>
  </head>
  <body>
    <?php
    if(isset($_POST["submit"])){
      require("mysql.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
      $stmt->bindParam(":user", $_POST["username"], PDO::PARAM_STR);
      $stmt->execute();
      $data = 0;
      while ($row = $stmt->fetch()) {
        $data++;
      }
      if($data != 0){
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
        $stmt->bindParam(":user", $_POST["username"], PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          if(password_verify($_POST["password"], $row["PASSWORD"])){
            $_SESSION["username"] = $row["USERNAME"];
            updateLogin($row["USERNAME"]);
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
            toastr.success('<?php echo MESSAGE_SUCCESS; ?>', '<?php echo MESSAGE_SUCCESS_TITLE; ?>');
            </script>
            <?php
            if($row["USERRANK"] > 1){
              ?>
              <meta http-equiv="refresh" content="1; URL=admincontrolpanel.php">
              <?php
              exit;
            } else {
              ?>
              <meta http-equiv="refresh" content="1; URL=userpanel.php">
              <?php
              exit;
            }
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
            toastr.error('<?php echo MESSAGE_FAILED; ?>', '<?php echo MESSAGE_FAILED_TITLE; ?>');
            </script>
            </div>
            <?php
          }
        }
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
        toastr.error('<?php echo MESSAGE_FAILED; ?>', '<?php echo MESSAGE_FAILED_TITLE; ?>');
        </script>
        <?php
      }
    }
     ?>
    <div class="content">
      <noscript>
        Please enable Javascript.
      </noscript>
      <?php
      if(isset($_POST["resetsubmit"])){
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :mail");
        $stmt->bindParam(":mail", $_POST["email"], PDO::PARAM_STR);
        $stmt->execute();
        $data = 0;
        while ($row = $stmt->fetch()) {
          $data++;
        }
        if($data != 0){
          setResetToken($_POST["email"], $token);
          $headers = "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
          $mail = mail($_POST["email"], EMAIL_TITLE, EMAIL, $headers);
          if(!$mail){
            ?>
            <img src="assets/images/cross.png" alt="cross" id="status">
            <?php echo SENDMAIL_ERR; ?>
            <form>
              <input type="text" value="apt-get install sendmail">
            </form>
            <?php
            exit;
          }
          ?>
          <script type="text/javascript">
          $.sweetModal({
            content: '<?php echo FORGOT_EMAIL_OK; ?>',
            icon: $.sweetModal.ICON_SUCCESS
          });
          </script>
          <?php
        } else {
          ?>
          <script type="text/javascript">
          $.sweetModal({
            content: '<?php echo FORGOT_EMAIL_ERR; ?>',
            icon: $.sweetModal.ICON_ERROR,
            onClose: function(){
              window.location = "login.php?forgot";
            }
          });
          </script>
          <?php
        }
        exit;
      }
      if(isset($_GET["forgot"])){
        ?>
        <h1><?php echo FORGOT_TITLE; ?></h1>
        <form action="login.php" method="post">
          <input type="email" name="email" placeholder="Email" required>
          <button type="submit" name="resetsubmit"><?php echo FORGOT_BUTTON; ?></button>
        </form>
        <br>
        <a href="login.php" class="loginicon"><i class="fas fa-arrow-left"></i></a>
        <?php
        exit;
      }
      if(isset($_GET["token"]) && isset($_GET["email"])){
        if(isset($_POST["pwchangesubmit"])){
          if($_POST["pw1"] == $_POST["pw2"]){
            $dbtoken = getResetToken($_POST["email"]);
            if($dbtoken == $_POST["token"]){
              require("mysql.php");
              $hash = password_hash($_POST["pw1"], PASSWORD_BCRYPT);
              $stmt = $mysql->prepare("UPDATE accounts SET TOKEN = null, PASSWORD = :pw WHERE EMAIL = :mail");
              $stmt->bindParam(":pw", $hash, PDO::PARAM_STR);
              $stmt->bindParam(":mail", $_POST["email"], PDO::PARAM_STR);
              $stmt->execute();
              ?>
              <script type="text/javascript">
              $.sweetModal({
              	content: '<?php echo NEWPW_SUCCESS; ?>',
              	icon: $.sweetModal.ICON_SUCCESS,
                onClose: function(){
                  window.location = "login.php";
                }
              });
              </script>
              <?php
            } else {
              displayToast("error", NEWPW_ERR_AUTH_TITLE, NEWPW_ERR_AUTH);
            }
          } else {
            displayToast("error", NEWPW_ERR_PW_TITLE, NEWPW_ERR_PW);
          }
        }
        $dbtoken = getResetToken($_GET["email"]);
        if($dbtoken == $_GET["token"]){
          ?>
          <h1><?php echo NEWPW_TITLE; ?></h1>
          <form action="login.php?token=<?php echo $_GET["token"]."&email=".$_GET["email"] ?>" method="post">
            <p><?php echo NEWPW_YOURACC; ?>: <strong><?php echo getUsernameByEmail($_GET["email"]) ?></strong> </p>
            <input type="password" name="pw1" placeholder="<?php echo NEWPW_PW1; ?>" required>
            <input type="password" name="pw2" placeholder="<?php echo NEWPW_PW2; ?>" required>
            <button type="submit" name="pwchangesubmit"><?php echo NEWPW_BUTTON; ?></button>
            <input type="hidden" name="token" value="<?php echo $dbtoken ?>">
            <input type="hidden" name="email" value="<?php echo $_GET["email"]; ?>">
          </form>
          <?php
        } else {
          ?>
          <div class="error">
            <?php echo NEWPW_ERR; ?>
          </div>
          <?php
        }
        exit;
      }
       ?>
      <h1><?php echo LOGINFORM_BUTTON; ?></h1>
      <form action="login.php" method="post">
        <input type="text" name="username" placeholder="<?php echo LOGINFORM_USERNAME; ?>" required>
        <input type="password" name="password" placeholder="<?php echo LOGINFORM_PASSWORD; ?>" required>
        <button type="submit" name="submit"><?php echo LOGINFORM_BUTTON; ?></button>
      </form>
      <p></p>
      <a href="login.php?forgot" id="pw"><?php echo LOGINFORM_FORGOT; ?></a>
    </div>
  </body>
</html>
