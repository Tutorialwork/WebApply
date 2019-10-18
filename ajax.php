<?php
require("datamanager.php");
require('assets/languages/lang_'.getSetting("lang").'.php');
if(isset($_GET["sendapply"])){
  $agestr = getSetting("age");
  $age = intval($agestr);
  if($_POST["age"] > $age - 1){
    if(strlen($_POST["username"]) > 2 && strlen($_POST["name"]) > 2){
      $split = explode('@', $_POST["email"]);
      $checkmail = file_get_contents("https://v2.trashmail-blacklist.org/check/json/".$split[1]);
      $json = json_decode($checkmail, true);
      if($json['status'] != "blacklisted"){
        if(!existsUsername($_POST["username"])){
          if(!existsEmail($_POST["email"])){
            if(strlen($_POST["password"]) > 5){
              if(strlen($_POST["apply"]) > 99){
                createAccount($_POST["username"], $_POST["email"], $_POST["password"], 0);
                insertApply($_POST["type"], $_POST["username"], $_POST["name"], $_POST["age"], $_POST["apply"]);
                ?>
                <script type="text/javascript">
                $.sweetModal({
            	     content: '<?php echo SUCCESS_MODAL ?>',
            	     icon: $.sweetModal.ICON_SUCCESS,
                   onClose: function(){
                     window.location = "login.php";
                   }
                });
                </script>
                <?php
              } else {
                displayToast("error", APPLY_TITLE, APPLY_MESSAGE);
              }
            } else {
              displayToast("error", PW_TITLE, PW_MESSAGE);
            }
          } else {
            displayToast("error", EMAIL_ERR_TITLE, EMAIL_MESSAGE);
          }
        } else {
          displayToast("error", USERNAME_TITLE, USERNAME_MESSAGE);
        }
      } else {
        displayToast("error", EMAILBLACK_TITLE, EMAILBLACK_MESSAGE);
      }
    } else {
      displayToast("error", NAMESHORT_TITLE, NAMESHORT_MESSAGE);
    }
  } else {
    displayToast("error", TOOYOUNG_TITLE, TOOYOUNG_MESSAGE);
  }
}
if(isset($_GET["modal"])){
  $apply = wordwrap(getApply($_POST["id"]), 130, "<br>", true);
  ?>
  <script type="text/javascript">
  $.sweetModal({
    title: 'Application #<?php echo $_POST["id"] ?>',
    content: '<?php echo $apply; ?> <br><hr><br><a href="admincontrolpanel.php?status=2&apply=<?php echo $_POST["id"] ?>" class="btn-green"><?php echo BUTTON_ACCEPT; ?></a>&nbsp;&nbsp;<a href="admincontrolpanel.php?status=1&apply=<?php echo $_POST["id"] ?>" class="btn-red"><?php echo BUTTON_DENY; ?></a>'
  });
  </script>
  <?php
}
 ?>
