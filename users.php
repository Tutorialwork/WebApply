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
    <title><?php echo USERS; ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/toast.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="assets/js/toast.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="assets/css/jquery.sweet-modal.min.css" />
    <script src="assets/js/jquery.sweet-modal.min.js"></script>
  </head>
  <body>
    <div class="content">
      <?php
      if(isset($_POST["submit"])){
        if(empty($_POST["pw"])){
          require("mysql.php");
          $stmt = $mysql->prepare("UPDATE accounts SET EMAIL = :mail, USERRANK = :urank, USERNAME = :user WHERE ID = :id");
          $stmt->bindParam(":urank", $_POST["rank"], PDO::PARAM_INT);
          $stmt->bindParam(":mail", $_POST["email"], PDO::PARAM_STR);
          $stmt->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
          $stmt->bindParam(":user", $_POST["username"], PDO::PARAM_STR);
          $stmt->execute();
          displayToast('success', SAVE_MESSAGE_SUCCESS_TITLE, SAVE_MESSAGE_SUCCESS);
        } else {
          $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
          require("mysql.php");
          $stmt = $mysql->prepare("UPDATE accounts SET EMAIL = :mail, USERRANK = :urank, USERNAME = :user, PASSWORD = :pw WHERE ID = :id");
          $stmt->bindParam(":urank", $_POST["rank"], PDO::PARAM_INT);
          $stmt->bindParam(":mail", $_POST["email"], PDO::PARAM_STR);
          $stmt->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
          $stmt->bindParam(":user", $_POST["username"], PDO::PARAM_STR);
          $stmt->bindParam(":pw", $hash, PDO::PARAM_STR);
          $stmt->execute();
          displayToast('success', SAVE_MESSAGE_SUCCESS_TITLE, SAVE_MESSAGE_SUCCESS);
        }
      }
      if(isset($_GET["id"])){
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE ID = :id");
        $stmt->bindParam(":id", $_GET["id"], PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          if($row["USERRANK"] == 3){
            ?>
            <script type="text/javascript">
            $.sweetModal({
              content: '<?php echo PERMERR; ?>',
              icon: $.sweetModal.ICON_ERROR,
              onClose: function(){
                window.location = "users.php";
              }
              });
            </script>
            <?php
            exit;
          }
          ?>
          <h1><?php echo getUsernameByAccountID($_GET["id"]); ?></h1>
          <form action="users.php?id=<?php echo $row["ID"]; ?>" method="post">
            <input type="text" name="username" value="<?php echo $row["USERNAME"] ?>" placeholder="<?php echo LOGINFORM_USERNAME; ?>" required>
            <input type="email" name="email" value="<?php echo $row["EMAIL"] ?>" placeholder="Email" required>
            <input type="password" name="pw" placeholder="<?php echo NEWPW_FORM; ?>"><p></p>
            <select name="rank">
              <?php
              if($row["USERRANK"] == 0){
                ?>
                <option value=0><?php echo RANK_0; ?></option>
                <option value=1><?php echo RANK_1; ?></option>
                <option value=2><?php echo RANK_2; ?></option>
                <?php
              } else if($row["USERRANK"] == 1){
                ?>
                <option value=1><?php echo RANK_1; ?></option>
                <option value=0><?php echo RANK_0; ?></option>
                <option value=2><?php echo RANK_2; ?></option>
                <?php
              } else if($row["USERRANK"] == 2){
                ?>
                <option value=2><?php echo RANK_2; ?></option>
                <option value=0><?php echo RANK_0; ?></option>
                <option value=1><?php echo RANK_1; ?></option>
                <?php
              }
               ?>
            </select>
            <p><?php echo REGDATE; ?>: <?php echo displayTimestamp($row["FIRSTLOGIN"]) ?></p>
            <p><?php echo LOGDATE; ?>: <?php echo displayTimestamp($row["LASTLOGIN"]) ?></p>
            <input type="hidden" name="id" value="<?php echo $row["ID"]; ?>">
            <button type="submit" name="submit"><?php echo SAVE ?></button>
          </form>
          <p></p>
          <br>
          <a href="users.php" class="loginicon"><i class="fas fa-arrow-left"></i></a>
          <?php
        }
        exit;
      }
       ?>
      <h1><?php echo USERS; ?></h1>
      <hr>
      <table>
        <tr>
          <th><?php echo LOGINFORM_USERNAME; ?></th>
          <th><?php echo TABLE_RANK; ?></th>
          <th><?php echo LASTLOGIN; ?></th>
          <th><?php echo TABLE_ACTIONS; ?></th>
        </tr>
        <?php
        require("mysql.php");
        if(isset($_GET["p"])){
          $page = $_GET["p"];
          $sqlint = ($page*5)-5;
          $stmt = $mysql->prepare("SELECT * FROM accounts ORDER BY FIRSTLOGIN DESC LIMIT $sqlint,5");
        } else {
          $stmt = $mysql->prepare("SELECT * FROM accounts ORDER BY FIRSTLOGIN DESC LIMIT 0,5");
          $page = 1;
        }
        $stmt->execute();
        $stmtcounter = $mysql->prepare("SELECT * FROM accounts");
        $stmtcounter->execute();
        $count = $stmtcounter->rowCount();
        $pages = $count / 5;
        $pages = ceil($pages);
        while ($row = $stmt->fetch()) {
          echo '<tr>
          <td>'.$row["USERNAME"].'</td>
          <td>';
          if($row["USERRANK"] == 0){
            echo RANK_0;
          } else if($row["USERRANK"] == 1){
            echo RANK_1;
          } else if($row["USERRANK"] == 2){
            echo RANK_2;
          } else if($row["USERRANK"] == 3){
            echo RANK_2;
          }
          echo '</td>
          <td>'.displayTimestamp($row["LASTLOGIN"]).'</td>
          <td>
            <form action="users.php" method="get" id="'.$row["ID"].'">
              <input type="hidden" name="id" value="'.$row["ID"].'">
              <button type="submit" class="iconbutton"><i class="fas fa-user-edit"></i></button>
            </form>
          </td></tr>
          ';
        }
         ?>
      </table>
      <p></p>
      <br>
      <ul>
        <?php
        for($i=1;$i<=$pages;$i++){
          if($i == $page){
            echo '<li class="active"><a href="users.php?p='.$i.'">'.$i.'</a></li>';
          } else {
            echo '<li><a href="users.php?p='.$i.'">'.$i.'</a></li>';
          }
        }
         ?>
      </ul>
      <br><br>
      <a href="logout.php" class="btn">Logout</a>
      <a href="admincontrolpanel.php" class="loginicon"><i class="fas fa-arrow-left"></i></a>
    </div>
  </body>
</html>
