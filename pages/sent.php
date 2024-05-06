<?php
session_start();
$isUserLoggedIn = isset($_SESSION["user"]) && is_array($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
    <title>Log In From</title>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <div class="top-header" style="border-color: #80FF00;">
                <a href="index.php">
                    <div class="logo" style="display: flex;">
                        <img src="./images/plant-care_12779251.png" style="width: 50px;" alt="">
                        <p>EcoResource</p>
                    </div>
                </a>
                <div class="authentication">
                    <?php if (!$isUserLoggedIn) : ?>
                        <button type="button" class="btn btn-outline-primary" onclick="redirectToRegistration()" style="margin: 0 2px">Registration</button>
                        <button type="button" class="btn btn-outline-primary" onclick="redirectToLogin()" style="margin: 0 2px">Log in</button>
                    <?php endif; ?>
                    <?php if ($isUserLoggedIn && isset($_SESSION["user"]["full_name"])) : ?>
                        <button type="button" class="btn btn-outline-primary" onclick="redirectToLogout()" style="margin: 0 2px">Log Out</button>
                        <button type="button" class="btn btn-primary" onclick="redirectToPersonalAccount()" style="margin: 0 2px"><?php echo "Account: " . $_SESSION["user"]["full_name"]; ?></button>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="main">
            <p style='text-align: center; font-size: 28px; color: #0b1c3f; margin: 240px 0;'>Thank you for your message!</p>
        </div>

        <div class="footer-light">
            <p class="copyright" style="border: none; padding: 0; margin-top: 0;">Edinburgh College <br><a href="copyright.php">© 2024 EcoResource (UK)</a></p>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/813d54a682.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
        function redirectToRegistration() {
        window.location.href = 'registration.php';
    }

        function redirectToLogin() {
        window.location.href = 'login.php';
    }

        function redirectToLogout() {
        window.location.href = 'logout.php';
    }

        function redirectToPersonalAccount() {
        window.location.href = 'personal_account.php';
    }
</script>
</body>
</html>