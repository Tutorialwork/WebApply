<?php
if(file_exists("../mysql.php")){
  header("Location: ../index.php");
  exit;
}
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Setup</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/toast.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="../assets/js/toast.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  </head>
  <body>
    <?php
    if(isset($_POST["submit"])){
      $host = $_POST["host"];
      $name = $_POST["database"];
      $user = $_POST["user"];
      $passwort = $_POST["password"];
      try{
          $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
          $_SESSION["host"] = $_POST["host"];
          $_SESSION["database"] = $_POST["database"];
          $_SESSION["user"] = $_POST["user"];
          $_SESSION["password"] = $_POST["password"];
          ?>
          <meta http-equiv="refresh" content="0; URL=step2.php">
          <?php
          exit;
      } catch (PDOException $e){
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
          toastr.error("Unable to connect to the MySQL database.", "MySQL error");
          </script>
          <?php
      }
    }
     ?>
    <div class="content">
      <?php
      require("../datamanager.php");
      $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      if(!strpos($url, "bplaced")){
        if(file_get_contents("https://api.spigotmc.org/legacy/update.php?resource=60292") != WEBAPPLY_VERSION){
          ?>
          <img src="../assets/images/cross.png" alt="cross" id="status">
          <h1>Update</h1>
          <p>You currently have the version <strong><?php echo WEBAPPLY_VERSION ?></strong>. <br>
          Please download the latest version of WebApply to get all new awesome features.</p>
          <br>
          <a href="https://www.spigotmc.org/resources/webapply.60292/" class="btn">Update</a>
          <?php
          exit;
        }
      } else {
        //Bplaced blocks file_get_contents function
        //Skip update checker
        ?>
        <div class="error">
          Bplaced is blocking the update checker. You use currently <strong><?php echo WEBAPPLY_VERSION; ?></strong>, please check manually if this is the newest version.
        </div>
        <?php
      }
       ?>
      <h1>Setup</h1>
      <p>Welcome to the setup of WebApply. Thanks that you choose my plugin.
      Before you can start you must be setup the system.</p>
      <?php
      //FOLDER WRITEABLE
      //SENDMAIL SUPP?
      //WebApply VERSIION?
      /*$mysqlfile = fopen("../mysql.php", "w");
      if(!$mysqlfile){
        echo "Failed";
      } else {
        echo "OK";
      }
      echo phpversion();

if ( function_exists( 'mail' ) )
{
    echo 'mail() is available';
    mail("tutorialworktv@gmail.com", "mail() is working", "PHP Mail");
}
else
{
    echo 'mail() has been disabled';
}*/
?>
      <h5>MySQL Database</h5>
      <form action="index.php" method="post">
        <input type="text" name="host" value="localhost" required>
        <input type="text" name="database" placeholder="Database" required>
        <input type="text" name="user" placeholder="User" required>
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="submit">Continue</button>
      </form>
    </div>
  </body>
</html>
