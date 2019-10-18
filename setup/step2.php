<?php
if(file_exists("../mysql.php")){
  header("Location: ../index.php");
  exit;
}
session_start();
if(isset($_SESSION["host"]) && isset($_SESSION["database"]) &&
isset($_SESSION["user"]) && isset($_SESSION["password"])){
  if(isset($_POST["submit"])){
    $host = $_SESSION["host"];
    $name = $_SESSION["database"];
    $user = $_SESSION["user"];
    $passwort = $_SESSION["password"];
    /////////////////////////////////////////////////
    try{
        $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
        $stmt = $mysql->prepare("CREATE TABLE IF NOT EXISTS accounts (
          ID INT(6) AUTO_INCREMENT UNIQUE,
          USERNAME VARCHAR(255),
          EMAIL VARCHAR(255),
          PASSWORD VARCHAR(255),
          USERRANK INT(11),
          LASTLOGIN VARCHAR(255),
          FIRSTLOGIN VARCHAR(255),
          TOKEN VARCHAR(255),
          REMEMBERTOKEN VARCHAR(255)
        )");
        $stmt->execute();
        $stmt2 = $mysql->prepare("CREATE TABLE IF NOT EXISTS settings (
          NAME VARCHAR(255) UNIQUE,
          VALUE VARCHAR(255)
        )");
        $stmt2->execute();
        $stmt3 = $mysql->prepare("CREATE TABLE IF NOT EXISTS applications (
          ID INT(6) AUTO_INCREMENT UNIQUE,
          ACCID INT(11),
          APPLYRANK VARCHAR(255),
          NAME VARCHAR(255),
          AGE INT(11),
          APPLICATION VARCHAR(14000),
          SUBMITDATE VARCHAR(255),
          STATUS INT(11),
          TEAMNAME VARCHAR(255),
          INTERVIEWDATE VARCHAR(255)
        )");
        $stmt3->execute();
        $acc = $mysql->prepare("INSERT INTO accounts (USERNAME, EMAIL, PASSWORD, USERRANK, LASTLOGIN, FIRSTLOGIN, TOKEN)
        VALUES (:user, :email, :pw, 3, :now, :now, null)");
        $acc->bindParam(":user", $_POST["username"], PDO::PARAM_STR);
        $acc->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
        $hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $acc->bindParam(":pw", $hash, PDO::PARAM_STR);
        $acc->bindParam(":now", time(), PDO::PARAM_STR);
        $acc->execute();
        $settings1 = $mysql->prepare("INSERT INTO settings (NAME, VALUE) VALUES ('lang', 'en')");
        $settings2 = $mysql->prepare("INSERT INTO settings (NAME, VALUE) VALUES ('name', 'YourServer')");
        $settings3 = $mysql->prepare("INSERT INTO settings (NAME, VALUE) VALUES ('sup', 'true')");
        $settings4 = $mysql->prepare("INSERT INTO settings (NAME, VALUE) VALUES ('dev', 'true')");
        $settings5 = $mysql->prepare("INSERT INTO settings (NAME, VALUE) VALUES ('builder', 'true')");
        $settings6 = $mysql->prepare("INSERT INTO settings (NAME, VALUE) VALUES ('age', '13')");
        $settings7 = $mysql->prepare("INSERT INTO settings (NAME, VALUE) VALUES ('tsip', 'YourTSIP.com')");
        $settings1->execute();
        $settings2->execute();
        $settings3->execute();
        $settings4->execute();
        $settings5->execute();
        $settings6->execute();
        $settings7->execute();
        header("Location: step3.php");
        exit;
    } catch (PDOException $e){
        ?>
        <!--
        <div class="error">
          Unable to connect to the MySQL database.
        </div>
        -->
        <script type="text/javascript">
          alert("Unable to connect to the MySQL database.");
        </script>
        <?php
    }
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
      <h5>Create Account</h5>
      <form action="step2.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit">Continue</button>
      </form>
    </div>
  </body>
</html>
