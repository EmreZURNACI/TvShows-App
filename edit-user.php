<?php
$id = $_GET["id"];
include "functions.php";
$user = getUserById($id);
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = null;
    $password = null;
    $email = null;
    $role = null;
    if (!empty($_POST["Username"])) {
        $username = $_POST["Username"];
    } else {
        $username = $user->username;
    }
    if (!empty($_POST["Email"])) {
        $email = $_POST["Email"];
    } else {
        $email = $user->email;
    }
    if (!empty($_POST["Password"])) {
        $password = $_POST["Password"];
    } else {
        $password = $user->password;
    }
    if (!empty($_POST["role"])) {
        $role = $_POST["role"];
    } else {
        $role = $user->role;
    }
    if ((!empty($username)) && (!empty($email)) && (!empty($password)) && (!empty($role))) {
        editUser($user->user_id,$username, $email, $password, $role);
        header("Location:admin-users.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="bg-white border-gray-200 dark:bg-gray-900">
    <?php
    include_once "Navbar.php";
    ?>
    <div class="container mx-auto">
        <form method="POST" class="w-2/5 mx-auto">
            <div class="mb-4">
                <label class="block text-gray-400 font-bold mb-2" for="Username">
                    Username
                </label>
                <input class="shadow appearance-none border border-gray-600  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Username" type="text" placeholder="Username" name="Username" autocomplete="off" maxlength="30" value="<?php echo $user->username ?>">
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 font-bold mb-2" for="Email">
                    Email
                </label>
                <input class="shadow appearance-none border border-gray-600  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Email" type="email" placeholder="Email" name="Email" autocomplete="off" maxlength="30" value="<?php echo $user->email ?>">
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 font-bold mb-2" for="Password">
                    Password
                </label>
                <input class="shadow appearance-none border border-gray-600  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Password" type="text" placeholder="Password" name="Password" autocomplete="off" maxlength="16" value="<?php echo $user->password ?>">
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 font-bold mb-2" for="Password">
                    role
                </label>
                <select class="shadow appearance-none border border-gray-600  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" type="text" placeholder="role" name="role" autocomplete="off" maxlength="5">
                    <option value="-1">Rol Seç</option>
                    <option <?php echo $user->role == "USER" ? "selected" : "" ?> value="USER">USER</option>
                    <option <?php echo $user->role == "ADMIN" ? "selected" : "" ?> value="ADMIN">ADMIN</option>
                </select>
            </div>
            <div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Düzenle
                </button>
            </div>
        </form>
    </div>
</body>

</html>