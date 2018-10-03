<?php
include('../../database.php');
$username = $_POST["username"];
$abfrage = "SELECT username FROM accounts WHERE username = '$username'";
$ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
$data = 0;
while($row = mysqli_fetch_object($ergebnis)){
  $data++;
}
if($data == 0){
  if(strlen($username) > 3){
    $return = '<p style="color: green;">The username is available!</p>';
    echo $return;
  }
} else {
  if(strlen($username) > 3){
    $return = '<p style="color: red;">The username is already taken</p>';
    echo $return;  
  }
}
 ?>
