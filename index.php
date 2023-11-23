<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("src/pages/conn.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/style/output.css">
    <link rel="icon" href="src/images/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Lexend&family=Podkova&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>O'PEP</title>

    <style>
        html {
            font-family: poppins;
        }

        #popupContent::-webkit-scrollbar {
            width: 0px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity));
        }

        #displaymenu {
            position: absolute;
            right: 0;
            background-color: white;
        }

        .show {
            display: block;
        }
    </style>

</head>

<body class="flex flex-col justify-between h-[100vh]">
    <?php include("src/pages/nav.html"); ?>
    <script src="src/js/burger.js"></script>
    <script src="src/js/cart.js"></script>
    <?php include("src/pages/footer.html"); ?>
</body>

</html>