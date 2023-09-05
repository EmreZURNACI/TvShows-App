<?php 
$id=$_GET["id"];
require 'functions.php';
if(deleteCategory($id))
{
    header("Location:admin-categories.php");exit;
}
?>
