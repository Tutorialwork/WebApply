<?php
//////////////////////////////////////////
// index.php
//////////////////////////////////////////
define("INDEX_HEADLINE", "Bewerbungen");
define("INDEX_DESC", "Willkommen! <br><br>
  Auf dieser Seite kannst du dich als Teammitglied auf unserem Server bewerben.
  Unten kannst du einsehen für welche Ränge gerade die Bewerbungsphase läuft.<br><br>
  Wir wünschen dir viel Glück mit deiner Bewerbung <br>
  ~ ".getSetting("name"));
//////////////////////////////////////////
// userpanel.php
//////////////////////////////////////////
define("PANEL_HEADLINE", "Deine Bewerbung");
define("PANEL_NEGATIVE", "<p>Schlechte Nachrichten :( <br>
  Wir müssen dir leider mitteilen das wir deine Bewerbung abgelehnt haben.
</p>");
define("PANEL_POSITIVE", "<p>Gute Nachrichten :) <br>
  Es freut uns dir mitzuteilen das wird deine Bewerbung angenommen haben.
</p>");
define("PANEL_NEUTRAL", "<p>Derzeit ist deine Bewerbung in Bearbeitung.</p><br>");
//////////////////////////////////////////
// login.php
//////////////////////////////////////////
define("LOGINFORM_USERNAME", "Benutzername");
define("LOGINFORM_PASSWORD", "Passwort");
define("LOGINFORM_BUTTON", "Anmelden");
define("LOGINFORM_FORGOT", "Passwort vergessen?");
define("MESSAGE_SUCCESS_TITLE", "Login erfolgreich");
define("MESSAGE_SUCCESS", "Du bist jetzt eingeloggt.");
define("MESSAGE_FAILED_TITLE", "Login fehlgeschlagen");
define("MESSAGE_FAILED", "Überprüfe den Benutzername und das Passwort und versuche es erneut.");
define("FORGOT_TITLE", "Passwort vergessen?");
define("FORGOT_BUTTON", "Passwort zurücksetzen");
define("NEWPW_TITLE", "Neues Passwort setzen");
define("NEWPW_BUTTON", "Passwort setzen");
define("NEWPW_PW1", "Dein neues Passwort");
define("NEWPW_PW2", "Wiederhole dein Passwort");
define("NEWPW_YOURACC", "Dein Benutzerkonto");
define("NEWPW_ERR", "Der aufgerufene Link ist ungültig.");
define("NEWPW_SUCCESS", "Das Passwort wurde erfolgreich geändert.");
define("NEWPW_ERR_AUTH_TITLE", "Auth-Fehler");
define("NEWPW_ERR_AUTH", "Die Authentifizierung ist fehlgeschlagen.");
define("NEWPW_ERR_PW_TITLE", "Passwörter falsch");
define("NEWPW_ERR_PW", "Die Passwörter stimmen nicht überein.");
define("FORGOT_EMAIL_OK", "Eine Email mit einem Link zum zurücksetzen des Passworts wurde gesendet.");
define("FORGOT_EMAIL_ERR", "Diese Email wurde nicht gefunden.");
define("EMAIL_TITLE", "Passwort zurücksetzen");
$token = RandomStringGenerator(24);
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(isset($_POST["email"])){
  define("EMAIL", "Klicke auf den untenstehenden Link um ein neues Passwort zu setzen. <br> $url?token=$token&email=".$_POST["email"]);
}
define("SENDMAIL_ERR", "<h1>Fehler</h1>
<p>Diese Funktion wurde deaktiviert.<br>
Um diese Funktion zu aktivieren frage einen Admin, ob er das Mail Modul installiert.</p>
<h3>Mail Modul in Linux installieren:</h3>");
//////////////////////////////////////////
// settings.php
//////////////////////////////////////////
define("SETTINGS", "Einstellungen");
define("SAVE_MESSAGE_SUCCESS_TITLE", "Gespeichert");
define("SAVE_MESSAGE_SUCCESS", "Die Änderungen wurden erfolgreich gespeichert.");
define("SAVE_MESSAGE_FAILED_TITLE", "Speichern fehlgeschlagen");
define("SAVE_MESSAGE_FAILED", "Die Änderungen konnten nicht gespeichert werden.");
define("SERVERNAME", "Servername");
define("LANGUAGE", "Sprache");
define("SUP_APPLY", "Supporter Bewerbungen");
define("DEV_APPLY", "Developer Bewerbungen");
define("BUILDER_APPLY", "Builder Bewerbungen");
define("ENABLED", "Aktiviert");
define("DISABLED", "Deaktiviert");
define("SAVE", "Speichern");
define("MINAGE", "Min. Alter bei Bewerbung");
//////////////////////////////////////////
// usersettings.php
//////////////////////////////////////////
define("USERNAME", "Benutzername");
define("CHANGE_PASSWORD", "Passwort ändern");
define("NEWPW_FORM", "Neues Passwort festlegen");
//////////////////////////////////////////
// ajax.php
//////////////////////////////////////////
define("TOOYOUNG_TITLE", "Zu jung");
define("TOOYOUNG_MESSAGE", "Du musst mindestens ".getSetting("age")." Jahre alt sein");
define("NAMESHORT_TITLE", "Name zu kurz");
define("NAMESHORT_MESSAGE", "Dein Vorname und Benutzername müssen mindestens 3 Zeichen lang sein");
define("EMAILBLACK_TITLE", "Email gesperrt");
define("EMAILBLACK_MESSAGE", "Bitte benutze deine richtige Email");
define("USERNAME_TITLE", "Benutzername vergeben");
define("USERNAME_MESSAGE", "Dieser Benutzername ist leider schon vergeben");
define("EMAIL_ERR_TITLE", "Email vergeben");
define("EMAIL_MESSAGE", "Diese Email ist leider schon vergeben");
define("PW_TITLE", "Passwort zu kurz");
define("PW_MESSAGE", "Dein Passwort muss mindestens 6 Zeichen lang sein");
define("APPLY_TITLE", "Bewerbung zu kurz");
define("APPLY_MESSAGE", "Deine Bewerbung muss mindestens 100 Zeichen lang sein");
define("SUCCESS_MODAL", "Deine Bewerbung wurde erfolgreich verschickt. Du kannst jederzeit den Status deiner Bewerbung in deine Benutzerkonto einsehen.");
define("BUTTON_ACCEPT", "Annehmen");
define("BUTTON_DENY", "Ablehnen");
//////////////////////////////////////////
// admincontrolpanel.php
//////////////////////////////////////////
define("HEADLINE", "Offene Bewerbungen");
define("TABLE_USER", "Benutzername");
define("TABLE_DATE", "Datum");
define("TABLE_RANK", "Rang");
define("TABLE_ACTIONS", "Aktionen");
define("NOAPPLYS", "Keine offene Bewerbungen!");
define("SUCCESS", "Erfolgreich");
define("APPLY_ACCEPT", "Die Bewerbung wurde erfolgreich bearbeitet. Lege jetzt das Datum für das Bewerbungsgespräch fest.");
define("APPLY_DENY", "Die Bewerbung wurde erfolgreich bearbeitet.");
define("INTERVIEW_SET", "Das Datum für das Bewerbungsgespräch wurde erfolgreich gesetzt.");
define("INTERVIEW", "Bewerbungsgespräch");
define("INTERVIEW_PICK_DATE", "Datum auswählen");
define("INTERVIEW_PICK_TIME", "Zeit aussuchen");
define("INTERVIEW_BUTTON", "Datum setzen");
//////////////////////////////////////////
// apply.php
//////////////////////////////////////////
define("APPLY", "Bewerben");
define("DISABLED_TITLE", "Bewerbungen deaktiviert");
define("SUP_DISABLED", "Derzeit sind Bewerbungen für Supporter deaktiviert.");
define("DEV_DISABLED", "Derzeit sind Bewerbungen für Developer deaktiviert.");
define("BUILD_DISABLED", "Derzeit sind Bewerbungen für Builder deaktiviert.");
define("FORM_USER", "Benutzername");
define("FORM_PW", "Passwort");
define("FORM_AGE", "Alter");
define("FORM_APPLY", "Deine Bewerbung");
//////////////////////////////////////////
// users.php
//////////////////////////////////////////
define("REGDATE", "Angemeldet am");
define("LOGDATE", "Letzter Login");
define("RANK_0", "Bewerber");
define("RANK_1", "Team");
define("RANK_2", "Admin");
define("PERMERR", "Du kannst diesen Benutzer nicht verändern!");
define("USERS", "Benutzer");
define("LASTLOGIN", "Letzer Login");
?>
