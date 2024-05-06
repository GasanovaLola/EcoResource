<?php
require "database.php";
$token = $_GET["token"];
$token_hash = hash("sha256", $token);

if ($conn) {
    $sql = "SELECT * FROM users WHERE reset_token_hash = ?";

    $stmt = $conn->prepare($sql);

    // Проверка успешности подготовки запроса
    if ($stmt) {
        $stmt->bind_param("s", $token_hash);
        $stmt->execute();

        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        if ($user === null) {
            die("Token not found");
        }

        if (strtotime($user["reset_token_expires_at"]) <= time()) {
            die("Token has expired");
        }
    } else {
        die("Failed to prepare statement");
    }
} else {
    die("Connection failed");
}
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
                    <button type="button" class="btn btn-outline-primary" onclick="redirectToRegistration()" style="margin: 0 2px">Registration</button>
                    <button type="button" class="btn btn-outline-secondary" disabled style="margin: 0 2px">Log in</button>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="main">
            <div class="row row-medium" style="justify-content: center">
                <div class="column width-1-1-lg width-1-1-md width-1-1-sm" style="display: block; margin: 50px 0">
                    <form style="width: 100%" action="process_reset_password.php" method="post">
                        <h2 class="title" style="text-align: left; font-size: 34px; color: #0B1C3F">Password recovery:</h2>
                        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                        <div class="form-group">
                            <label for="password" class="text">Password</label>
                            <input name="password" type="password" class="form-control" id="InputPassword" placeholder="Password" style="margin: 5px 0;">
                            <small id="passwordHelp" class="form-text text-muted" style="font-size: 14px;">Must be 8 or more characters and contain at least 1 number and 1 special character.</small>
                        </div>
                        <div class="form-group">
                            <label for="repeat_password" class="text">Confirm password</label>
                            <input name="repeat_password" type="password" class="form-control" id="repeat_password" placeholder="Confirm password .." style="margin: 5px 0;">
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">SIGN UP</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer-light">
            <p class="copyright" style="border: none; padding: 0; margin-top: 0;">Edinburgh College <br><a href="copyright.php">© 2024 EcoResource (UK)</a></p>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/813d54a682.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>