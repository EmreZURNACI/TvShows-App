<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = null;
    $password = null;
    $email = null;
    $usernameErr = null;
    $passwordErr = null;
    $emailErr = null;
    $EmailCheckErr = null;
    if (!empty($_POST["username"])) {
        $username = $_POST["username"];
    } else {
        $usernameErr = "Ad inputu boş geçilemez";
    }
    if (!empty($_POST["password"])) {
        $password = $_POST["password"];
    } else {
        $usernameErr = "Ad inputu boş geçilemez";
    }
    if (!empty($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        $usernameErr = "Ad inputu boş geçilemez";
    }

    if (emailCheck($email) < 1) {
        if ((!empty($password)) && (!empty($username)) && (!empty($email))) {
            register($username, $email, $password);
            header("Location:admin-users.php");
        }
    } else {
        $EmailCheckErr = "<div class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4' role='alert'>
        <p class='font-bold'>Be Warned</p>
        <p>Bu email adresi kullanılmaktadır.Başka mail adresi seçiniz.</p>
        </div>";
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
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($EmailCheckErr != null) {
            echo $EmailCheckErr;
        }
    }
    ?>
    <?php include_once("Navbar.php") ?>
    <div class="h-[calc(100vh-200px)] w-full flex items-center justify-center">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" class="w-1/4">
            <div class="mb-4">
                <label class="block text-gray-400 font-bold" for="Name">
                    Name
                </label>
                <input class="shadow appearance-none border border-gray-600  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Name" type="Name" placeholder="Name" autocomplete="off" maxlength="30" name="username">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (!empty($usernameErr)) {
                        echo $usernameErr;
                    }
                }
                ?>
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 font-bold" for="Email">
                    Email
                </label>
                <input class="shadow appearance-none border border-gray-600  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Email" type="email" placeholder="Email" autocomplete="off" maxlength="100" name="email">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (!empty($emailErr)) {
                        echo $emailErr;
                    }
                }
                ?>
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 font-bold" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border  border-gray-600 rounded  w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="text" maxlength="16" name="password" autocomplete="off">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (!empty($passwordErr)) {
                        echo $passwordErr;
                    }
                }
                ?>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Kullanıcı Ekle
                </button>
            </div>
        </form>
    </div>
</body>

</html>