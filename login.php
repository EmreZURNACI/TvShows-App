<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = null;
    $password = null;
    $emailErr = null;
    $passwordErr = null;
    $hataMesajı = null;
    if (!empty($_POST["Email"])) {
        $email = $_POST["Email"];
    } else {
        $emailErr = "Email Alanı Boş Geçilenemez";
    }
    if (!empty($_POST["Password"])) {
        $password = $_POST["Password"];
    } else {
        $passwordErr = "Password Alanı Boş Geçilenemez";
    }
    if ((empty($emailErr) || $emailErr == null) && (empty($passwordErr) || $passwordErr == null)) {
        include_once("functions.php");
        $result = login($email, $password);
        if (!empty($result->username)) {
            setcookie("username", $result->username, (time() + 60 * 60 * 24), "/");
            setcookie("role", $result->role, (time() + 60 * 60 * 24), "/");
            header("Location:index.php");
            exit;
        } else {
            $hataMesajı = "<div class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4' role='alert'>
            <p class='font-bold'>Be Warned</p>
            <p>HATALI GİRİŞ</p>
            </div>";
        }
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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $hataMesajı != null) {
        echo $hataMesajı;
    }
    ?>
    <?php include_once("Navbar.php") ?>
    <div class="h-[calc(100vh-300px)] w-full flex items-center justify-center">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" class="w-1/4">
            <div class="mb-4">
                <label class="block text-gray-400 font-bold mb-2" for="Email">
                    Email
                </label>
                <input class="shadow appearance-none border border-gray-600  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Email" type="email" placeholder="Email" name="Email" autocomplete="off" maxlength="100">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (($emailErr) != null) {
                        echo $emailErr;
                    }
                } ?>
            </div>
            <div class="mb-6">
                <label class="block text-gray-400 font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border  border-gray-600 rounded  w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="Password" placeholder="******************" maxlength="16">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (($passwordErr) != null) {
                        echo $passwordErr;
                    }
                } ?>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    Forgot Password?
                </a>
            </div>

            <p class="text-center text-gray-500 text-xs my-2">
                &copy;2025 EmreZURNACI Corp. All rights reserved.
            </p>
        </form>
    </div>
</body>

</html>