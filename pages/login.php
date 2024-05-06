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
            <h2 class="title" style="text-align: left; font-size: 34px;">We welcome you to EcoResource!</h2>
            <div class="row row-medium">
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm extra-padding-right" style="border-right: 1px solid #0B1C3F; display: block">

                    <?php
                    if (isset($_POST["login"])) {
                        $email = $_POST["email"];
                        $password = $_POST["password"];

                        require_once "database.php";

                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $userData = mysqli_fetch_assoc($result);

                        if ($user) {
                            if ($user["status"] === "active") {
                                if (password_verify($password, $user["password"])) {
                                    session_start();
                                    $_SESSION["user"] = $user;

                                    if ($user["role"] === "admin") {
                                        header("Location: admin_panel.php");
                                    } else {
                                        header("Location: index.php");
                                    }
                                    exit();
                                } else {
                                    echo "<div class='alert alert-danger'> Password does not match. </div>";
                                }
                            }
                            else {
                                echo "<div class='alert alert-danger'> Your account is inactive. Please contact support. </div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'> Email does not match. </div>";
                        }
                    }
                    ?>

                    <form style="width: 100%" action="login.php" method="post">
                        <div class="form-group">
                            <label for="InputEmail" class="text">Email address</label>
                            <input name="email" type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter email" style="margin: 5px 0;">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="InputPassword" class="text">Password</label>
                            <input name="password" type="password" class="form-control" id="InputPassword" placeholder="Password" style="margin: 5px 0;">
                            <small id="passwordHelp" class="form-text text-muted" style="font-size: 14px;">Must be 8 or more characters and contain at least 1 number and 1 special character.</small>
                        </div>
                        <button name="login" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">SIGN UP</button>
                        <a style="font-size: 16px" href="forgot_password.php">I forgot the password.</a>

                    </form>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm extra-padding-left" style="display: block;">
                    <p style="margin: 20px 0">Don’t have an account? <a href="registration.php">Sign up</a> </p>

                    <button type="button" class="btn btn-outline-primary" style="display: flex; justify-content: center; width: 100%">
                        <img src="images/Google__G__logo.svg.png" alt="" style="height: 24px; margin-right: 15px">
                        Sign up with Google
                    </button>
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
<script>
    function redirectToRegistration() {
        window.location.href = 'registration.php'; // Replace 'registration.php' with the actual registration page URL
    }
</script>
</body>
</html>
