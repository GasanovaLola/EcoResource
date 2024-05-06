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
                    <button type="button" class="btn btn-outline-secondary" disabled style="margin: 0 2px">Registration</button>
                    <button type="button" class="btn btn-outline-primary" onclick="redirectToLogin()" style="margin: 0 2px">Log in</button>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="main">
            <?php
            require "database.php";
            $token = $_POST["token"];
            $token_hash = hash("sha256", $token);

            if ($conn) {
                $sql = "SELECT * FROM users WHERE reset_token_hash = ?";

                $stmt = $conn->prepare($sql);

                // Check whether the request has been successfully prepared
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

                    $password = $_POST["password"];
                    $passwordRepeat = $_POST["repeat_password"];

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $errors = array();

                    if (empty($password) OR empty($passwordRepeat)) {
                        array_push($errors, "All fields are required");
                    }
                    if (strlen($password) < 8) {
                        array_push($errors, "Password must be at least 8 characters long");
                    }
                    if ($password !== $passwordRepeat) {
                        array_push($errors, "Password does not match");
                    }

                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<div class='alert alert-danger'> $error </div>";
                        }
                    } else {

                        $sql = "UPDATE users SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = ?";

                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ss", $passwordHash, $user["id"]);
                        $stmt->execute();
                        echo "<p style='text-align: center; font-size: 28px; color: #0b1c3f; margin: 240px 0;'>Password updated. You can now <a href='logout.php'>login</a>.</p>";
                    }
                } else {
                    die("Failed to prepare statement");
                }
            } else {
                die("Connection failed");
            }
            ?>
        </div>

        <div class="footer-light">
            <p class="copyright" style="border: none; padding: 0; margin-top: 0;">Edinburgh College <br><a href="copyright.php">© 2024 EcoResource (UK)</a></p>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/813d54a682.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function redirectToLogin() {
        window.location.href = 'login.php'; // Replace 'login.php' with the actual login page URL
    }
</script>
</body>
</html>