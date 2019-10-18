<?php
define("WEBAPPLY_VERSION", "2.1.3");
function getSetting($setting){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM settings WHERE NAME = :setting");
  $stmt->bindParam(":setting", $setting, PDO::PARAM_STR);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["VALUE"];
  }
}
function setSetting($setting, $value){
  require("mysql.php");
  $stmt = $mysql->prepare("UPDATE settings SET VALUE = :value WHERE NAME = :setting");
  $stmt->bindParam(":setting", $setting, PDO::PARAM_STR);
  $stmt->bindParam(":value", $value, PDO::PARAM_STR);
  $stmt->execute();
}
function getRankID($username){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
  $stmt->bindParam(":user", $username, PDO::PARAM_STR);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["USERRANK"];
  }
}
function getEmail($username){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
  $stmt->bindParam(":user", $username, PDO::PARAM_STR);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["EMAIL"];
  }
}
function existsUsername($username){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
  $stmt->bindParam(":user", $username, PDO::PARAM_STR);
  $stmt->execute();
  $data = 0;
  while ($row = $stmt->fetch()) {
    $data++;
  }
  if($data == 0){
    return false;
  } else {
    return true;
  }
}
function existsEmail($email){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :email");
  $stmt->bindParam(":email", $email, PDO::PARAM_STR);
  $stmt->execute();
  $data = 0;
  while ($row = $stmt->fetch()) {
    $data++;
  }
  if($data == 0){
    return false;
  } else {
    return true;
  }
}
function createAccount($username, $email, $password, $rank){
  require("mysql.php");
  $acc = $mysql->prepare("INSERT INTO accounts (USERNAME, EMAIL, PASSWORD, USERRANK, LASTLOGIN, FIRSTLOGIN, TOKEN)
  VALUES (:user, :email, :pw, :userrank, :now, :now, null)");
  $acc->bindParam(":user", $username, PDO::PARAM_STR);
  $acc->bindParam(":email", $email, PDO::PARAM_STR);
  $hash = password_hash($password, PASSWORD_BCRYPT);
  $acc->bindParam(":pw", $hash, PDO::PARAM_STR);
  $acc->bindParam(":now", time(), PDO::PARAM_STR);
  $acc->bindParam(":userrank", $rank, PDO::PARAM_INT);
  $acc->execute();
}
function getAccountIDByUsername($username){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
  $stmt->bindParam(":user", $username, PDO::PARAM_STR);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["ID"];
  }
}
function getUsernameByEmail($email){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :mail");
  $stmt->bindParam(":mail", $email, PDO::PARAM_STR);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["USERNAME"];
  }
}
function insertApply($type, $username, $name, $age, $apply){
  require("mysql.php");
  $stmt = $mysql->prepare("INSERT INTO applications (ACCID, APPLYRANK, NAME, AGE, APPLICATION, SUBMITDATE, STATUS, TEAMNAME,
  INTERVIEWDATE)
  VALUES (:accid, :type, :name, :age, :apply, :now, 0, null, null)");
  $stmt->bindParam(":accid", getAccountIDByUsername($username), PDO::PARAM_INT);
  $stmt->bindParam(":type", $type, PDO::PARAM_STR);
  $stmt->bindParam(":name", $name, PDO::PARAM_STR);
  $stmt->bindParam(":age", $age, PDO::PARAM_INT);
  $stmt->bindParam(":apply", $apply, PDO::PARAM_STR);
  $stmt->bindParam(":now", time(), PDO::PARAM_STR);
  $stmt->execute();
}
function getApply($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM applications WHERE ID = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["APPLICATION"];
  }
}
function getApplyStatus($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM applications WHERE ID = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["STATUS"];
  }
}
function getApplyByAccountID($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM applications WHERE ACCID = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["ID"];
  }
}
function getAccountIDByApply($applyid){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM applications WHERE ID = :id");
  $stmt->bindParam(":id", $applyid, PDO::PARAM_INT);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["ACCID"];
  }
}
function getUsernameByAccountID($id){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE ID = :id");
  $stmt->bindParam(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["USERNAME"];
  }
}
function displayToast($type, $title, $message){
  echo '
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
  toastr.'.$type.'("'.$message.'", "'.$title.'");
  </script>
  ';
}
function setResetToken($email, $token){
  require("mysql.php");
  $stmt = $mysql->prepare("UPDATE accounts SET TOKEN = :value WHERE EMAIL = :mail");
  $stmt->bindParam(":mail", $email, PDO::PARAM_STR);
  $stmt->bindParam(":value", $token, PDO::PARAM_STR);
  $stmt->execute();
}
function getResetToken($email){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :mail");
  $stmt->bindParam(":mail", $email, PDO::PARAM_INT);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["TOKEN"];
  }
}
function RandomStringGenerator($n){
    // Variable which store final string
    $generated_string = "";

    // Create a string with the help of
    // small letters, capital letters and
    // digits.
    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    // Find the lenght of created string
    $len = strlen($domain);

    // Loop to create random string
    for ($i = 0; $i < $n; $i++)
    {
        // Generate a random index to pick
        // characters
        $index = rand(0, $len - 1);

        // Concatenating the character
        // in resultant string
        $generated_string = $generated_string . $domain[$index];
    }

    // Return the random generated string
    return $generated_string;
}
function updateLogin($username){
  require("mysql.php");
  $stmt = $mysql->prepare("UPDATE accounts SET LASTLOGIN = :value WHERE USERNAME = :user");
  $stmt->bindParam(":user", $username, PDO::PARAM_STR);
  $now = time();
  $stmt->bindParam(":value", $now, PDO::PARAM_STR);
  $stmt->execute();
}
function getInterviewdate($applyid){
  require("mysql.php");
  $stmt = $mysql->prepare("SELECT * FROM applications WHERE ID = :id");
  $stmt->bindParam(":id", $applyid, PDO::PARAM_INT);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    return $row["INTERVIEWDATE"];
  }
}
function displayTimestamp($time){
  if(getSetting("lang") == "en"){
    return date("m/d/Y h:i A", $time);
  } else if(getSetting("lang") == "de"){
    return date("d.m.Y H:i", $time);
  }
}
?>
