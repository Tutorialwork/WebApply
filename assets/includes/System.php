<?php
function getRank($username){
  include('../database.php');
  $abfrage = "SELECT rank FROM accounts WHERE username = '$username'";
  $ergebnis = mysqli_query($mysqli,$abfrage) or die(mysqli_error($mysqli));
  while($row = mysqli_fetch_array($ergebnis)){
    return $row["rank"];
  }
}
 ?>
