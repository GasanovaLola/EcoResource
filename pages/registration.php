<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
    <title>Registration Form</title>
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
                <h2 class="title" style="text-align: left; font-size: 34px;">We welcome you to EcoResource!</h2>
                <div class="row row-medium">
                    <div class="column width-1-2-lg width-1-2-md width-1-1-sm extra-padding-right" style="border-right: 1px solid #0B1C3F; display: block">

                        <?php
                            if(isset($_POST["submit"])) {
                            $fullName = $_POST["full_name"];
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            $passwordRepeat = $_POST["repeat_password"];

                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                            $errors = array();

                            if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
                                array_push($errors, "All fields are required");
                            }
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                array_push($errors, "Email is not valid");
                            }
                            if (strlen($password) < 8) {
                                array_push($errors, "Password must be at least 8 characters long");
                            }
                            if ($password !== $passwordRepeat) {
                                array_push($errors, "Password does not match");
                            }

                            require_once "database.php";
                            $sql = "SELECT * FROM users WHERE email = '$email'";

                                $result = mysqli_query($conn, $sql);
                                $rowCount = mysqli_num_rows($result);

                                if ($rowCount > 0) {
                                    array_push($errors, "Email alredy exists.");
                                }

                                if (count($errors) > 0) {
                                    foreach ($errors as $error) {
                                        echo "<div class='alert alert-danger'> $error </div>";
                                    }
                                } else {
                                    $sql = "INSERT INTO users (full_name, email, password) VALUES (?,?,?)";
                                    $stmt = mysqli_stmt_init($conn);
                                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                                    if ($prepareStmt) {
                                        mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                                        mysqli_stmt_execute($stmt);

                                        // Get the user ID of the newly inserted user
                                        $user_id = mysqli_insert_id($conn);

                                        echo "<div class='alert alert-success'>You are registered successfully.</div>";

                                        // Insert initial green points for the user
                                        $initial_green_points = 0;
                                        $sql_insert_green_points = "INSERT INTO green_points (user_id, count_of_green_points) VALUES (?, ?)";
                                        $stmt_insert_green_points = mysqli_prepare($conn, $sql_insert_green_points);

                                        if ($stmt_insert_green_points) {
                                            mysqli_stmt_bind_param($stmt_insert_green_points, "ii", $user_id, $initial_green_points);
                                            mysqli_stmt_execute($stmt_insert_green_points);
                                        } else {
                                            // echo "Error creating green points entry: " . mysqli_error($conn);
                                        }
                                    } else {
                                        die("Something went wrong");
                                    }
                                }
                            }
                        ?>

                        <form style="width: 100%" action="registration.php" method="post">
                            <div class="form-group">
                                <label for="InputFullName" class="text">Full Name</label>
                                <input name="full_name" type="text" class="form-control" id="InputFullName" aria-describedby="fullName" placeholder="Full Name.." style="margin: 5px 0;">
                            </div>
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
                            <div class="form-group">
                                <label for="InputConfirmPassword" class="text">Confirm password</label>
                                <input name="repeat_password" type="password" class="form-control" id="InputConfirmPassword" placeholder="Confirm password .." style="margin: 5px 0;">
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">SIGN UP</button>
                        </form>
                    </div>
                    <div class="column width-1-2-lg width-1-2-md width-1-1-sm extra-padding-left" style="display: block;">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="Check1">
                            <label class="form-check-label text" for="Check1" style="white-space: normal;">I confirm that I have read and agree with the
                                <a href="privacy_policy.php">privacy policy</a> and undertake to provide accurate data in accordance with the
                                <a href="terms_of_use_of_the_service.php">terms of use of the service</a>.
                            </label>
                        </div>
                        <p style="margin: 20px 0">Already have an EcoResorce account? <a href="login.php">Log in</a> </p>

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
        function redirectToLogin() {
            window.location.href = 'login.php'; // Replace 'login.php' with the actual login page URL
        }
    </script>
</body>
</html>