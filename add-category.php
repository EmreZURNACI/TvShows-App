<?php
require 'functions.php';
$years = listsOfYearsD();
?>
<?php

$kategoriAdi = $kategoriAdiErr = "";
$eklemeDurumu = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["Kaydet"]) and $_POST["Kaydet"] == "Kaydet") {

    if (!empty($_POST["floating_kategoriAdi"])) {
        $kategoriAdi = $_POST["floating_kategoriAdi"];
    } else {
        $kategoriAdiErr = "Dizi Adi Alanı Doldurulmalıdır";
    }
    if ((!empty($kategoriAdi))) {
        addCategory($kategoriAdi);
        $eklemeDurumu =
            "<div class='bg-indigo-900 text-center py-4 lg:px-4'>
                <a href='admin-category.php' >
                <div class='p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex' role='alert'>
                    <span class='flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3'>New</span>
                    <span class='font-semibold mr-2 text-left flex-auto'>Yeni Kayıt Eklendi</span>
                    <svg class='fill-current opacity-75 h-4 w-4' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path d='M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z'/></svg>
                </div>
                </a>
             </div>";
    } else {
        $eklemeDurumu = "<div class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4' role='alert'>
        <p class='font-bold'>Be Warned</p>
        <p>Yeni Kayıt Eklenemedi</p>
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

<body class="bg-white border-gray-200 dark:bg-gray-800">
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo $eklemeDurumu;
    } ?>
    <?php require "Navbar.php"; ?>
    <div class="container mx-auto my-3">
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="floating_kategoriAdi" id="floating_kategoriAdi" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="floating_kategoriAdi" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kategori Adı:</label>
                <?php if (!empty($kategoriAdiErr)) echo ("<span  class='text-red-800'>$kategoriAdiErr</span>") ?>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="Kaydet" value="Kaydet">Kaydet</button>
        </form>
    </div>
</body>

</html>