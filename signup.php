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
    <title>Sign up | O'PEP</title>
</head>
<body>
    <?php include("src/pages/nav.html")?>
    <?php include("src/pages/login.html")?>
    <?php include("src/pages/footer.html")?>
</body>
</html>
