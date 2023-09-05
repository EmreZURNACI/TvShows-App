<?php
require "functions.php";
$diziAdi = "";
$diziOzeti = "";
$diziResim = "";
$diziRating =  "";
$diziYayinTarihi = "";
$id = $_GET["id"];
$years = listsOfYearsA();
?>
<?php
$res = mysqli_fetch_assoc(getSeries($id));
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["degislikleriKaydet"]) and $_POST["degislikleriKaydet"] == "degislikleriKaydet") {
    if (!empty($_POST["DiziAdı"])) {
        $diziAdi = $_POST["DiziAdı"];
    } else {
        $diziAdi = $res["dizi_adi"];
    }
    if (!empty($_POST["DiziÖzeti"])) {
        $diziOzeti = $_POST["DiziÖzeti"];
    } else {
        $diziOzeti = $res["dizi_özeti"];
    }
    if (!empty($_POST["DiziRating"])) {
        $diziRating = $_POST["DiziRating"];
    } else {
        $diziRating = $res["dizi_rating"];
    }
    if (!empty($_POST["DiziYayınTarihi"])) {
        $diziYayinTarihi = $_POST["DiziYayınTarihi"];
    } else {
        $diziYayinTarihi = $res["dizi_yayintarihi"];
    }
    if (!empty($_FILES["Dizi Resim"]["name"])) {
        $targetFile = "./images/";
        $diziResim = $_FILES["Dizi Resim"]["name"];
        $fileSource = $_FILES["Dizi Resim"]["tmp_name"];
        $fileDest = $targetFile . $diziResim;
        move_uploaded_file($fileSource, $fileDest);
    } else {
        $diziResim = $res["dizi_resim"];
    }

    if ((!empty($diziAdi)) and (!empty($diziResim)) and (!empty($diziRating)) and (!empty($diziYayinTarihi))) {
        updateSeries($diziAdi, $diziOzeti, $diziYayinTarihi, $diziResim, $diziRating, $id);
        header("Location:admin-series.php");
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

<body>
    <?php include "Navbar.php"; ?>
    <div class="container mx-auto mt-3 border border-blue-800 rounded-xl p-4">
        <h2 class="text-3xl">Diziyi Düzenle</h2>
        <form method="POST" enctype="multipart/form-data" class="flex flex-col">
            <div class="mb-3">
                <label for="Dizi Adı" class="text-xl">Dizi Adı</label>
                <input type="text" name="DiziAdı" id="Dizi Adı" class="py-2 border border-blue-800 rounded-xl w-full text-xl ps-1" value="<?php echo $res["dizi_adi"] ?>">
            </div>
            <div class="mb-3">
                <label for="Dizi Özeti" class="text-xl">Dizi Özeti</label>
                <textarea type="text" name="DiziÖzeti" id="Dizi Özeti" class="py-2 border border-blue-800 rounded-xl w-full">
               <?php echo $res["dizi_özeti"] ?>
                </textarea>
            </div>
            <div class="mb-3 flex">
                <div>
                    <label for="Dizi Resim" class="text-xl">Dizi Resim</label>
                    <img src="./images/<?php echo $res["dizi_resim"] ?>" alt="" width="200px" height="150px">
                    <input type="file" name="DiziResim" id="Dizi Resim" class="py-2  w-full">
                </div>
                <div>
                    <div>
                        <label for="Dizi Rating" class="text-xl">Dizi Rating</label>
                        <input type="number" name="DiziRating" id="Dizi Rating" class="py-2 border border-blue-800 rounded-xl w-full text-xl ps-1" max="10" min="0" step="0.1" value="<?php echo $res["dizi_rating"] ?>">
                    </div>
                    <div class="flex flex-col">
                        <label for="Dizi Yayın Tarihi" class="text-xl">Dizi Yayın Tarihi</label>
                        <select name="DiziYayınTarihi" id="Dizi Yayın Tarihi" class="border border-blue-800 rounded-xl text-xl p-2">
                            <?php foreach ($years as $year) : ?>
                                <option value="<?php echo $year ?>" <?php echo ($res["dizi_yayintarihi"] == $year ? "selected" : "") ?>>
                                    <?php echo $year ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="inline-block py-2 px-4 bg-green-600 rounded-xl text-white border border-green-600 font-semibold transition duration-700 hover:bg-white hover:text-green-600" name="degislikleriKaydet" value="degislikleriKaydet">
                    Değişiklikleri Kaydet
                </button>
            </div>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('Dizi Özeti');
    </script>
</body>

</html>