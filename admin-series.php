<?php
require "functions.php";
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
    <div class="container mx-auto flex items-center justify-center flex-col ">
        <a href="add-seri.php" class="my-4 inline-block py-2 px-4 bg-blue-800 rounded-xl text-white border border-blue-800 font-semibold transition duration-700 hover:bg-white hover:text-blue-800 ">Dizi Ekle</a>
        <table>
            <thead>
                <tr>
                    <th class="text-xl">Dizi ID</th>
                    <th class="text-xl">Dizi Adı</th>
                    <th class="text-xl">Dizi Resmi</th>
                    <th class="text-xl">Dizi Rating</th>
                    <th class="text-xl">Dizi Yayın Tarihi</th>
                    <th class="text-xl">Dizi Kategorisi</th>
                    <th class="text-xl">#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (getSeries() as $serie) : ?>
                    <tr>
                        <td class="font-bold  text-center"><?php echo $serie["dizi_id"] ?></td>
                        <td class="font-bold  text-center w-52"><?php echo $serie["dizi_adi"] ?></td>
                        <td class="font-bold  text-center w-52 flex items-center justify-center">
                            <img width="150px" height="150px" src="./images/<?php echo $serie["dizi_resim"] ?>" alt="<?php echo $serie["dizi_adi"] ?>">
                        </td>
                        <td class="font-bold  text-center w-52"><?php echo $serie["dizi_rating"] ?></td>
                        <td class="font-bold  text-center w-52"><?php echo $serie["dizi_yayintarihi"] ?></td>
                        <td class="font-bold  text-center w-52"><?php echo $serie["kategori_adi"] ?></td>
                        <td class="font-bold  text-center">
                            <a href="edit-serie.php?id=<?php echo $serie["dizi_id"] ?>" class="inline-block py-2 px-4 bg-yellow-600 rounded-xl text-white border border-yellow-600 font-semibold transition duration-700 hover:bg-white hover:text-yellow-600 ">Diziyi Düzenle</a>
                            <button 
                            data-modal-target="popup-modal<?php echo $serie["dizi_id"] ?>" 
                            data-modal-toggle="popup-modal<?php echo $serie["dizi_id"] ?>" 
                            class="inline-block py-2 px-4 bg-red-800 rounded-xl text-white border border-red-800 font-semibold transition duration-700 hover:bg-white hover:text-red-800 " type="button">
                                Diziyi Sil
                            </button>
                            <div id="popup-modal<?php echo $serie["dizi_id"] ?>" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal<?php echo $serie["dizi_id"] ?>">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this show?</h3>
                                            <a href="delete-serie.php?id=<?php echo $serie["dizi_id"]; ?>" data-modal-hide="popup-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                Yes, I'm sure
                                            </a>
                                            <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>