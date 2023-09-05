<?php
function listsOfYearsA()
{
    $years = array();
    for ($i = 1895; $i <= date("Y"); $i++) {
        array_push($years, $i);
    }
    return $years;
}
function listsOfYearsD()
{
    $years = array();
    for ($i = date("Y"); $i >= 1895; $i--) {
        array_push($years, $i);
    }
    return $years;
}
function getCategories($id = null)
{
    require 'connection.php';
    $sql = "SELECT * FROM categoriestbl";
    if (!empty($id) and is_numeric($id)) {
        $sql .= " WHERE kategori_id=$id";
    }
    $sonuc = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return $sonuc;
}
function getSeries(string $id = null, string $category = null, $keyword = null)
{
    require 'connection.php';
    $sql = "SELECT 
    seriestbl.dizi_id
    ,seriestbl.dizi_adi
    ,seriestbl.dizi_özeti
    ,seriestbl.dizi_yayintarihi
    ,seriestbl.dizi_resim
    ,seriestbl.dizi_rating
    ,seriestbl.dizi_eklenmetarihi
    ,categoriestbl.kategori_adi FROM seriestbl INNER JOIN categoriestbl ON categoriestbl.kategori_id=seriestbl.dizi_kategorisi ";
    if (!empty($id) and is_numeric($id)) {
        $sql .= "WHERE seriestbl.dizi_id=$id";
    }
    if (!empty($category) and !is_numeric($category)) {
        $sql .= "WHERE categoriestbl.kategori_adi='$category'";
        if (!empty($keyword) and !is_numeric($keyword)) {
            $sql .= " AND seriestbl.dizi_adi LIKE '%$keyword%' AND  seriestbl.dizi_özeti LIKE '%$keyword%'";
        }
    } else {
        if (!empty($keyword) and !is_numeric($keyword)) {
            $sql .= "WHERE seriestbl.dizi_adi LIKE '%$keyword%' AND  seriestbl.dizi_özeti LIKE '%$keyword%'";
        }
    }
    $sonuc = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return $sonuc;
}
function updateSeries($dizi_adi, $dizi_özeti, $dizi_yayintarihi, $resim, $rating, $id)
{
    require 'connection.php';
    $sql = "UPDATE seriestbl SET 
    dizi_adi=(?),
    dizi_özeti=(?),
    dizi_yayintarihi=(?),
    dizi_resim=(?),
    dizi_rating=(?)
    WHERE dizi_id=(?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $dizi_adi, $dizi_özeti, $dizi_yayintarihi, $resim, $rating, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    return $stmt;
}
function updateCategory($id, $category)
{
    require 'connection.php';
    $sql = "UPDATE categoriestbl SET kategori_adi=? WHERE kategori_id=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "si", $category, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    return $stmt;
}
function deleteSerie($id)
{
    require 'connection.php';
    $sql = "DELETE FROM seriestbl WHERE dizi_id=$id";
    $sonuc = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return $sonuc;
}
function deleteCategory($id)
{
    require 'connection.php';
    $sql = "DELETE FROM categoriestbl WHERE kategori_id=$id";
    $sonuc = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return $sonuc;
}
function addSerie($dizi_adi, $dizi_özeti, $dizi_yayintarihi, $dizi_resim, $dizi_rating, $dizi_kategorisi)
{
    require "connection.php";
    $sql = "INSERT INTO seriestbl (dizi_adi,dizi_özeti,dizi_yayintarihi,dizi_resim,dizi_rating,dizi_kategorisi) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $dizi_adi, $dizi_özeti, $dizi_yayintarihi, $dizi_resim, $dizi_rating, $dizi_kategorisi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    return $stmt;
}
function addCategory($Kategori_adi)
{
    require 'connection.php';
    $sql = "INSERT INTO categoriestbl (kategori_adi) VALUES (?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Kategori_adi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    return $stmt;
}
function emailCheck(string $email)
{
    include_once("PDOConnection.php");
    $connection = new Connection();
    $sql = "SELECT * FROM `tvseriesdb`.`users` WHERE email=:email";
    $stmt = $connection->getConnect()->prepare($sql);
    $stmt->execute(["email" => $email]);
    return $stmt->rowCount();
}
function login(string $email, string $password)
{
    include_once("PDOConnection.php");
    $connection = new Connection();
    $sql = "SELECT * FROM `tvseriesdb`.`users` WHERE email=? AND password=?";
    $stmt = $connection->getConnect()->prepare($sql);
    $stmt->execute([$email, $password]);
    return $stmt->fetch();
}
function register(string $username, string $email, string $password)
{
    include_once("PDOConnection.php");
    $connection = new Connection();
    $sql = "INSERT INTO `tvseriesdb`.`users` (username,email,password) VALUES (:username,:email,:password)";
    $stmt = $connection->getConnect()->prepare($sql);
    $stmt->execute(["username" => $username, "email" => $email, "password" => $password]);
    return $stmt->fetch();
}
function getUsers()
{
    include_once("PDOConnection.php");
    $connection = new Connection();
    $sql = "SELECT * FROM `tvseriesdb`.`users`";
    $stmt = $connection->getConnect()->prepare($sql);
    $stmt->execute([]);
    return $stmt->fetchAll();
}
function getUserById(int $id)
{
    include_once("PDOConnection.php");
    $connection = new Connection();
    $sql = "SELECT * FROM `tvseriesdb`.`users` WHERE user_id=:id";
    $stmt = $connection->getConnect()->prepare($sql);
    $stmt->execute(["id" => $id]);
    return $stmt->fetch();
}
function deleteUser(int $id)
{
    include_once("PDOConnection.php");
    $connection = new Connection();
    $sql = "DELETE FROM `tvseriesdb`.`users` WHERE user_id=:id";
    $stmt = $connection->getConnect()->prepare($sql);
    $stmt->execute(["id" => $id]);
    return $stmt;
}
function editUser(int $id, string $username, string $email, string $password, string $role)
{
    include_once("PDOConnection.php");
    $connection = new Connection();
    $sql = "UPDATE `tvseriesdb`.`users` SET username=:username,email=:email,password=:password,role=:role WHERE user_id=:id";
    $stmt = $connection->getConnect()->prepare($sql);
    $stmt->execute(["username" => $username, "email" => $email, "password" => $password, "role" => $role, "id" => $id]);
    return $stmt;
}
