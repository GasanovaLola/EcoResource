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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick/slick-theme.css"/>

    <link rel="stylesheet" href="./style/main.css">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <div class="top-header">
                <a href="#">
                    <div class="logo" style="display: flex;">
                        <img src="./images/plant-care_12779251.png" style="width: 50px;" alt="">
                        <p>EcoResource</p>
                    </div>
                </a>
                <div class="authentication">
                    <?php if ($isUserLoggedIn && isset($_SESSION["user"]["full_name"])) : ?>
                        <button type="button" class="btn btn-outline-primary shadow" onclick="redirectToLogout()" style="margin: 0 2px">Log Out</button>
                        <button type="button" class="btn btn-primary shadow" onclick="redirectToAdminAccount()" style="margin: 0 2px"><?php echo "Account: " . $_SESSION["user"]["full_name"]; ?></button>
                    <?php endif; ?>

                </div>
            </div><nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
    </header>
    <div class="container main">
        <div class="row row-medium">
            <div class="column width-2-3-lg width-2-3-md width-1-1-sm" style="display: block">
                <h2 style="margin: 50px 0;">Administrator panel</h2>

                <form action="" method="post" onsubmit="handleSubmit()" style="width: 100%">
                    <h5>Change user data</h5>
                    <p style="width: 100%; margin-bottom: 10px; font-size: 18px;">Search and manage user accounts. To search, enter either the user's full name or their email:</p>
                    <div class="row row-medium" style="align-items: center; width: 100%">
                        <div class="column width-2-3-lg width-2-3-md width-1-1-sm" style="padding-right: 2.5px">
                            <input name="search" type="text" class="form-control" id="search" aria-describedby="search" placeholder="Enter either the user's full name or their email.." value="<?php if(isset($_POST['search'])) { echo $_POST['search']; } ?>" style="margin: 5px 0; width: 100%;">
                        </div>
                        <div class="column width-1-3-lg width-1-3-md width-1-1-sm" style="padding-left: 2.5px">
                            <button name="submit" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">OK</button>
                        </div>
                    </div>
                </form>

                <div class="block-extra" style="width: 100%">
                    <?php
                    // Check if the form is submitted via POST method and if the submit button is set
                    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit1"])) {
                        // Get user id from session
                        if(isset($_POST['search'])) {
                            $searchTerm = $_POST['search'];
                        } else {
                            $searchTerm = '';
                        }

                        // Include database connection file
                        require_once "database.php";

                        // Query to select user's full name
                        $sql = "SELECT id, full_name FROM users WHERE full_name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
                        $result = mysqli_query($conn, $sql);

                        // Check if query was successful
                        if ($result) {
                            // Fetch row from the result
                            $row = mysqli_fetch_assoc($result);
                            // Check if row is not empty
                            if ($row) {
                                $user_id = $row['id'];
                            }
                        }

                        // Get full name and email from POST data
                        $full_name = $_POST["full_name"];
                        $email = $_POST["email"];
                        $status = $_POST["status"];

                        // Array to store error messages
                        $errors = array();

                        // Validate full name and email fields
                        if (empty($full_name) OR empty($email) OR empty($status)) {
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
                                $sql_update = "UPDATE users SET full_name=?, email=?, status=? WHERE id=?";
                                if ($stmt_update = mysqli_prepare($conn, $sql_update)) {
                                    mysqli_stmt_bind_param($stmt_update, "ssss", $full_name, $email, $status, $user_id);
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
                            if(isset($_POST['search']) && !empty($_POST['search'])) {
                                // Get user id from session
                                $searchTerm = $_POST['search'];
                                // Include database connection file
                                require_once "database.php";

                                // Query to select user's full name
                                $sql = "SELECT id, full_name FROM users WHERE full_name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
                                $result = mysqli_query($conn, $sql);

                                // Check if query was successful
                                if ($result) {
                                    // Fetch row from the result
                                    $row = mysqli_fetch_assoc($result);
                                    // Check if row is not empty
                                    if ($row) {
                                        $user_id = $row['id'];
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
                            } else {
                                echo '<input name="full_name" type="text" class="form-control" id="full_name" aria-describedby="fullName" placeholder="Enter user name .." style="margin: 5px 0;">';
                            }
                            ?>

                            <small id="full_name" class="form-text text-muted" style="font-size: 14px;">The full first and last name must be written, as this entry will be on the certificate.</small>
                        </div>
                        <div class="form-group">
                                <label for="email" class="text">Email address</label>
                                <?php
                                if(isset($_POST['search']) && !empty($_POST['search'])) {
                                    // Get user id from session
                                    $searchTerm = $_POST['search'];

                                    require_once "database.php";
                                    $sql = "SELECT email FROM users WHERE full_name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
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
                                } else {
                                    echo '<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email.." style="margin: 5px 0;">';
                                }
                                ?>
                        </div>
                        <div class="form-group">
                                <label for="status" class="text">Status</label>
                                <select name="status" class="form-control" id="status" style="border-color: #0B1C3F">
                                    <?php
                                    if(isset($_POST['search']) && !empty($_POST['search'])) {
                                        // Get user id from session
                                        $searchTerm = $_POST['search'];

                                        require_once "database.php";
                                        $sql = "SELECT status FROM users WHERE full_name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            if ($row) {
                                                $status = $row['status'];
                                                $options = ["active", "inactive", "blocked"]; // Available options for status
                                                foreach ($options as $option) {
                                                    if ($status === $option) {
                                                        echo '<option selected>' . $option . '</option>';
                                                    } else {
                                                        echo '<option>' . $option . '</option>';
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        echo '<option value="" selected disabled>Select status</option>';
                                        $options = ["active", "inactive", "blocked"]; // Available options for status
                                        foreach ($options as $option) {
                                            echo '<option>' . $option . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                                <?php

                                if(isset($_POST['search']) && !empty($_POST['search'])) {
                                    // Get user id from session
                                    $searchTerm = $_POST['search'];

                                    require_once "database.php";
                                    // SQL query to select date of reporting and count of green points for a user
                                    $sql = "SELECT count_of_green_points FROM recycling_data_history WHERE id_user = ?";

                                    // Prepare the SQL statement
                                    $stmt = mysqli_prepare($conn, $sql);

                                    // Check if statement is prepared successfully
                                    if ($stmt) {
                                        // Bind parameters
                                        mysqli_stmt_bind_param($stmt, "i", $user_id);

                                        // Execute the statement
                                        mysqli_stmt_execute($stmt);

                                        // Bind result variables
                                        mysqli_stmt_bind_result($stmt, $count_of_green_points);

                                        // Check if there are rows returned
                                        if (mysqli_stmt_fetch($stmt)) {
                                            while (mysqli_stmt_fetch($stmt)) {
                                            }
                                            echo "<p style='font-size: 17px; font-weight: 500; color: #0B1C3F; margin-bottom: 0;'>Count of green points: $count_of_green_points pts</p>";
                                        } else {
                                            // If no rows returned, display message
                                            echo "<p style='font-size: 17px; font-weight: 500; color: #0B1C3F; margin-bottom: 0;'>Count of green points: 0 pts</p>";
                                        }
                                        // Close the statement
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        // If statement preparation failed, display error
                                        echo "Error: " . mysqli_error($conn);
                                    }
                                }
                                ?>

                                <?php

                                if(isset($_POST['search']) && !empty($_POST['search'])) {
                                    // Get user id from session
                                    $searchTerm = $_POST['search'];

                                    require_once "database.php";
                                    // SQL query to select date of reporting and count of green points for a user
                                    $sql = "SELECT count_of_green_points FROM payment_history WHERE user_id = ?";

                                    // Prepare the SQL statement
                                    $stmt = mysqli_prepare($conn, $sql);

                                    // Check if statement is prepared successfully
                                    if ($stmt) {
                                        // Bind parameters
                                        mysqli_stmt_bind_param($stmt, "i", $user_id);

                                        // Execute the statement
                                        mysqli_stmt_execute($stmt);

                                        // Bind result variables
                                        mysqli_stmt_bind_result($stmt, $count_of_green_points);

                                        // Check if there are rows returned
                                        if (mysqli_stmt_fetch($stmt)) {
                                            while (mysqli_stmt_fetch($stmt)) {
                                            }
                                            echo "<p style='font-size: 17px; font-weight: 500; color: #0B1C3F'>Count of vouchers: $count_of_green_points vouchers</p>";
                                        } else {
                                            // If no rows returned, display message
                                            echo "<p style='font-size: 17px; font-weight: 500; color: #0B1C3F'>Count of vouchers: 0 vouchers</p>";
                                        }
                                        // Close the statement
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        // If statement preparation failed, display error
                                        echo "Error: " . mysqli_error($conn);
                                    }
                                }
                                ?>
                        </div>
                        <button name="submit1" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">UPDATE</button>
                    </form>
                </div>
            </div>

            <h5 style="margin-top: 50px;">Add a new user to the system</h5>
            <p style="width: 100%; margin-bottom: 10px; font-size: 18px;">Search and manage user accounts. To search, enter either the user's full name or their email:</p>

            <div class="column width-2-3-lg width-2-3-md width-1-1-sm">
                <div class="block-extra" style="width: 100%">

                    <?php
                    if(isset($_POST["addnewuser"])) {
                        $fullName = $_POST["full_name"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $passwordRepeat = $_POST["repeat_password"];
                        $status = $_POST["status"];
                        $role = $_POST["role"];

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
                            $sql = "INSERT INTO users (full_name, email, password, status, role) VALUES (?,?,?,?,?)";

                            $stmt = mysqli_stmt_init($conn);
                            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                            if ($prepareStmt) {
                                mysqli_stmt_bind_param($stmt, "sssss", $fullName, $email, $passwordHash, $status, $role);
                                mysqli_stmt_execute($stmt);

                                // Get the user ID of the newly inserted user
                                $user_id = mysqli_insert_id($conn);

                                echo "<div class='alert alert-success'>You added user successfully.</div>";
                            } else {
                                die("Something went wrong");
                            }
                        }
                    }
                    ?>
                    <form style="width: 100%" action="" method="post">
                        <div class="form-group">
                            <label for="full_name" class="text">Full Name</label>
                            <input name="full_name" type="text" class="form-control" id="full_name" aria-describedby="fullName" placeholder="Enter user name .." style="margin: 5px 0;">

                            <small id="full_name" class="form-text text-muted" style="font-size: 14px;">The full first and last name must be written, as this entry will be on the certificate.</small>
                        </div>
                        <div class="form-group">
                            <label for="email" class="text">Email address</label>
                            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email.." style="margin: 5px 0;">
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

                        <div class="form-group">
                            <label for="role" class="text">Role</label>
                            <select name="role" class="form-control" id="role" style="border-color: #0B1C3F">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status" class="text">Status</label>
                            <select name="status" class="form-control" id="status" style="border-color: #0B1C3F">
                                <?php
                                    echo '<option name="status" value="" selected disabled>Select status</option>';
                                    $options = ["active", "inactive", "blocked"]; // Available options for status
                                    foreach ($options as $option) {
                                        echo '<option>' . $option . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <button name="addnewuser" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">ADD NEW USER</button>
                    </form>
                </div>
            </div>

            <div class="column width-2-3-lg width-2-3-md width-1-1-sm" style="display: block">
            <h5 style="margin-top: 50px;">User feedback management</h5>
            <p style="width: 100%; margin-bottom: 10px; font-size: 18px;">You can contact the users who left feedback via their contacts to resolve the issue or delete the feedback yourself:</p>

                    <?php
                    // Database connection
                    require_once "database.php"; // Убедитесь, что этот файл содержит код подключения к базе данных

                    // Check if delete button is clicked
                    if(isset($_POST['delete'])) {
                        $feedbackId = $_POST['feedback_id'];
                        // Perform deletion query
                        $deleteSql = "DELETE FROM feedback WHERE id = ?";
                        $stmt = $conn->prepare($deleteSql);
                        $stmt->bind_param("i", $feedbackId);
                        if($stmt->execute()) {
                            // Do nothing here
                        } else {
                            echo "Record deletion error: " . $conn->error;
                        }
                    }

                    // Fetch feedback data from database
                    $sql = "SELECT f.id, f.name, f.feedback, u.email FROM feedback f JOIN users u ON f.user_id = u.id";
                    $result = $conn->query($sql);

                    // Check if there are any feedbacks
                    if ($result->num_rows > 0) {
                        // Display feedbacks
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='block-extra' style='width: 100%; margin-bottom: 15px'>";
                            echo "<div class='feedbacks'>";
                            echo "<div class='' style=''>";
                            echo "<div style='display: flex; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #80FF00; padding-bottom: 15px'>";
                            echo "<i class='fa-solid fa-circle-user' style='font-size: 40px; color: #80FF00; margin-right: 15px;'></i>";
                            echo "<h5 class='' style='margin: 0'>" . htmlspecialchars($row['name']) . "</h5>";
                            echo "</div>";
                            echo "<p class='' style='font-size: 16px'>Email: <a href='email:".htmlspecialchars($row['email'])."'>" . htmlspecialchars($row['email']) . "</a></p>";
                            echo "<p class='card-text'>" . htmlspecialchars($row['feedback']) . "</p>";
                            echo "<form action='' method='post'>";
                            echo "<input type='hidden' name='feedback_id' value='" . $row['id'] . "'>";
                            echo "<button name='delete' class='btn btn-danger'>DELETE</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div style='width: 100%;'><p class='alert alert-info' style='width: 100%;'>There are no reviews.</p></div>";
                    }
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
                        <button type="button" class="btn btn-outline-primary shadow" style="width: 100%;"><a
                                    href="registration.php">Join Us</a>
                        </button>
                    </div>
                </div>
            </div>
            <p class="copyright">Edinburgh College <br><a href="copyright.php">© 2024 EcoResource (UK)</a></p>
        </div>
    </footer>
</div>
<script src="https://kit.fontawesome.com/813d54a682.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick-1.8.1/slick/slick.min.js"></script>

<script>
    function redirectToLogin() {
        window.location.href = 'login.php';
    }

    function redirectToLogout() {
        window.location.href = 'logout.php';
    }

    function redirectToAdminAccount() {
        window.location.href = 'admin_panel.php';
    }

    // Обработка удаления фидбека и обновление только этой части страницы
    function deleteFeedback(feedbackId) {
        $.ajax({
            type: 'POST',
            url: 'admin_panel.php',
            data: { delete: true, feedback_id: feedbackId },
            success: function() {
                $('.feedbacks').load(location.href + ' .feedbacks');
            }
        });
    }
</script>
</body>
</html>
