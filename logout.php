<?php
setcookie("username", "", (time() - (60 * 60 * 24)), "/");
setcookie("role", "", (time() - (60 * 60 * 24)), "/");
header("Location:index.php");
?>
