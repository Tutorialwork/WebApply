<?php
if(!file_exists("mysql.php")){
  header("Location: setup/index.php");
  exit;
}
if(isset($_GET["type"])){
  if($_GET["type"] == "supporter" || $_GET["type"] == "developer" || $_GET["type"] == "builder"){
    require("datamanager.php");
    require('assets/languages/lang_'.getSetting("lang").'.php');
  } else {
    header("Location: index.php");
  }
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
    <title><?php echo APPLY; ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/toast.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="assets/js/toast.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="assets/css/jquery.sweet-modal.min.css" />
    <script src="assets/js/jquery.sweet-modal.min.js"></script>
  </head>
  <body>
    <div class="content">
      <?php
      if($_GET["type"] == "supporter"){
        if(getSetting("sup") == "false"){
          ?>
          <script type="text/javascript">
          $.sweetModal({
            title: '<?php echo DISABLED_TITLE; ?>',
	          content: '<?php echo SUP_DISABLED; ?>',
	          icon: $.sweetModal.ICON_ERROR,
            onClose: function(){
              window.location = "index.php";
            }
          });
          </script>
          <?php
          echo SUP_DISABLED;
          exit;
        }
      }
      if($_GET["type"] == "developer"){
        if(getSetting("dev") == "false"){
          ?>
          <script type="text/javascript">
          $.sweetModal({
            title: '<?php echo DISABLED_TITLE; ?>',
	          content: '<?php echo DEV_DISABLED; ?>',
	          icon: $.sweetModal.ICON_ERROR,
            onClose: function(){
              window.location = "index.php";
            }
          });
          </script>
          <?php
          echo DEV_DISABLED;
          exit;
        }
      }
      if($_GET["type"] == "builder"){
        if(getSetting("builder") == "false"){
          ?>
          <script type="text/javascript">
          $.sweetModal({
            title: '<?php echo DISABLED_TITLE; ?>',
	          content: '<?php echo BUILD_DISABLED; ?>',
	          icon: $.sweetModal.ICON_ERROR,
            onClose: function(){
              window.location = "index.php";
            }
          });
          </script>
          <?php
          echo BUILD_DISABLED;
          exit;
        }
      }
       ?>
      <noscript>
        Please enable Javascript
      </noscript>
      <h1><?php echo ucfirst($_GET["type"]) ?></h1>
      <hr>
      <p>
      <form id="supporter" action="ajax.php?sendapply" method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="username" placeholder="<?php echo FORM_USER; ?>" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="<?php echo FORM_PW; ?>" required>
        <input type="number" name="age" placeholder="<?php echo FORM_AGE; ?>" required>
        <textarea name="apply" rows="20" cols="40" placeholder="<?php echo FORM_APPLY; ?>" required></textarea>
        <input type="hidden" name="type" value="<?php echo $_GET["type"] ?>">
        <button type="submit" name="submit"><?php echo APPLY; ?></button>
        <div id="output"></div>
      </form>
      <script type="text/javascript">
      $(document).ready(function(){
        var form = $('#supporter');
        form.submit(function(e) {
            // prevent form submission
            e.preventDefault();

            // submit the form via Ajax
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                dataType: 'html',
                data: form.serialize(),
                success: function(result) {
                    // Inject the result in the HTML
                    $('#output').html(result);
                }
            });
        });
      });
      </script>
    </div>
  </body>
</html>
