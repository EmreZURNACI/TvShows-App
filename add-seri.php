<?php
require 'functions.php';
$years = listsOfYearsD();
?>
<?php

$diziAdi = $diziAdiErr = "";
$diziOzet = $diziOzetErr = "";
$diziRating = $diziRatingErr = "";
$diziYayinTarihi = $diziYayinTarihiErr = "";
$diziResim = $diziResimErr = "";
$diziKategorileri = array();
$diziKategoriErr = "";
$eklemeDurumu = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["Kaydet"]) and $_POST["Kaydet"] == "Kaydet") {

    if (!empty($_POST["floating_diziName"])) {
        $diziAdi = $_POST["floating_diziName"];
    } else {
        $diziAdiErr = "Dizi Adi Alanı Doldurulmalıdır";
    }

    if (!empty($_POST["floating_diziOzet"])) {
        $diziOzet = $_POST["floating_diziOzet"];
    } else {
        $diziOzetErr = "Dizi Özet Alanı Doldurulmalıdır";
    }

    if (!empty($_POST["floating_diziYayinTarihi"]) and $_POST["floating_diziYayinTarihi"] != -1) {
        $diziYayinTarihi = $_POST["floating_diziYayinTarihi"];
    } else {
        $diziYayinTarihiErr = "Dizi Yayın Tarihi Alanı Doldurulmalıdır";
    }

    if (!empty($_FILES["floating_resim"]["name"])) {
        $diziResim = $_FILES["floating_resim"]["name"];
        $targetFile = "./images/";
        $fileDest = $targetFile . $diziResim;
        $fileSrc = $_FILES["floating_resim"]["tmp_name"];
        move_uploaded_file($fileSrc, $fileDest);
    } else {
        $diziResimErr = "Dizi Resim Alanı için resim seçilmelidir.";
    }

    if (!empty($_POST["floating_Rating"])) {
        $diziRating = $_POST["floating_Rating"];
    } else {
        $diziRatingErr = "Dizi Rating Alanı Doldurulmalıdır";
    }

    if (!empty($_POST["kategoriler"])) {
        foreach ($_POST["kategoriler"] as $kategori) {
            array_push($diziKategorileri, $kategori);
        }
    } else {
        $diziKategoriErr = "En az bir tane kategori seçilmelidir.";
    }
    if ((!empty($diziAdi)) and (!empty($diziOzet)) and (!empty($diziYayinTarihi)) and (!empty($diziRating)) and (!empty($diziResim)) and (!empty($diziKategorileri))) {
        addSerie($diziAdi, $diziOzet, $diziYayinTarihi, $diziResim, $diziRating, $diziKategorileri);
        $eklemeDurumu =
            "<div class='bg-indigo-900 text-center py-4 lg:px-4'>
                <a href='admin-series.php' >
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
                <input type="text" name="floating_diziName" id="floating_diziName" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="floating_diziName" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dizi Adı:</label>
                <?php if (!empty($diziAdiErr)) echo ("<span  class='text-red-800'>$diziAdiErr</span>") ?>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <textarea type="diziOzet" name="floating_diziOzet" id="floating_diziOzet" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "></textarea>
                <?php if (!empty($diziOzetErr)) echo ("<span  class='text-red-800'>$diziOzetErr</span>") ?>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <select name="floating_diziYayinTarihi" id="floating_diziYayinTarihi" class="block py-2.5 px-0 w-full text-sm bg-transparent text-white   border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                    <option class="text-semibold dark:text-gray-900" value="-1" selected>Select Year</option>
                    <?php foreach ($years as $year) : ?>
                        <option class="text-semibold dark:text-gray-900" value="<?php echo $year ?>"><?php echo $year ?></option>

                    <?php endforeach; ?>
                </select>
                <label for="floating_diziYayinTarihi" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dizi Yayın Tarihi</label>
                <?php if (!empty($diziYayinTarihiErr)) echo ("<span  class='text-red-800'>$diziYayinTarihiErr</span>") ?>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="file" name="floating_resim" id="floating_resim" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="floating_resim" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dizi Resim:</label>
                <?php if (!empty($diziResimErr)) echo ("<span  class='text-red-800'>$diziResimErr</span>") ?>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="number" max="10" min="0" step="0.1" name="floating_Rating" id="floating_Rating" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="floating_Rating" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dizi Rating</label>
                    <?php if (!empty($diziRatingErr)) echo ("<span  class='text-red-800'>$diziRatingErr</span>") ?>
                </div>
                <div>
                    <div class="relative z-0 w-full mb-6 group grid grid-cols-3 gap-3">
                        <?php foreach (getCategories() as $categori) : ?>
                            <div>
                                <input id="<?php echo $categori["kategori_adi"] ?>" value="<?php echo $categori["kategori_id"] ?>" name="kategoriler[]" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="<?php echo $categori["kategori_adi"] ?>" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"><?php echo $categori["kategori_adi"] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (!empty($diziKategoriErr)) echo ("<span  class='text-red-800'>$diziKategoriErr</span>") ?>
                </div>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="Kaydet" value="Kaydet">Kaydet</button>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('floating_diziOzet');
    </script>
</body>

</html>