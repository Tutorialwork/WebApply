<?php
session_start();
session_destroy();
header("Location: ../dashboard/index.php");
exit;
 ?>
