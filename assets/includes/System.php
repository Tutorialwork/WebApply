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
function getEmailByUsername($username){
  include('../database.php');
  $abfrage = "SELECT email FROM accounts WHERE username = '$username'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  while($row = mysqli_fetch_array($ergebnis)){
    return $row["email"];
  }
}
 ?>
