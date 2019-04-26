<?php
//////////////////////////////////////////
// index.php
//////////////////////////////////////////
define("INDEX_HEADLINE", "Apply");
define("INDEX_DESC", "Welcome! <br><br>
  On this page you can apply for a position in our team.<br>
  Below you can see which ranks are currently open for application.<br><br>
  Good luck with your application <br>
  ~ ".getSetting("name"));
//////////////////////////////////////////
// userpanel.php
//////////////////////////////////////////
define("PANEL_HEADLINE", "Your application");
define("PANEL_NEGATIVE", "<p>Bad news :( <br>
  We have rejected your application.
</p>");
define("PANEL_POSITIVE", "<p>Good news :) <br>
  We have accepted your application.
</p>");
define("PANEL_NEUTRAL", "<p>Your application is currently pending.</p><br>");
//////////////////////////////////////////
// login.php
//////////////////////////////////////////
define("LOGINFORM_USERNAME", "Username");
define("LOGINFORM_PASSWORD", "Password");
define("LOGINFORM_BUTTON", "Login");
define("LOGINFORM_FORGOT", "Forgot Password?");
define("MESSAGE_SUCCESS_TITLE", "Login sucessfully");
define("MESSAGE_SUCCESS", "You are now logged in.");
define("MESSAGE_FAILED_TITLE", "Login failed");
define("MESSAGE_FAILED", "Check your username and password and try again.");
define("FORGOT_TITLE", "Forgot password?");
define("FORGOT_BUTTON", "Reset password");
define("NEWPW_TITLE", "Set new password");
define("NEWPW_BUTTON", "Set password");
define("NEWPW_PW1", "Your new password");
define("NEWPW_PW2", "Repeat your password");
define("NEWPW_YOURACC", "Your account");
define("NEWPW_ERR", "This link is invalid.");
define("NEWPW_SUCCESS", "The password was successfully changed.");
define("NEWPW_ERR_AUTH_TITLE", "Auth error");
define("NEWPW_ERR_AUTH", "Authentication failed.");
define("NEWPW_ERR_PW_TITLE", "Passwords did not match");
define("NEWPW_ERR_PW", "The passwords did not match.");
define("FORGOT_EMAIL_OK", "An email with a link to reset your password was send.");
define("FORGOT_EMAIL_ERR", "This email is not registered.");
define("EMAIL_TITLE", "Password reset");
$token = RandomStringGenerator(24);
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(isset($_POST["email"])){
  define("EMAIL", "Click the link below to reset your password. <br> $url?token=$token&email=".$_POST["email"]);
}
define("SENDMAIL_ERR", "<h1>Error</h1>
<p>This function is currently disabled<br>
To enable this function ask a admin to install the mail module.</p>
<h3>Install mail module in Linux:</h3>");
//////////////////////////////////////////
// settings.php
//////////////////////////////////////////
define("SETTINGS", "Settings");
define("SAVE_MESSAGE_SUCCESS_TITLE", "Saved");
define("SAVE_MESSAGE_SUCCESS", "Changes are successfully saved.");
define("SAVE_MESSAGE_FAILED_TITLE", "Saving failed");
define("SAVE_MESSAGE_FAILED", "Failed to save changes.");
define("SERVERNAME", "Server name");
define("LANGUAGE", "Language");
define("SUP_APPLY", "Supporter applications");
define("DEV_APPLY", "Developer applications");
define("BUILDER_APPLY", "Builder applications");
define("ENABLED", "Enabled");
define("DISABLED", "Disabled");
define("SAVE", "Save");
define("MINAGE", "Min. Age at Apply");
//////////////////////////////////////////
// usersettings.php
//////////////////////////////////////////
define("USERNAME", "Username");
define("CHANGE_PASSWORD", "Change password");
define("NEWPW_FORM", "Enter new password");
//////////////////////////////////////////
// ajax.php
//////////////////////////////////////////
define("TOOYOUNG_TITLE", "Too young");
define("TOOYOUNG_MESSAGE", "You must be at least ".getSetting("age")." years old");
define("NAMESHORT_TITLE", "Name too short");
define("NAMESHORT_MESSAGE", "Your first name and nickname must be at least 3 character");
define("EMAILBLACK_TITLE", "Email blacklisted");
define("EMAILBLACK_MESSAGE", "Please use your normal email");
define("USERNAME_TITLE", "Username taken");
define("USERNAME_MESSAGE", "This username is already taken");
define("EMAIL_ERR_TITLE", "Email taken");
define("EMAIL_MESSAGE", "This email is already taken");
define("PW_TITLE", "Password to short");
define("PW_MESSAGE", "Your password must be at least 6 character");
define("APPLY_TITLE", "Application too short");
define("APPLY_MESSAGE", "Your application must be at least 100 character");
define("SUCCESS_MODAL", "Your application was successfully sent. You can check the current status of your application in your account.");
define("BUTTON_ACCEPT", "Accept");
define("BUTTON_DENY", "Reject");
//////////////////////////////////////////
// admincontrolpanel.php
//////////////////////////////////////////
define("HEADLINE", "Open applications");
define("TABLE_USER", "Username");
define("TABLE_DATE", "Date");
define("TABLE_RANK", "Rank");
define("TABLE_ACTIONS", "Actions");
define("NOAPPLYS", "No applications open!");
define("SUCCESS", "Success");
define("APPLY_ACCEPT", "The application was successfully edited. Please enter now a date for the interview.");
define("APPLY_DENY", "The application was successfully edited.");
define("INTERVIEW_SET", "The Interview Date was successfully set.");
define("INTERVIEW", "Interview");
define("INTERVIEW_PICK_DATE", "Pick date");
define("INTERVIEW_PICK_TIME", "Pick time");
define("INTERVIEW_BUTTON", "Set Interview");
//////////////////////////////////////////
// apply.php
//////////////////////////////////////////
define("APPLY", "Apply");
define("DISABLED_TITLE", "Applications disabled");
define("SUP_DISABLED", "Sorry, we are currently not looking for Supporters.");
define("DEV_DISABLED", "Sorry, we are currently not looking for Developers.");
define("BUILD_DISABLED", "Sorry, we are currently not looking for Builders.");
define("FORM_USER", "Username");
define("FORM_PW", "Password");
define("FORM_AGE", "Age");
define("FORM_APPLY", "Your application");
//////////////////////////////////////////
// users.php
//////////////////////////////////////////
define("REGDATE", "Registered at");
define("LOGDATE", "Last login at");
define("RANK_0", "Applicant");
define("RANK_1", "Staff");
define("RANK_2", "Admin");
define("PERMERR", "You can\'t edit this user!");
define("USERS", "Users");
define("LASTLOGIN", "Lastlogin");

?>
