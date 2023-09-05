<?php
require("functions.php");
$diziKategorisi = "";
$diziName = "";
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <?php include "Navbar.php" ?>
    <div class="container mx-auto">
        <div class="flex py-2 gap-4">
            <div class="w-1/5">
                <ul>
                    <?php foreach (getCategories() as $category) :  ?>
                        <li class="list-none border-b border-blue-700 text-xl font-semibold text-blue-900 py-2">
                            <?php if (!isset($_GET["diziName"])) : ?>
                                <a href="./index.php?category=<?php echo $category["kategori_adi"]; ?>"><?php echo $category["kategori_adi"]; ?></a>
                            <?php else : ?>
                                <a href="./index.php?category=<?php echo $category["kategori_adi"]; ?>&diziName=<?php echo $_GET["diziName"] ?>"><?php echo $category["kategori_adi"]; ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach;  ?>
                </ul>
            </div>
            <div class=" w-4/5">
                <?php
                isset($_GET["category"]) ? $diziKategorisi = $_GET["category"] : $diziKategorisi = null;
                isset($_GET["diziName"]) ? $diziName = $_GET["diziName"] : $diziName = null;
                ?>
                <?php if (mysqli_num_rows(getSeries(null, $diziKategorisi, $diziName)) > 0) : ?>
                    <ul class="grid grid-cols-3 gap-3">
                        <?php foreach (getSeries(null, $diziKategorisi, $diziName) as $serie) :  ?>
                            <li class="list-none relative">
                                <div class="w-full h-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ">
                                    <a href="seriesDetails?name=<?php echo $serie["dizi_adi"] ?>">
                                        <img class="rounded-t-lg" width="100%" src="./images/<?php echo $serie["dizi_resim"] ?>" alt="Picture of <?php echo $serie["dizi_adi"] ?>" />
                                    </a>
                                    <div class="p-5">
                                        <div class="flex justify-between items-center">
                                            <a href="seriesDetails?name=<?php echo $serie["dizi_adi"] ?>">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $serie["dizi_adi"] ?></h5>
                                            </a>
                                            <div class="grid grid-cols-2 gap-2 items-center">
                                                <span class="font-normal text-white"><?php echo $serie["dizi_rating"] ?><i class="fa-solid fa-star" style="color: #e5f50a;"></i></span>
                                                <span class="font-normal text-white"><?php echo $serie["dizi_yayintarihi"] ?></span>
                                            </div>
                                        </div>
                                        <div class="text-white">
                                            <?php echo html_entity_decode($serie["dizi_özeti"])  ?>
                                        </div>
                                        <?php if (isset($_COOKIE["username"])) : ?>
                                            <a href="https://yabancidizi.pro/dizi/<?php echo strtolower(str_replace(" ", "-", $serie["dizi_adi"])) ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                İzlemek İçin Git
                                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>
                                            </a>
                                        <?php else : ?>
                                            <a href="login.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                İzlemek İçin Giriş Yap
                                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>

                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </li>
                        <?php endforeach;  ?>
                    </ul>
                <?php else : ?>
                    <div class="flex items-center justify-center h-full">
                        <p class="text-5xl w-3/5 text-center text-red-900">Sitemizde bu filtrelemeye uygun dizi bulunmamaktadır.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>

</html>