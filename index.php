<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("src/php/conn.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("src/pages/head.html")?>
    <title>Home | O'PEP</title>
</head>

<body class="flex flex-col justify-between h-[100vh]">
    <?php include("src/pages/nav.html"); ?>
    <script src="src/js/burger.js"></script>
    <script src="src/js/cart.js"></script>
    <?php include("src/pages/footer.html"); ?>
</body>

</html>