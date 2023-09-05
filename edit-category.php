<?php
require 'functions.php';
$id = $_GET["id"];
$res = mysqli_fetch_assoc(getCategories($id));
$kategoriAdi = $eklemeDurumu = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["Kaydet"]) and $_POST["Kaydet"] == "Kaydet") {
    $kategoriAdi = $_POST["kategori_adi"];
    if (!empty($kategoriAdi)) {
        updateCategory($id, $kategoriAdi);
    } else {
        updateCategory($id, $res["kategori_adi"]);
    }
    $eklemeDurumu =
        "<div class='bg-indigo-900 text-center py-4 lg:px-4'>
                <a href='admin-categories.php'>
                    <div class='p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex' role='alert'>
                        <span class='flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3'>Info</span>
                        <span class='font-semibold mr-2 text-left flex-auto'>Kayıt Düzenlendi.</span>
                        <svg class='fill-current opacity-75 h-4 w-4' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path d='M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z'/></svg>
                    </div>
                </a>        
         </div>";
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
    <?php require 'Navbar.php'; ?>
    <form method="POST" class="container mx-auto">
        <div class="mb-6">
            <label for="kategori_adi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Adı:</label>
            <input type="text" id="kategori_adi" name="kategori_adi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $res["kategori_adi"] ?>">
        </div>
        <div>
            <button name="Kaydet" value="Kaydet" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Kaydet
                </span>
            </button>
        </div>
    </form>
</body>

</html>