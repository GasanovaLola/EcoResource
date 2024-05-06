<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
    }

    $isUserLoggedIn = isset($_SESSION["user"]) && is_array($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/main.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="container">
                <div class="top-header">
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
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width: 100%; justify-content: center;">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="about_us.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        About Us
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="about_us.php">Our partners</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="sustainability.php">Sustainability</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="support.php">Support</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="membership.php">Membership</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <div class="container ultra-container">
            <div class="hero" style="margin-top: 50px;">
                <div class="row row-medium" style="justify-content: space-between">
                    <?php
                        // Get the user ID from the session
                        $user_id = $_SESSION["user"]["id"];  // Change "id" to the actual field in your user session

                        require_once "database.php";
                        // Prepare a SQL query to fetch subscription status for the user
                        $sql = "SELECT status FROM subscription WHERE user_id = '$user_id'";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            if ($row) {
                                $status = $row['status'];
                            }
                        }

                        if ($status !== 'successfully') {
                            echo '<div class="column width-1-1-lg width-1-1-md width-1-1-sm" style="display: block;">';
                            echo '<div class="block-border subscription-bg shadow" style="width: 100%;">';
                            echo '<p style="line-height: normal; font-weight: 600;">Pay the £99.9 subscription</p>';
                            echo '<p style="font-size: 18px; color: #0B1C3F;">to participate in the green competition </p>';
                            echo '<button type="button" class="btn btn-primary" onclick="redirectToSubscription()" style="width: auto; padding: 6px 45px; width: 230px; white-space: nowrap;">Subscribe</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                        else {
                            echo '<div class="column width-1-1-lg width-1-1-md width-1-1-sm" style="display: block;">';
                                $user_id = $_SESSION["user"]["id"];
                                require_once "database.php";

                                $sql = "SELECT date_of_reporting, count_of_green_points FROM recycling_data_history WHERE id_user = ?";
                                $stmt = mysqli_prepare($conn, $sql);

                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $date_of_reporting, $count_of_green_points);

                                    if (mysqli_stmt_fetch($stmt)) {
                                        echo '<div class="block-border certificate-bg shadow" style="width: 100%;">';
                                        echo '<p style="line-height: normal; font-weight: 600;">Congratulations!</p>';
                                        echo '<p style="font-size: 18px; color: #0B1C3F;">You can now download a certificate for your participation in our programme</p>';
                                        echo '<button type="button" class="btn btn-primary" onclick="redirectToReceiveCertificate()" style="width: auto; padding: 6px 45px; width: 230px; white-space: nowrap;">Receive a certificate</button>';
                                        echo '</div>';

                                        echo '<div class="block-border form-bg shadow" style="width: 100%; margin-top: 25px;">';
                                        echo '<p>You have successfully completed the form</p>';
                                        echo '<p style="font-size: 18px; color: #0B1C3F;">if you wish to resubmit the form click on the button below</p>';
                                        echo '<button type="button" class="btn btn-primary" onclick="redirectToGreenForm()" style="width: auto; padding: 6px 45px; width: 230px;">Update the form</button>';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="block-border form-bg shadow" style="width: 100%;">';
                                        echo '<p>Complete a green reporting form.</p>';
                                        echo '<button type="button" class="btn btn-primary" onclick="redirectToGreenForm()" style="width: auto; padding: 6px 45px">Complete the form</button>';
                                        echo '</div>';
                                    }
                                    // Закрыть подготовленный запрос
                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "Error: " . mysqli_error($conn);
                                }
                            echo '</div>';
                        }
                    ?>

                    <?php if ($status === 'successfully') : ?>
                    <div class="column width-1-2-lg width-1-2-md width-1-1-sm">
                        <div class="">
                            <div class="block-border shadow green-points-bg" style="width: 100%;">

                                <p style="color: #fff; font-weight: 600; line-height: normal;">The number of your green points and vouchers:</p>

                                <?php
                                    $user_id = $_SESSION["user"]["id"];

                                    require_once "database.php";

                                    // SQL query to select date of reporting and count of green points for a user
                                    $sql = "SELECT count_of_green_points FROM recycling_data_history WHERE id_user = ?";

                                    // Prepare the SQL statement
                                    $stmt = mysqli_prepare($conn, $sql);

                                    echo "<div style='display: flex; border-top: 1px solid #80FF00; padding: 15px 0;'>";

                                    // Check if statement is prepared successfully
                                    if ($stmt) {
                                        // Get user id from session
                                        $user_id = $_SESSION["user"]["id"];

                                        // Bind parameters
                                        mysqli_stmt_bind_param($stmt, "i", $user_id);

                                        // Execute the statement
                                        mysqli_stmt_execute($stmt);

                                        // Bind result variables
                                        mysqli_stmt_bind_result($stmt, $count_of_green_points);

                                        // Check if there are rows returned
                                        if (mysqli_stmt_fetch($stmt)) {
                                            while (mysqli_stmt_fetch($stmt)) {}
                                            echo "<p style='font-size: 38px; font-weight: 600; color: #80FF00;'>$count_of_green_points pts +  </p>";
                                        } else {
                                            // If no rows returned, display message
                                            echo "<p style='font-size: 38px; font-weight: 600; color: #80FF00;'>0 pts +  </p>";
                                        }
                                        // Close the statement
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        // If statement preparation failed, display error
                                        echo "Error: " . mysqli_error($conn);
                                    }
                                ?>
                                <?php
                                    require_once "database.php";

                                    $sql = "SELECT count_of_green_points FROM payment_history WHERE user_id = ?";
                                    $stmt = mysqli_prepare($conn, $sql);

                                    if ($stmt) {
                                        $user_id = $_SESSION["user"]["id"];
                                        mysqli_stmt_bind_param($stmt, "i", $user_id);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_store_result($stmt); // Store the result set

                                        if (mysqli_stmt_num_rows($stmt) > 0) {
                                            mysqli_stmt_bind_result($stmt, $count_of_green_points);

                                            // Check if there are rows returned
                                            if (mysqli_stmt_fetch($stmt)) {
                                                // Loop through the results and display each row
                                                while (mysqli_stmt_fetch($stmt)) {
                                                }
                                                echo "<p style='font-size: 38px; font-weight: 600; color: #80FF00;'>$count_of_green_points Vouchers</p>";
                                            } else {
                                                // If no rows returned, display message
                                                echo "<p style='font-size: 38px; font-weight: 600; color: #80FF00;'>0 Vouchers</p>";
                                            }
                                            // Close the statement
                                            mysqli_stmt_close($stmt);
                                        }
                                    } else {
                                        // If statement preparation failed, display error
                                        echo "Error: " . mysqli_error($conn);
                                    }
                                echo "</div>";
                                ?>
                                <p style="font-size: 18px; color: #fff;"> go to the <a href="green_point_shop.php">green points shop</a>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="column width-1-2-lg width-1-2-md width-1-1-sm">
                        <div class="block-border shadow voucher-bg" style="width: 100%">
                            <p style="line-height: normal; font-weight: 600; transform: scale(-1, 1);">Voucher/donation amount:</p>
                            <p style="font-size: 18px; color: #0B1C3F; transform: scale(-1, 1);">(1 voucher = £10)</p>
                            <?php
                            // Get user id from session
                            $user_id = $_SESSION["user"]["id"];

                            // Include database connection file
                            require_once "database.php";

                            // SQL query to select count of green points for a user
                            $sql = "SELECT count_of_green_points FROM green_points WHERE user_id = '$user_id'";

                            // Execute the SQL query
                            $result = mysqli_query($conn, $sql);

                            // Check if query was successful
                            if ($result) {
                                // Fetch row from the result
                                $row = mysqli_fetch_assoc($result);

                                // Check if row is not empty
                                if ($row) {
                                    $count_of_green_points = $row['count_of_green_points'];
                                    // Calculate voucher amount
                                    $voucher = ((100 - $count_of_green_points) * 10);

                                    // Check if voucher amount is not zero
                                    if (true) {
                                        // Display buy button and voucher amount
                                        echo '<div style="display: flex; justify-content: space-between; align-items: center">';
                                        echo '<button type="button" class="btn btn-primary" onclick="redirectToShop()" style="margin: 0 2px; transform: scale(-1, 1);">BUY</button>';
                                        echo '</div>';
                                    } else {
                                        // If voucher amount is zero, display message
                                        echo '<p style="font-size: 16px; color: #DC3545; font-weight: 600; transform: scale(-1, 1);">You don\'t need any donations, you have the most green points.</p>';
                                    }
                                } else {
                                    // If no rows returned, do nothing
                                }
                            } else {
                                // If query failed, do nothing
                            }
                            ?>

                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="main" style="margin: 25px 0">
                <div class="block-border shadow">
                    <div class="block-private-account">
                        <h2>User information:</h2>

                        <div class="row row-medium" style="align-items: flex-end;">
                            <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="display: block;">
                                <?php
                                // Check if the form is submitted via POST method and if the submit button is set
                                if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit1"])) {

                                    // Get user id from session
                                    $user_id = $_SESSION["user"]["id"];

                                    // Get full name and email from POST data
                                    $full_name = $_POST["full_name"];
                                    $email = $_POST["email"];

                                    // Array to store error messages
                                    $errors = array();

                                    // Validate full name and email fields
                                    if (empty($full_name) OR empty($email)) {
                                        array_push($errors, "All fields are required");
                                    }
                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        array_push($errors, "Email is not valid");
                                    }

                                    // Include database connection file
                                    require_once "database.php";

                                    // If there are errors, display them
                                    if (count($errors) > 0) {
                                        foreach ($errors as $error) {
                                            echo "<div class='alert alert-danger'> $error </div>";
                                        }
                                    } else {
                                        // If no errors, proceed to update user details
                                        $sql_select = "SELECT * FROM users WHERE id = ?";
                                        $stmt_select = mysqli_stmt_init($conn);
                                        mysqli_stmt_prepare($stmt_select, $sql_select);
                                        mysqli_stmt_bind_param($stmt_select, "s", $user_id);
                                        mysqli_stmt_execute($stmt_select);
                                        $result_select = mysqli_stmt_get_result($stmt_select);

                                        // Check if user exists
                                        if(mysqli_num_rows($result_select) > 0) {
                                            // If user exists, update their details
                                            $sql_update = "UPDATE users SET full_name=?, email=? WHERE id=?";
                                            if ($stmt_update = mysqli_prepare($conn, $sql_update)) {
                                                mysqli_stmt_bind_param($stmt_update, "sss", $full_name, $email, $user_id);
                                                mysqli_stmt_execute($stmt_update);
                                                echo "<div class='alert alert-success'>You have successfully updated your user details.</div>";
                                            } else {
                                                // If failed to prepare update statement, display error
                                                echo "<div class='alert alert-danger'>Failed to prepare update statement: " . mysqli_error($conn) . "</div>";
                                            }
                                        }
                                    }
                                }
                                ?>

                                <form style="width: 100%" action="" method="post">
                                    <div class="form-group">
                                        <label for="full_name" class="text">Full Name</label>
                                        <?php
                                        // Get user id from session
                                        $user_id = $_SESSION["user"]["id"];

                                        // Include database connection file
                                        require_once "database.php";

                                        // Query to select user's full name
                                        $sql = "SELECT full_name FROM users WHERE id = '$user_id'";
                                        $result = mysqli_query($conn, $sql);

                                        // Check if query was successful
                                        if ($result) {
                                            // Fetch row from the result
                                            $row = mysqli_fetch_assoc($result);
                                            // Check if row is not empty
                                            if ($row) {
                                                $full_name = $row['full_name'];
                                                // Check if full name is not empty
                                                if ($full_name) {
                                                    // If full name exists, display input field with the value
                                                    echo '<input name="full_name" type="text" class="form-control" id="full_name" aria-describedby="fullName" placeholder="Enter user name .." value="' . htmlspecialchars($full_name) .' " style="margin: 5px 0;">';
                                                } else {
                                                    // If full name doesn't exist, display input field without value
                                                    echo '<input name="full_name" type="text" class="form-control" id="full_name" aria-describedby="fullName" placeholder="Enter user name .." style="margin: 5px 0;">';
                                                }
                                            }
                                        }
                                        ?>

                                        <small id="full_name" class="form-text text-muted" style="font-size: 14px;">The full first and last name must be written, as this entry will be on the certificate.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="text">Email address</label>
                                        <?php
                                        $user_id = $_SESSION["user"]["id"];

                                        require_once "database.php";
                                        $sql = "SELECT email FROM users WHERE id = '$user_id'";
                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            if ($row) {
                                                $email = $row['email'];
                                                if ($email) {
                                                    echo '<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email.." value="' . htmlspecialchars($email) .' " style="margin: 5px 0;">';
                                                } else {
                                                    echo '<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email.." style="margin: 5px 0;">';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <button name="submit1" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">UPDATE</button>
                                </form>
                            </div>
                            <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="display: block;">
                                <?php
                                if(isset($_POST["submit"])) {
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

                                    require_once "database.php";
                                    if (count($errors) > 0) {
                                        foreach ($errors as $error) {
                                            echo "<div class='alert alert-danger'> $error </div>";
                                        }
                                    } else {
                                        // Если данные уже существуют, обновляем их
                                        $sql_update = "UPDATE users SET password=? WHERE id=?";
                                        if ($stmt_update = mysqli_prepare($conn, $sql_update)) {
                                            mysqli_stmt_bind_param($stmt_update, "ss", $passwordHash, $user_id);
                                            mysqli_stmt_execute($stmt_update);
                                            echo "<div class='alert alert-success'>You have successfully updated your password.</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Failed to prepare update passport: " . mysqli_error($conn) . "</div>";
                                        }
                                    }
                                }
                                ?>
                                <form style="width: 100%" action="" method="post">
                                    <!--<h2 class="title" style="text-align: left; font-size: 34px; color: #0B1C3F">Password recovery:</h2>-->
                                    <div class="form-group">
                                        <label for="password" class="text">Password</label>
                                        <input name="password" type="password" class="form-control" id="password" placeholder="Password" style="margin: 5px 0;">
                                        <small id="passwordHelp" class="form-text text-muted" style="font-size: 14px;">Must be 8 or more characters and contain at least 1 number and 1 special character.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="repeat_password" class="text">Confirm password</label>
                                        <input name="repeat_password" type="password" class="form-control" id="repeat_password" placeholder="Confirm password .." style="margin: 5px 0;">
                                    </div>
                                    <button name="submit" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">UPDATE</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="block-private-account">
                        <h2>Company information:</h2>
                        <?php
                            if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit2"])) {
                                $user_id = $_SESSION["user"]["id"];
                                $join_date = date("Y-m-d H:i:s");

                                $telephone_number = $_POST["telephone_number"];
                                $company_name = $_POST["company_name"];

                                $errors = array();

                                if (empty($telephone_number) OR empty($company_name)) {
                                    array_push($errors, "All fields are required");
                                }
                                if (strlen($telephone_number) < 10) {
                                    array_push($errors, "Telephone number must be at least 10 characters long");
                                }

                                require_once "database.php";

                                if (count($errors) > 0) {
                                    foreach ($errors as $error) {
                                        echo "<div class='alert alert-danger'> $error </div>";
                                    }
                                } else {
                                    $sql_select = "SELECT * FROM companies WHERE user_id = ?";
                                    $stmt_select = mysqli_stmt_init($conn);
                                    mysqli_stmt_prepare($stmt_select, $sql_select);
                                    mysqli_stmt_bind_param($stmt_select, "s", $user_id);
                                    mysqli_stmt_execute($stmt_select);
                                    $result_select = mysqli_stmt_get_result($stmt_select);

                                    if(mysqli_num_rows($result_select) > 0) {
                                        // Если данные уже существуют, обновляем их
                                        $sql_update = "UPDATE companies SET join_date=?, telephone_number=?, company_name=? WHERE user_id=?";
                                        $stmt_update = mysqli_stmt_init($conn);
                                        mysqli_stmt_prepare($stmt_update, $sql_update);
                                        mysqli_stmt_bind_param($stmt_update, "ssss", $join_date, $telephone_number, $company_name, $user_id);
                                        mysqli_stmt_execute($stmt_update);
                                        echo "<div class='alert alert-success'>You have successfully updated your company details.</div>";
                                    } else {
                                        // Если данных нет, вставляем новую запись
                                        $sql_insert = "INSERT INTO companies (user_id, join_date, telephone_number, company_name) VALUES (?,?,?,?)";
                                        $stmt_insert = mysqli_stmt_init($conn);
                                        mysqli_stmt_prepare($stmt_insert, $sql_insert);
                                        mysqli_stmt_bind_param($stmt_insert, "ssss", $user_id, $join_date, $telephone_number, $company_name);
                                        mysqli_stmt_execute($stmt_insert);
                                        echo "<div class='alert alert-success'>You have successfully added your company details.</div>";
                                    }
                                }
                            }
                        ?>
                        <form style="width: 100%" action="" method="post">
                            <div class="form-group">
                                <label for="company_name" class="text">Company Name</label>
                                <?php
                                    $user_id = $_SESSION["user"]["id"];

                                    require_once "database.php";
                                    $sql = "SELECT company_name FROM companies WHERE user_id = '$user_id'";

                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);

                                        if ($row) {
                                            $company_name = $row['company_name'];

                                            echo '<input name="company_name" type="text" class="form-control" id="company_name" aria-describedby="company_name" value="' . htmlspecialchars($company_name) .' " style="margin: 5px 0;">';

                                        } else {
                                            echo '<input name="company_name" type="text" class="form-control" id="company_name" aria-describedby="company_name" placeholder=" Enter company name.." style="margin: 5px 0;">';
                                        }
                                    } else {
                                        // echo "Ошибка выполнения запроса: " . mysqli_error($conn);
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="telephone_number" class="text">Telephone Number</label>
                                <?php
                                    $user_id = $_SESSION["user"]["id"];

                                    require_once "database.php";
                                    $sql = "SELECT telephone_number FROM companies WHERE user_id = '$user_id'";

                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);

                                        if ($row) {
                                            $telephone_number = $row['telephone_number'];

                                            echo '<input name="telephone_number" type="text" class="form-control" id="telephone_number" aria-describedby="telephone_number" placeholder="Enter telephone number" value="' . htmlspecialchars($telephone_number) .'" style="margin: 5px 0;">';
                                        } else {
                                            echo '<input name="telephone_number" type="text" class="form-control" id="telephone_number" aria-describedby="telephone_number" placeholder="Enter telephone number" style="margin: 5px 0;">';
                                        }
                                    }
                                ?>
                            </div>
                            <button name="submit2" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">UPDATE</button>
                        </form>
                    </div>

                    <div class="block-private-account" style="border-color: transparent">
                        <h2>Credit card details:</h2>
                        <?php
                            if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit3"])) {
                                $user_id = $_SESSION["user"]["id"];

                                $credit_card_number = $_POST["credit_card_number"];
                                $cvv = $_POST["cvv"];
                                $expiry_date = $_POST["expiry_date"];

                                $errors = array();

                                if (strlen($credit_card_number) < 16) {
                                    array_push($errors, "Credit card number must be at least 16 characters long");
                                }
                                if (strlen($cvv) !== 3) {
                                    array_push($errors, "CVV number must be 3 characters long");
                                }

                                require_once "database.php";

                                if (count($errors) > 0) {
                                    foreach ($errors as $error) {
                                        echo "<div class='alert alert-danger'> $error </div>";
                                    }
                                } else {
                                    $sql_select = "SELECT * FROM credit_card WHERE user_id = ?";
                                    $stmt_select = mysqli_stmt_init($conn);
                                    mysqli_stmt_prepare($stmt_select, $sql_select);
                                    mysqli_stmt_bind_param($stmt_select, "s", $user_id);
                                    mysqli_stmt_execute($stmt_select);
                                    $result_select = mysqli_stmt_get_result($stmt_select);

                                    if(mysqli_num_rows($result_select) > 0) {
                                        $sql_update = "UPDATE credit_card SET credit_card_number=?, cvv=?, expiry_date=? WHERE user_id=?";
                                        $stmt_update = mysqli_stmt_init($conn);
                                        mysqli_stmt_prepare($stmt_update, $sql_update);
                                        mysqli_stmt_bind_param($stmt_update, "ssss", $credit_card_number, $cvv, $expiry_date, $user_id);
                                        mysqli_stmt_execute($stmt_update);
                                        echo "<div class='alert alert-success'>You have successfully updated your credit card details.</div>";
                                    } else {
                                        $sql_insert = "INSERT INTO credit_card (user_id, credit_card_number, cvv, expiry_date) VALUES (?,?,?,?)";
                                        $stmt_insert = mysqli_stmt_init($conn);
                                        mysqli_stmt_prepare($stmt_insert, $sql_insert);
                                        mysqli_stmt_bind_param($stmt_insert, "ssss", $user_id, $credit_card_number, $cvv, $expiry_date);
                                        mysqli_stmt_execute($stmt_insert);
                                        echo "<div class='alert alert-success'>You have successfully added your credit card details.</div>";
                                    }
                                }
                            }
                        ?>

                        <?php
                            // Handle form submission for deleting card details
                            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit4"])) {
                                // Delete the card details associated with the user
                                $user_id = $_SESSION["user"]["id"];
                                require_once "database.php";
                                $sql_delete = "DELETE FROM credit_card WHERE user_id = ?";
                                $stmt_delete = mysqli_stmt_init($conn);
                                if (mysqli_stmt_prepare($stmt_delete, $sql_delete)) {
                                    mysqli_stmt_bind_param($stmt_delete, "s", $user_id);
                                    mysqli_stmt_execute($stmt_delete);

                                    echo "<div class='alert alert-success'>You have successfully deleted your credit card details.</div>";
                                }
                            }
                        ?>
                        <form style="width: 100%" action="" method="post">
                            <div class="form-group">
                                <label for="credit_card_number" class="text">Credit card number</label>
                                <?php
                                // Get user id from session
                                $user_id = $_SESSION["user"]["id"];

                                // Include database connection file
                                require_once "database.php";

                                // SQL query to select credit card number for a user
                                $sql = "SELECT credit_card_number FROM credit_card WHERE user_id = '$user_id'";

                                // Execute the SQL query
                                $result = mysqli_query($conn, $sql);

                                // Check if query was successful
                                if ($result) {
                                    // Fetch row from the result
                                    $row = mysqli_fetch_assoc($result);

                                    // Check if row is not empty
                                    if ($row) {
                                        $credit_card_number = $row['credit_card_number'];

                                        // Display input field with credit card number
                                        echo '<input name="credit_card_number" type="text" class="form-control" id="credit_card_number" aria-describedby="credit_card_number" placeholder="Enter credit card number.." value="' . htmlspecialchars($credit_card_number) .'" style="margin: 5px 0;">';
                                    } else {
                                        // If no credit card number found, display empty input field
                                        echo '<input name="credit_card_number" type="text" class="form-control" id="credit_card_number" aria-describedby="credit_card_number" placeholder="Enter credit card number.." style="margin: 5px 0;">';
                                    }
                                }
                                ?>
                            </div>
                            <div class="row row-medium">
                                <div class="column width-1-2-lg width-1-2-md width-1-1-sm form-group">
                                    <div class="" style="width: 100%">
                                        <label for="cvv" class="text">CVV</label>
                                        <?php
                                            $user_id = $_SESSION["user"]["id"];

                                            require_once "database.php";
                                            $sql = "SELECT cvv FROM credit_card WHERE user_id = '$user_id'";

                                            $result = mysqli_query($conn, $sql);

                                            if ($result) {
                                                $row = mysqli_fetch_assoc($result);

                                                if ($row) {
                                                    $cvv = $row['cvv'];

                                                    echo '<input name="cvv" type="text" class="form-control" id="cvv" aria-describedby="cvv" placeholder="Enter cvv .." value="' . htmlspecialchars($cvv) .'" style="margin: 5px 0; width: 100%;">';
                                                } else {
                                                    echo '<input name="cvv" type="text" class="form-control" id="cvv" aria-describedby="cvv" placeholder="Enter cvv .." style="margin: 5px 0; width: 100%;">';
                                                }
                                            } else {
                                                // echo "Ошибка выполнения запроса: " . mysqli_error($conn);
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group column width-1-2-lg width-1-2-md width-1-1-sm">
                                    <div class="" style="width: 100%">
                                        <label for="expiry_date" class="text">Expiry Date</label>
                                        <?php
                                        $user_id = $_SESSION["user"]["id"];

                                        require_once "database.php";
                                        $sql = "SELECT expiry_date FROM credit_card WHERE user_id = '$user_id'";

                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);

                                            if ($row) {
                                                $expiry_date = $row['expiry_date'];

                                                echo '<input name="expiry_date" type="date" class="form-control" id="expiry_date" aria-describedby="expiry_date" placeholder="Enter expiry date .." value="' . htmlspecialchars($expiry_date) .'" style="margin: 5px 0; width: 100%;">';
                                            } else {
                                                echo '<input name="expiry_date" type="date" class="form-control" id="expiry_date" aria-describedby="expiry_date" placeholder="Enter expiry date .." style="margin: 5px 0; width: 100%;">';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <button name="submit3" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">UPDATE</button>
                            <button name="submit4" type="submit" class="btn btn-danger" style="width: 100%;">DELETE CARD DETAILS</button>
                        </form>
                    </div>

                </div>

                <div class="block-border shadow" style="margin: 25px 0;">
                    <h2 style="margin-bottom: 35px;">Recycling data history:</h2>

                    <?php
                    // Include database connection file
                    require_once "database.php";

                    // SQL query to select date of reporting and count of green points for a user
                    $sql = "SELECT date_of_reporting, count_of_green_points FROM recycling_data_history WHERE id_user = ?";

                    // Prepare the SQL statement
                    $stmt = mysqli_prepare($conn, $sql);

                    // Check if statement is prepared successfully
                    if ($stmt) {
                        // Get user id from session
                        $user_id = $_SESSION["user"]["id"];

                        // Bind parameters
                        mysqli_stmt_bind_param($stmt, "i", $user_id);

                        // Execute the statement
                        mysqli_stmt_execute($stmt);

                        // Bind result variables
                        mysqli_stmt_store_result($stmt);

                        // Check if there are rows returned
                        if (mysqli_stmt_num_rows($stmt) > 0) {
                            mysqli_stmt_bind_result($stmt, $date_of_reporting, $count_of_green_points);
                            // Display column headers
                            echo "<div style='display: flex;'>";
                            echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>Date of Reporting</p>";
                            echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>Amount of Green Points</p>";
                            echo "</div>";

                            // Loop through the results and display each row
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<div style='display: flex; border-top: 1px solid #80FF00; padding: 15px 0;'>";
                                echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>$date_of_reporting</p>";
                                echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>$count_of_green_points pts</p>";
                                echo "</div>";
                            }
                        } else {
                            // If no rows returned, display message
                            echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>You've never filed an accounting yet.</p>";
                        }

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    } else {
                        // If statement preparation failed, display error
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>

                </div>
                <div class="block-border shadow" style="margin: 25px 0;">
                    <h2 style="margin-bottom: 35px;">Payment history:</h2>
                    <?php
                    require_once "database.php";

                    $sql = "SELECT payment_method, date_time, status, count_of_green_points FROM payment_history WHERE user_id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    if ($stmt) {
                        $user_id = $_SESSION["user"]["id"];
                        mysqli_stmt_bind_param($stmt, "i", $user_id);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt); // Store the result set

                        if (mysqli_stmt_num_rows($stmt) > 0) {
                            mysqli_stmt_bind_result($stmt, $payment_method, $date_time, $status, $count_of_green_points);

                            echo "<div style='display: flex;'>";
                            echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>Date of Reporting</p>";
                            echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>Payment method</p>";
                            echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>Status</p>";
                            echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>Amount of Green Points</p>";
                            echo "</div>";

                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<div style='display: flex; border-top: 1px solid #80FF00; padding: 15px 0;'>";
                                echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>$date_time</p>";
                                echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>$payment_method</p>";
                                echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>$status</p>";
                                echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>$count_of_green_points pts</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='text' style='width: 300px; white-space: nowrap; font-size: 17px'>You haven't made any purchases yet.</p>";
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>


        <footer>
            <div class="container">
                <div class="row row-medium top-block" style="justify-content: space-between;">
                    <div class="column width-1-4-lg width-1-3-md width-1-2-sm" style="padding: 20px 12px;">
                        <div class="block-item">
                            <a href="about_us.php"><h6 class="block-item-title">About Us</h6></a>
                            <a href="about_us.php"><p>Our goals</p></a>
                            <a href="about_us.php"><p>Our Partners</p></a>
                        </div>
                    </div>
                    <div class="column width-1-4-lg width-1-3-md width-1-2-sm" style="padding: 20px 12px;">
                        <div class="block-item">
                            <a href="sustainability.php"><h6 class="block-item-title">Sustainability</h6></a>
                            <a href="sustainability.php"><p>Our Key Initiatives</p></a>
                            <a href="sustainability.php"><p>Our Impact</p></a>
                        </div>
                    </div>
                    <div class="column width-1-4-lg width-1-3-md width-1-2-sm" style="padding: 20px 12px;">
                        <div class="block-item">
                            <a href="support.php"><h6 class="block-item-title">Support</h6></a>
                            <a href="support.php"><p>Help Center</p></a>
                        </div>
                    </div>
                    <div class="column width-1-4-lg width-1-3-md width-1-2-sm" style="padding: 20px 12px;">
                        <div class="block-item">
                            <a href="membership.php"><h6 class="block-item-title">Membership</h6></a>
                            <a href="membership.php"><p>How to Become a Member</p></a>
                            <a href="membership.php"><p>Membership Benefits</p></a>
                        </div>
                    </div>
                    <div class="column width-2-3-lg width-2-3-md width-1-1-sm" style="padding: 20px 12px;">
                        <div class="block-item">
                            <a href="contact.php"><h6 class="block-item-title">Contact</h6></a>
                            <p style="white-space: nowrap;">Email: <a href="mailto:info@sustainabilityenergy.com">info@sustainabilityenergy.com</a></p>
                            <p style="white-space: nowrap;">Phone: <a href="tel:+11234567890">+1 (123) 456-7890</a></p>
                            <a style="white-space: nowrap;" href="contact.php"><p>Address: 123 Green Way, EcoCity, Earth</p></a>
                        </div>
                    </div>
                    <div class="column width-1-4-lg width-1-3-md width-1-1-sm" style="padding: 20px 12px;">
                        <div class="block-item">
                            <div class="social-media">
                                <i class="fa-brands fa-instagram"></i>
                                <i class="fa-brands fa-linkedin-in"></i>
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                            <button type="button" class="btn btn-outline-primary shadow" style="width: 100%;">Join Us</button>
                        </div>
                    </div>
                </div>
                <p class="copyright">Edinburgh College <br><a href="copyright.php">© 2024 EcoResource (UK)</a></p>
            </div>
        </footer>
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

        function redirectToGreenForm() {
            window.location.href = 'recycling_data_form.php';
        }

        function redirectToReceiveCertificate() {
            window.location.href = 'get_certificate.php';
        }

        function redirectToShop() {
            window.location.href = 'green_point_shop.php';
        }

        function redirectToSubscription() {
            window.location.href = 'subscription.php';
        }
    </script>
</body>
</html>