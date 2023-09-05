<?php 
$id=$_GET["id"];
require 'functions.php';
if(deleteSerie($id))
{
    header("Location:admin-series.php");exit;
}
?>