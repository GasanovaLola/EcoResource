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

            if (isset($_POST["email"])) {
                $email = $_POST["email"];

                $token = bin2hex(random_bytes(16));
                $token_hash = hash("sha256", $token);
                $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

                // Check if the connection was successful
                if ($conn) {
                    // Preparing SQL query
                    $sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";

                    // Prepare and execute the request
                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        // Binding of parameters and query execution
                        mysqli_stmt_bind_param($stmt, "sss", $token_hash, $expiry, $email);
                        mysqli_stmt_execute($stmt);

                        // Check the number of affected lines
                        $affected_rows = mysqli_stmt_affected_rows($stmt);

                        if ($affected_rows > 0) {
                            // Connect to PHPMailer
                            $mail = require __DIR__ . "/mailer.php";

                            // Setting the parameters of the letter
                            $mail->addAddress($email);
                            $mail->Subject = "Password Reset";
                            $mail->Body = "Click <a href='http://localhost/EcoResource/reset_password.php?token=$token'>here</a> to reset your password.";

                            // Sending an email
                            if ($mail->send()) {
                                echo "<p style='text-align: center; font-size: 28px; color: #0b1c3f; margin: 240px 0;'>Message sent, please check your inbox.</p>";
                            } else {
                                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                            }
                        } else {
                            echo "Error: The password reset token has not been updated.";
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "An error in the preparation of the request: " . mysqli_error($conn);
                    }
                } else {
                    echo "Database connection error.";
                }
            } else {
                echo "Unspecified email.";
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