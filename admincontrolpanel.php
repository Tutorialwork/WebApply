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
} else if(getRankID($_SESSION["username"]) < 1){
  ?>
  <meta http-equiv="refresh" content="0; URL=userpanel.php">
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
    <title>Admincontrolpanel</title>
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
    if(isset($_GET["status"]) && isset($_GET["apply"])){
      require("mysql.php");
      $stmt = $mysql->prepare("UPDATE applications SET STATUS = :status WHERE ID = :id");
      $stmt->bindParam(":status", $_GET["status"], PDO::PARAM_STR);
      $stmt->bindParam(":id", $_GET["apply"], PDO::PARAM_STR);
      $stmt->execute();
      if($_GET["status"] != 1){
        ?>
        <script type="text/javascript">
        $.sweetModal({
          title: '<?php echo SUCCESS; ?>',
  	      content: '<?php echo APPLY_ACCEPT; ?>',
  	      icon: $.sweetModal.ICON_WARNING,
          onClose: function(){
            window.location = "admincontrolpanel.php?setinterviewdate=<?php echo $_GET["apply"]; ?>";
          }
        });
        </script>
        <?php
      } else {
        ?>
        <script type="text/javascript">
        $.sweetModal({
          title: '<?php echo SUCCESS; ?>',
  	      content: '<?php echo APPLY_DENY; ?>',
  	      icon: $.sweetModal.ICON_SUCCESS
        });
        </script>
        <?php
      }
    }
     ?>
    <div class="content">
      <?php
      if(isset($_POST["submit"])){
        $datestr = $_POST["date"];
        $datestr .= " ".$_POST["time"];
        require("mysql.php");
        $stmt = $mysql->prepare("UPDATE applications SET TEAMNAME = :user, INTERVIEWDATE = :datestr WHERE ID = :id");
        $stmt->bindParam(":id", $_POST["applyid"], PDO::PARAM_INT);
        $stmt->bindParam(":user", $_SESSION["username"], PDO::PARAM_STR);
        $stmt->bindParam(":datestr", $datestr, PDO::PARAM_STR);
        $stmt->execute();
        ?>
        <script type="text/javascript">
        $.sweetModal({
          content: '<?php echo INTERVIEW_SET; ?>',
          icon: $.sweetModal.ICON_SUCCESS
        });
        </script>
        <?php
      }
      if(isset($_GET["setinterviewdate"])){
        ?>
        <h1><?php echo INTERVIEW; ?> #<?php echo $_GET["setinterviewdate"] ?></h1>
        <form action="admincontrolpanel.php" method="post">
          <input type="date" name="date" placeholder="<?php echo INTERVIEW_PICK_DATE; ?>" required><br>
          <input type="time" name="time" placeholder="<?php echo INTERVIEW_PICK_TIME; ?>" required><br>
          <button type="submit" name="submit"><?php echo INTERVIEW_BUTTON; ?></button>
          <input type="hidden" name="applyid" value="<?php echo $_GET["setinterviewdate"] ?>">
        </form>
        <?php
        exit;
      }
       ?>
      <noscript>
        <p>Some features are not working.
        Please enable Javascript for this site.</p>
      </noscript>
      <h1>Hey, <?php echo $_SESSION["username"] ?></h1>
      <hr>
      <h5><?php echo HEADLINE; ?></h5>
      <table>
        <tr>
          <th><?php echo TABLE_USER; ?></th>
          <th><?php echo TABLE_DATE; ?></th>
          <th><?php echo TABLE_RANK; ?></th>
          <th><?php echo TABLE_ACTIONS; ?></th>
        </tr>
        <?php
        require("mysql.php");
        if(isset($_GET["p"])){
          $page = $_GET["p"];
          $sqlint = ($page*5)-5;
          $stmt = $mysql->prepare("SELECT * FROM applications WHERE STATUS = 0 ORDER BY SUBMITDATE DESC LIMIT $sqlint,5");
        } else {
          $stmt = $mysql->prepare("SELECT * FROM applications WHERE STATUS = 0 ORDER BY SUBMITDATE DESC LIMIT 0,5");
          $page = 1;
        }
        $stmt->execute();
        $stmtcounter = $mysql->prepare("SELECT * FROM applications WHERE STATUS = 0");
        $stmtcounter->execute();
        $count = $stmtcounter->rowCount();
        $pages = $count / 5;
        $pages = ceil($pages);
        if($count != 0){
          while ($row = $stmt->fetch()) {
            echo '<tr>
            <td>'.getUsernameByAccountID(getAccountIDByApply($row["ID"])).'</td>
            <td>'.displayTimestamp($row["SUBMITDATE"]).'</td>
            <td>'.ucfirst($row["APPLYRANK"]).'</td>
            <td>
              <form action="ajax.php?modal" method="post" id="'.$row["ID"].'">
                <input type="hidden" name="id" value="'.$row["ID"].'">
                <button type="submit" name="submit'.$row["ID"].'" class="iconbutton"><i class="fas fa-eye"></i></button>
              </form>
            </td></tr>
            ';
          }
        } else {
          ?>
          <div class="error">
            <?php echo NOAPPLYS; ?>
          </div><br>
          <?php
        }
         ?>
      </table>
      <div id="output"></div>
      <p></p>
      <br>
      <ul>
        <?php
        for($i=1;$i<=$pages;$i++){
          if($i == $page){
            echo '<li class="active"><a href="admincontrolpanel.php?p='.$i.'">'.$i.'</a></li>';
          } else {
            echo '<li><a href="admincontrolpanel.php?p='.$i.'">'.$i.'</a></li>';
          }
        }
         ?>
      </ul>
      <br><br>
      <a href="logout.php" class="btn">Logout</a>
      <?php
      if(getRankID($_SESSION["username"]) > 2){
        ?>
        <a href="settings.php" class="loginicon"><i class="fas fa-cog"></i></a>
        <a href="users.php" class="loginicon"><i class="fas fa-users"></i></a>
        <a href="usersettings.php" class="loginicon"><i class="fas fa-user-cog"></i></a>
        <?php
      } else {
        ?>
        <a href="usersettings.php" class="loginicon"><i class="fas fa-user-cog"></i></a>
        <?php
      }
       ?>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
      var form = $('form');
      form.submit(function(e) {
          // prevent form submission
          e.preventDefault();

          // submit the form via Ajax
          $.ajax({
              url: form.attr('action'),
              type: form.attr('method'),
              dataType: 'html',
              data: $(this).serialize(),
              success: function(result) {
                  // Inject the result in the HTML
                  $('#output').html(result);
              }
          });
      });
    });
    </script>
  </body>
</html>
