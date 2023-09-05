<?php 
$id=$_GET["id"];
require 'functions.php';
if(deleteUser($id))
{
    header("Location:admin-users.php");exit;
}
?>