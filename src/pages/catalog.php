<?php

include("../includes/conn.php");
session_start();

if (!isset($_SESSION['client_name'])) {
    echo "You don't have permission";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Catalog | O'PEP</title>
    <style>
        .object-contain:hover #hover {
            transform: translate(0, 0);
            opacity: 1;
        }
    </style>
</head>

<body>

    <?php include("../includes/nav.php") ?>
    <?php $select = "SELECT * FROM categories";
    $stmt = $conn->prepare($select);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = htmlspecialchars($row['categoryId']);
            $name = htmlspecialchars($row['categoryName']);
    ?>
        
    <?php
        }
    } else {
        echo 'No categories in database';
    } ?>
    <div class="flex flex-col justify-between items-center border-2 border-amber-600 rounded-xl m-2 md:h-[150vh]">
        <div class="grid gap-16 w-[90%] mt-6 rounded-lg mx-auto text-center grid-cols-2 md:gap-4 md:w-[95%] md:grid-cols-3">
            <!-- content -->
            <?php
            $records = $conn->query("SELECT * FROM plants");
            $rows = $records->num_rows;

            $start = 0;
            $rows_per_page = 6;
            if (isset($_GET['page'])) {
                $page = $_GET['page'] - 1;
                $start = $page * $rows_per_page;
            }
            $select = "SELECT plantId, plantName, plantDesc, plantPrice, plantImage, categoryName FROM plants INNER JOIN categories ON plants.categoryId = categories.categoryId LIMIT ?,?";
            $stmt = $conn->prepare($select);
            $stmt->bind_param("ii", $start, $rows_per_page);
            $stmt->execute();
            $result = $stmt->get_result();
            $pages = ceil($rows / $rows_per_page);

            if ($rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = htmlspecialchars($row['plantId']);
                    $name = htmlspecialchars($row['plantName']);
                    $categorie = htmlspecialchars($row['categoryName']);
                    $desc = htmlspecialchars($row['plantDesc']);
                    $image = htmlspecialchars($row['plantImage']);
                    $price = htmlspecialchars($row['plantPrice']);
            ?>
                    <div class="flex flex-col justify-center items-center gap-4 w-[80%] mx-auto">
                        <div class="relative object-contain">
                            <img src="../images/Plants/<?php echo $image ?>" alt="">
                            <div id="hover" class="absolute bottom-0 left-0 w-full bg-white transition-all duration-500 transform translate-y-full opacity-0">
                                <p class="p-4"><?php echo $desc ?></p>
                            </div>
                        </div>
                        <div class="flex flex-col justify-between items-center md:flex-row">
                            <div class="flex flex-col child:text-left">
                                <p><?php echo $name ?></p>
                                <p><?php echo $categorie ?></p>
                            </div>
                            <div class="flex items-center justify-center gap-4">
                                <p><?php echo $price ?>DH</p>
                                <button class="p-2 bg-amber-600 border border-black rounded-lg">Add to cart</button>
                            </div>
                        </div>
                    </div>
            <?php
                }
                echo '</div>';
            } else {
                echo 'No client accounts in database';
            }
            ?>
            <div class="w-full">
                <div class="pl-2 md:pl-8">
                    <?php
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    ?>
                    Showing <?php echo $page ?> of <?php echo $pages ?>
                </div>
                <div class="flex flex-row justify-center items-center gap-3">

                    <a href="?page=1">First</a>
                    <?php if (isset($_GET['page']) && $_GET['page'] > 1) { ?>

                        <a href="?page=<?php echo $_GET['page'] - 1 ?>">Previous</a>

                    <?php } else { ?>
                        <a class="cursor-pointer">Previous</a>
                    <?php } ?>

                    <?php
                    for ($i = 1; $i <= $pages; $i++) {
                    ?>
                        <a href="?page=<?php echo $i ?>" class=""><?php echo $i ?></a>
                    <?php
                    }
                    ?>
                    <?php
                    if (!isset($_GET['page'])) {
                        if ($pages == 1) {
                    ?>
                            <a class="cursor-pointer">Next</a>
                        <?php } else { ?>
                            <a href="?page=2">Next</a>
                        <?php } ?>

                    <?php } elseif ($_GET['page'] >= $pages) { ?>
                        <a class="cursor-pointer">Next</a>
                    <?php } else { ?>
                        <a href="?page=<?php echo $_GET['page'] + 1 ?>">Next</a>
                    <?php }
                    ?>
                    <a href="?page=<?php echo $pages ?>">Last</a>
                </div>
            </div>
        </div>
        <?php include("../includes/footer.html") ?>

        <script src="../js/burger.js"></script>
        <script src="../js/cart.js"></script>
</body>

</html>