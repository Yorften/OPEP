<?php

    include("../includes/conn.php");
    session_start();

    if(!isset($_SESSION['client_name'])){
        echo "You don't have permission";
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Dashboard</title>
</head>

<body>

    <?php include("../includes/nav.php") ?>
        ABOUT US
    <?php include("../includes/footer.html") ?>

    <script src="../js/burger.js"></script>
    <script src="../js/cart.js"></script>
    <script src="../js/cartmenu.js"></script>
</body>

</html>