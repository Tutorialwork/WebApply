<?php
function getRank($username){
  include('../database.php');
  $abfrage = "SELECT rank FROM accounts WHERE username = '$username'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  while($row = mysqli_fetch_array($ergebnis)){
    return $row["rank"];
  }
}
function isEmailExist($email){
  include('../database.php');
  $abfrage = "SELECT email FROM accounts WHERE email = '$email'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  $data = 0;
  while($row = mysqli_fetch_object($ergebnis)){
    $data++;
  }
  if($data == 0){
    return false;
  } else {
    return true;
  }
}
function isUsernameExist($username){
  include('../database.php');
  $abfrage = "SELECT username FROM accounts WHERE username = '$username'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  $data = 0;
  while($row = mysqli_fetch_object($ergebnis)){
    $data++;
  }
  if($data == 0){
    return false;
  } else {
    return true;
  }
}
function isUsernameExistRootDirectory($username){
  include('database.php');
  $abfrage = "SELECT username FROM accounts WHERE username = '$username'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  $data = 0;
  while($row = mysqli_fetch_object($ergebnis)){
    $data++;
  }
  if($data == 0){
    return false;
  } else {
    return true;
  }
}
function getUsernameByID($id){
  include('../database.php');
  $abfrage = "SELECT username FROM accounts WHERE id = '$id'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  while($row = mysqli_fetch_array($ergebnis)){
    return $row["username"];
  }
}
function isAccExistByID($id){
  include('../database.php');
  $abfrage = "SELECT id FROM accounts WHERE id = '$id'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  $data = 0;
  while($row = mysqli_fetch_object($ergebnis)){
    $data++;
  }
  if($data == 0){
    return false;
  } else {
    return true;
  }
}
function isMasteruser($username){
  include('../database.php');
  $abfrage = "SELECT rank FROM accounts WHERE username = '$username'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  while($row = mysqli_fetch_array($ergebnis)){
    if($row["rank"] == "3"){
      return true;
    } else {
      return false;
    }
  }
}
function isBanned($username){
  include('../database.php');
  $abfrage = "SELECT ban FROM accounts WHERE username = '$username'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  while($row = mysqli_fetch_array($ergebnis)){
    if($row["ban"] == "1"){
      return true;
    } else {
      return false;
    }
  }
}
function getEmailByUsername($username){
  include('../database.php');
  $abfrage = "SELECT email FROM accounts WHERE username = '$username'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  while($row = mysqli_fetch_array($ergebnis)){
    return $row["email"];
  }
}
function insertComment($comment, $opinion, $applyid, $type, $author){
  include('../database.php');
  $time = time();
  $abfrage = "INSERT INTO comments (applyid, type, comment, author, written_at, opinion) VALUES ('$applyid', '$type', '$comment', '$author', '$time', '$opinion')";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
}
function showComments($applyid, $type){
  include('../database.php');
  $abfrage = "SELECT * FROM comments WHERE applyid = '$applyid' AND type = '$type'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  while($row = mysqli_fetch_array($ergebnis)){
    echo '<h1 class="ui header">
    <img class="ui medium circular image" src="https://i.imgur.com/BS1pqFp.jpg">
    '.$row["author"].'</h1>';
    echo '<p>'.$row["comment"].'</p>';
    if($row["opinion"] == "1"){
      echo '<p>Puplished at: <em>'.date("dS M Y", $row["written_at"]).'</em> | Voted for <strong>accept</strong> the apply</p>';
    } else if($row["opinion"] == "0"){
      echo '<p>Puplished at: <em>'.date("dS M Y", $row["written_at"]).'</em> | Voted for <strong>deny</strong> the apply</p>';
    }
  }
}
function hasAlreadyCommented($username, $applyid, $type){
  include('../database.php');
  $abfrage = "SELECT * FROM comments WHERE applyid = '$applyid' AND type = '$type' AND author = '$username'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  $data = 0;
  while($row = mysqli_fetch_object($ergebnis)){
    $data++;
  }
  if($data == 0){
    return false;
  } else {
    return true;
  }
}
 ?>
