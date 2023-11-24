<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("src/php/conn.php");

if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 4;

    $select = "SELECT * FROM users WHERE userEmail = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        $msg[] = 'A user is already registered with this email';
    } else {
        $insert = "INSERT INTO users (userName, userEmail, userPassword, roleId) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert);

        if ($stmt) {
            $stmt->bind_param("sssi", $username, $email, $password, $role);
            $stmt->execute();
            $userId = $stmt->insert_id;
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
        header('location:role.php?id='. $userId);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("src/pages/head.html") ?>
    <title>Sign up | O'PEP</title>
</head>

<body>

    <?php include("src/pages/nav.html") ?>

    <div class="flex justify-center my-12">
        <div class="flex flex-col justify-center w-1/2 bg-white border border-black rounded-xl">
            <form class="w-3/4 mx-auto" method="post">
                <div class="flex flex-col mt-8">
                    <div class="capitalize mb-5 font-semibold text-xl">
                        <p>Sign Up</p>
                    </div>

                    <?php
                    if (isset($msg)) {
                        foreach ($msg as $error) {
                            echo '<div class="bg-red-500 mb-3 rounded-lg">';
                            echo '<p class="text-white text-lg text-center">' . $error . '</p>';
                            echo '</div>';
                        }
                    }

                    ?>

                    <!-- Start of input name -->
                    <div class="flex flex-col mb-3">
                        <div id="nameBorder" class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Username</p>
                            <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="username" type="text" name="username" placeholder="John" autocomplete="off">
                        </div>
                        <div id="userERR" class="text-red-600 text-xs pl-3"></div>
                    </div>
                    <div class="flex flex-col mb-3">
                        <div id="nameBorder" class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Email</p>
                            <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="email" type="text" name="email" placeholder="example@exm.com" autocomplete="off">
                        </div>
                        <div id="emailERR" class="text-red-600 text-xs pl-3"></div>
                    </div>
                    <!-- End of input name -->
                    <div class="flex flex-col mb-3">
                        <div id="cardnumberBorder" class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Password</p>
                            <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="password" type="password" name="password" placeholder="***************">
                        </div>
                        <div id="passwordErr" class="text-red-600 text-xs pl-3"></div>
                    </div>
                    <div class="flex flex-col mb-3">
                        <div id="cardnumberBorder" class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                            <p class="text-xs">Repeat password</p>
                            <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="repeat" type="password" name="password2" placeholder="***************">
                        </div>
                        <div id="repeatErr" class="text-red-600 text-xs pl-3"></div>
                    </div>


                </div>
                <div class="flex justify-start mb-8">
                    <a href="login.php" class="text-sm text-gray-800 underline">Already have an account? Log In</a>
                </div>
                <div class="flex justify-end mb-4">
                    <input type="submit" name="submit" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Continue">
                </div>
            </form>

        </div>
    </div>

    <?php include("src/pages/footer.html") ?>

    <script src="src/js/burger.js"></script>
    <script src="src/js/cart.js"></script>
</body>

</html>