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

    <div class="container">
        <div class="main">
            <div class="ultra-container" style="margin-top: 70px">
                <h2 style="margin: 45px 0">We welcome you to EcoResource!</h2>

                <div class="row row-medium" style="align-items: flex-start">
                    <div class="column width-2-3-lg width-2-3-md width-1-1-sm" style="flex-wrap: wrap">

                        <?php
                        if(isset($_POST["submit"])) {
                            $user_id = $_SESSION["user"]["id"];

                            $full_name = $_POST["full_name"];
                            $payment_method = $_POST["payment_method"];
                            date_default_timezone_set('Europe/London'); // Устанавливаем часовой пояс для Великобритании
                            $date_time = date("Y-m-d H:i:s");
                            $status = '';

                            $count_of_green_points = $_POST['count_of_green_points'];

                            $credit_card_number = $_POST["credit_card_number"];
                            $cvv = $_POST["cvv"];
                            $expiry_date = $_POST["expiry_date"];

                            if(!isset($_POST["payment_method"])) {
                                echo "<div class='alert alert-danger'>Please select a payment method.</div>";
                                exit;
                            }

                            if (!empty($payment_method)) {
                                $status = 'successfully';
                            } else {
                                $status = 'unsuccessfully';
                            }

                            $errors = array();

                            if (empty($credit_card_number) OR empty($cvv) OR empty($expiry_date) OR empty($count_of_green_points) OR empty($full_name)) {
                                array_push($errors, "All fields are required");
                            }
                            if (strlen($credit_card_number) < 16) {
                                array_push($errors, "Credit card number must be at least 16 characters long");
                            }
                            if (strlen($cvv) !== 3) {
                                array_push($errors, "CVV number must be 3 characters long");
                            }

                            require_once "database.php";

                            $sql = "INSERT INTO payment_history (user_id, payment_method, date_time, status, count_of_green_points) VALUES (?,?,?,?,?)";
                            $stmt = mysqli_stmt_init($conn);
                            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                            if ($prepareStmt) {
                                mysqli_stmt_bind_param($stmt, "sssss", $user_id, $payment_method, $date_time, $status, $count_of_green_points);
                                mysqli_stmt_execute($stmt);

                                echo "<div class='alert alert-success'>Your payment is successful.</div>";

                                require_once "database.php";
                                $sql = "SELECT count_of_green_points FROM green_points WHERE user_id = '$user_id'";

                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    if ($row) {
                                        $green_points = $row['count_of_green_points'];
                                    }
                                }

                                require_once "database.php";
                                $count_of_green_points = 0;
                                $count_of_green_points = $_POST['count_of_green_points']; // buy for now

                                $green_points = $green_points + $count_of_green_points;

                                if ($green_points > 100) {
                                    $green_points = 100;
                                }

                                $sql_update = "UPDATE green_points SET count_of_green_points=? WHERE user_id=?";
                                $stmt_update = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt_update, $sql_update);
                                mysqli_stmt_bind_param($stmt_update, "ii", $green_points, $user_id);
                                mysqli_stmt_execute($stmt_update);
                                echo "<div class='alert alert-success'>You have successfully updated your count of your green points.</div>";

                            } else {
                                die("Something went wrong");
                            }
                        }
                        ?>
                        <form action="" method="post" onsubmit="handleSubmit()" style="width: 100%">
                            <p style="width: 100%; margin-bottom: 10px; font-size: 18px;">Enter the number of points you wish to purchase.</p>
                            <div class="row row-medium" style="align-items: center; width: 100%">
                                <div class="column width-2-3-lg width-2-3-md width-1-1-sm" style="padding-right: 2.5px">
                                    <input name="count_of_green_points" type="text" class="form-control" id="count_of_green_points" aria-describedby="expiry_date" placeholder="Enter count of green points" value="" style="margin: 5px 0; width: 100%;">
                                </div>
                                <div class="column width-1-3-lg width-1-3-md width-1-1-sm" style="padding-left: 2.5px">
                                    <button name="submit" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">OK</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Payment Method:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment_method" id="inlineRadio1" value="Credit card">
                                        <label class="form-check-label" for="inlineRadio1">Credit card</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment_method" id="inlineRadio2" value="Debit card">
                                        <label class="form-check-label" for="inlineRadio2">Debit card</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment_method" id="inlineRadio3" value="PayPal">
                                        <label class="form-check-label" for="inlineRadio3">PayPal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="full_name" class="text">Name on card</label>
                                <?php
                                $user_id = $_SESSION["user"]["id"];

                                require_once "database.php";
                                $sql = "SELECT full_name FROM users WHERE id = '$user_id'";
                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    if ($row) {
                                        $full_name = $row['full_name'];
                                        if ($full_name) {
                                            echo '<input name="full_name" type="text" class="form-control" id="full_name" aria-describedby="fullName" placeholder="Full Name.." value="' . htmlspecialchars($full_name) .' " style="margin: 5px 0;">';
                                        } else {
                                            echo '<input name="full_name" type="text" class="form-control" id="full_name" aria-describedby="fullName" placeholder="Full Name.." style="margin: 5px 0;">';
                                        }
                                    }
                                }
                                ?>
                                <small id="passwordHelp" class="form-text text-muted" style="font-size: 14px;">Full name as displayed on card</small>
                            </div>
                            <div class="form-group">
                                <label for="credit_card_number" class="text">Credit card number</label>
                                <?php
                                    $user_id = $_SESSION["user"]["id"];
                                    require_once "database.php";
                                    $sql = "SELECT credit_card_number FROM credit_card WHERE user_id = '$user_id'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        if ($row) {
                                            $credit_card_number = $row['credit_card_number'];
                                            echo '<input name="credit_card_number" type="text" class="form-control" id="credit_card_number" aria-describedby="credit_card_number" placeholder="Enter credit card number" value="' . htmlspecialchars($credit_card_number) .'" style="margin: 5px 0;">';
                                        } else {
                                            echo '<input name="credit_card_number" type="text" class="form-control" id="credit_card_number" aria-describedby="credit_card_number" placeholder="Enter credit card number.." style="margin: 5px 0;">';
                                        }
                                    }
                                ?>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="" style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="form-group" style="margin-left: 2.5px; width: 100%">
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
                                            echo '<input name="cvv" type="text" class="form-control" id="cvv" aria-describedby="cvv" placeholder="Enter cvv .." value="' . htmlspecialchars($cvv) .'" style="margin: 5px 0; width: 100%; margin-right: 2.5px">';
                                        } else {
                                            echo '<input name="cvv" type="text" class="form-control" id="cvv" aria-describedby="cvv" placeholder="Enter cvv .." style="margin: 5px 0; width: 100%; margin-right: 2.5px;">';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="form-group" style="margin-right: 2.5px; width: 100%">
                                    <label for="expiry_date" class="text">Expiration</label>
                                    <?php
                                    $user_id = $_SESSION["user"]["id"];
                                    require_once "database.php";
                                    $sql = "SELECT expiry_date FROM credit_card WHERE user_id = '$user_id'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        if ($row) {
                                            $expiry_date = $row['expiry_date'];
                                            echo '<input name="expiry_date" type="date" class="form-control" id="expiry_date" aria-describedby="expiry_date" placeholder="Enter expiry date .." value="' . htmlspecialchars($expiry_date) .'" style="margin: 5px 0; width: 100%; margin-left: 2.5px;">';
                                        } else {
                                            echo '<input name="expiry_date" type="date" class="form-control" id="expiry_date" aria-describedby="expiry_date" placeholder="Enter expiry date .." style="margin: 5px 0; width: 100%; margin-left: 2.5px;">';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <p>Pressing the "Pay" button, you confirm that you are familiar with the list of service information and accept the terms of the public contract.</p>
                            <button name="submit" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0;">OK</button>
                        </form>
                    </div>
                    <div class="column width-1-3-lg width-1-3-md width-1-1-sm">
                        <div class="block-extra" style="width: 100%">
                            <p>The number of green points you need to get the gold certificate:</p>
                            <?php
                                $user_id = $_SESSION["user"]["id"];

                                require_once "database.php";
                                $sql = "SELECT count_of_green_points FROM green_points WHERE user_id = '$user_id'";

                                $result = mysqli_query($conn, $sql);
                                $count_of_green_points = 0;

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);

                                    if ($row) {
                                        $count_of_green_points = 100 - $row['count_of_green_points'];

                                        echo '<p style="font-size: 28px; font-weight: 600; color: #0B1C3F; margin-bottom: 0">' . htmlspecialchars($count_of_green_points) . ' pts' . '</p>';
                                    } else {}
                                } else {}
                            ?>
                        </div>
                    </div>
                </div>
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
</script>
<script>
    function handleSubmit() {
        var countOfGreenPoints = document.getElementById("count_of_green_points").value;
        document.getElementById("count_of_green_points_hidden").value = countOfGreenPoints;
    }
</script>
</body>
</html>