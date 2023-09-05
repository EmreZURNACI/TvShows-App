<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = null;
    $password = null;
    $repassword = null;
    $email = null;
    $usernameErr = null;
    $passwordErr = null;
    $repasswordErr = null;
    $emailErr = null;
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
    if ($_POST["repassword"] != $password) {
        $repasswordErr = "Şifreler eşleşmiyor";
    }
    if ((!empty($_POST["repassword"])) && (!empty($password)) && ($_POST["repassword"] == $password) && (!empty($username)) && (!empty($email))) {
        require("functions.php");
        $result=register($username, $email, $password);
        setcookie("username", $result->username, (time() + 60 * 60 * 24), "/");
        setcookie("role", $result->role, (time() + 60 * 60 * 24), "/");
        header("Location:login.php");
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
                <input class="shadow appearance-none border  border-gray-600 rounded  w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" maxlength="16" name="password">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (!empty($passwordErr)) {
                        echo $passwordErr;
                    }
                }
                ?>
            </div>
            <div class="mb-6">
                <label class="block text-gray-400 font-bold" for="rePassword">
                    rePassword
                </label>
                <input class="shadow appearance-none border  border-gray-600 rounded  w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="rePassword" type="password" placeholder="******************" maxlength="16" name="repassword">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (!empty($repasswordErr)) {
                        echo $repasswordErr;
                    }
                }
                ?>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign Up
                </button>
            </div>

            <p class="text-center text-gray-500 text-xs my-2">
                &copy;2025 EmreZURNACI Corp. All rights reserved.
            </p>
        </form>
    </div>
</body>

</html>