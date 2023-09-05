<?php
$connection = new mysqli("localhost", "root", "", "tvseriesdb");
if ($connection->connect_error) {
    echo "Bağlantı Hatası";
}
?>