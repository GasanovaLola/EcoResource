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

    <div class="main" style="margin-top: 50px">
        <div class="container">
            <div class="row row-medium" style="align-items: flex-start;">
                <div class="column width-2-3-lg width-2-3-md width-1-1-sm">
                    <div class="hero-form" style="width: 100%">
                        <div class="hero-bg" style="display: flex; justify-content: center; align-items: center">
                            <h2 style="color: #FFFFFF; padding: 100px 0; text-align: center; max-width: 500px;">Application form for participation in the green competition</h2>
                        </div>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

                            $user_id = $_SESSION["user"]["id"];
                            date_default_timezone_set('Europe/London'); // Установка часового пояса для Великобритании
                            $date_of_reporting = date("Y-m-d H:i:s");
                            $count_of_green_points = $_POST["count_of_green_points"];

                            require_once "database.php";
                            $sql = "SELECT count_of_green_points FROM green_points WHERE user_id = '$user_id'";

                            $sql_update = "UPDATE green_points SET count_of_green_points=? WHERE user_id=?";
                            if ($stmt_update = mysqli_prepare($conn, $sql_update)) {
                                mysqli_stmt_bind_param($stmt_update, "ss", $count_of_green_points, $user_id);
                                mysqli_stmt_execute($stmt_update);
                                echo "<div class='alert alert-success' style='margin: 0 58px; margin-top: 5px; width: auto;'>You have successfully submitted the form.</div>";
                            }

                            // Insert into recycling_data_history table
                            $sql_insert = "INSERT INTO recycling_data_history (id_user, date_of_reporting, count_of_green_points) VALUES (?, ?, ?)";
                            $stmt_insert = mysqli_prepare($conn, $sql_insert);
                            if ($stmt_insert) {
                                mysqli_stmt_bind_param($stmt_insert, "iss", $user_id, $date_of_reporting, $count_of_green_points);
                                if (mysqli_stmt_execute($stmt_insert)) {
                                    echo "<div class='alert alert-success' style='margin: 0 58px; margin-top: 5px; width: auto;'>Your recycling history stored successfully.</div>";
                                } else {
                                    echo "<div class='alert alert-danger' style='margin: 0 58px; margin-top: 5px; width: auto;'>Error inserting into recycling_data_history: " . mysqli_error($conn) . "</div>";
                                }
                                mysqli_stmt_close($stmt_insert);
                            } else {
                                echo "<div class='alert alert-danger' style='margin: 0 58px; margin-top: 5px; width: auto;'>Error preparing insert statement: " . mysqli_error($conn) . "</div>";
                            }
                        }
                        ?>

                        <form action="" method="post" onsubmit="handleSubmit()" style="margin: 45px 58px;">

                            <p style="border-bottom: 1px solid #80FF00; padding-bottom: 35px; margin-bottom: 35px;">You can read about each nomination on the <a href="sustainability.php">Sustainability page</a>.</p>
                            <div class="form-group">
                                <label class="text">Carbon Emissions Reduction:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="10">
                                        <label class="form-check-label" for="inlineRadio1">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="5">
                                        <label class="form-check-label" for="inlineRadio2">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="0">
                                        <label class="form-check-label" for="inlineRadio3">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Renewable Energy Usage:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio4" value="10">
                                        <label class="form-check-label" for="inlineRadio4">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio5" value="5">
                                        <label class="form-check-label" for="inlineRadio5">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio6" value="0">
                                        <label class="form-check-label" for="inlineRadio6">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Waste Reduction:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions3" id="inlineRadio7" value="10">
                                        <label class="form-check-label" for="inlineRadio7">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions3" id="inlineRadio8" value="5">
                                        <label class="form-check-label" for="inlineRadio8">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions3" id="inlineRadio9" value="0">
                                        <label class="form-check-label" for="inlineRadio9">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Sustainable Supply Chain:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions4" id="inlineRadio10" value="10">
                                        <label class="form-check-label" for="inlineRadio10">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions4" id="inlineRadio11" value="5">
                                        <label class="form-check-label" for="inlineRadio11">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions4" id="inlineRadio12" value="0">
                                        <label class="form-check-label" for="inlineRadio12">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Energy-Efficient Infrastructure:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions5" id="inlineRadio13" value="10">
                                        <label class="form-check-label" for="inlineRadio13">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions5" id="inlineRadio14" value="5">
                                        <label class="form-check-label" for="inlineRadio14">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions5" id="inlineRadio15" value="0">
                                        <label class="form-check-label" for="inlineRadio15">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Eco-friendly Products/Services:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions6" id="inlineRadio16" value="10">
                                        <label class="form-check-label" for="inlineRadio16">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions6" id="inlineRadio17" value="5">
                                        <label class="form-check-label" for="inlineRadio17">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions6" id="inlineRadio18" value="0">
                                        <label class="form-check-label" for="inlineRadio18">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Transportation Sustainability:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions7" id="inlineRadio19" value="10">
                                        <label class="form-check-label" for="inlineRadio19">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions7" id="inlineRadio20" value="5">
                                        <label class="form-check-label" for="inlineRadio20">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions7" id="inlineRadio21" value="0">
                                        <label class="form-check-label" for="inlineRadio21">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Sustainable Packaging:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions8" id="inlineRadio22" value="10">
                                        <label class="form-check-label" for="inlineRadio22">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions8" id="inlineRadio23" value="5">
                                        <label class="form-check-label" for="inlineRadio23">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions8" id="inlineRadio24" value="0">
                                        <label class="form-check-label" for="inlineRadio24">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Community Engagement:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions9" id="inlineRadio25" value="10">
                                        <label class="form-check-label" for="inlineRadio25">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions9" id="inlineRadio26" value="5">
                                        <label class="form-check-label" for="inlineRadio26">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions9" id="inlineRadio27" value="0">
                                        <label class="form-check-label" for="inlineRadio27">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text">Transparency and Reporting:</label>

                                <div class="radio-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions10" id="inlineRadio28" value="10">
                                        <label class="form-check-label" for="inlineRadio28">Green (10 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions10" id="inlineRadio29" value="5">
                                        <label class="form-check-label" for="inlineRadio29">Amber (5 pts)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions10" id="inlineRadio30" value="0">
                                        <label class="form-check-label" for="inlineRadio30">Red (0 pts)</label>
                                    </div>
                                </div>
                            </div>

                            <!--
                            <div class="form-check" style="margin-top: 45px; border-top: 1px solid #80FF00; padding-top: 35px;">
                                <input type="checkbox" class="form-check-input" id="Check1" name="Check1">
                                <label class="form-check-label text" for="Check1" style="white-space: normal;">I confirm that I have read and agree with the
                                    <a href="">privacy policy</a> and undertake to provide accurate data in accordance with the
                                    <a href="">terms of use of the service</a>.
                                </label>
                            </div>
                            -->
                            <input type="hidden" id="countOfGreenPointsField" name="count_of_green_points" value="">
                            <button name="submit" type="submit" class="btn btn-primary" style="width: 100%; margin: 15px 0; margin-top: 35px;">SUBMIT</button>
                        </form>
                    </div>
                </div>
                <div class="column width-1-3-lg width-1-3-md width-1-1-sm" style="display: flex;flex-wrap: wrap;">
                    <div class="" style="margin-bottom: 15px">
                        <div class="block-border shadow green-points-bg" style="width: 100%;">

                            <p style="color: #fff; font-weight: 600; line-height: normal;">The number of your green points:</p>
                            <p style="font-size: 40px; font-weight: 600; color: #80FF00;"><span id="totalPoints">0</span> pts </p>
                            <p style="font-size: 18px; color: #fff;"> go to the <a href="green_point_shop.php">green points shop</a>.</p>
                        </div>
                    </div>
                    <div class="block-border shadow voucher-bg" style="width: 100%">
                        <p style="line-height: normal; font-weight: 600; transform: scale(-1, 1);">Voucher/donation amount bought:</p>
                        <p style="font-size: 18px; color: #0B1C3F; transform: scale(-1, 1);">(this is shortfall pts x £10)</p>
                        <p style="font-size: 40px; font-weight: 600; color: #80FF00; transform: scale(-1, 1);"> <span id="totalPointsVoucher">1000</span>  £</p>
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
</script>
<script>
    // Функция для обновления общей суммы
    function updateTotalPoints() {
        var totalPoints = 0;
        var totalPointsVoucher = 1000;
        // Получаем все выбранные радио-кнопки с классом form-check-input
        var radioButtons = document.querySelectorAll('.form-check-input:checked');
        // Проходим по каждой выбранной кнопке и добавляем ее значение к общей сумме
        radioButtons.forEach(function(button) {
            totalPoints += parseInt(button.value);
            totalPointsVoucher = (100 - totalPoints) * 10;
        });
        // Обновляем текст элемента с id totalPoints с помощью полученной общей суммы
        document.getElementById('totalPoints').textContent = totalPoints;
        document.getElementById('totalPointsVoucher').textContent = totalPointsVoucher;
        document.getElementById('countOfGreenPointsField').value = totalPoints;
    }

    // Вызываем функцию updateTotalPoints при изменении состояния любой радио-кнопки
    document.querySelectorAll('.form-check-input').forEach(function(input) {
        input.addEventListener('change', updateTotalPoints);
    });

    window.addEventListener('DOMContentLoaded', updateTotalPoints);

    function handleSubmit() {
        window.location.href = 'personal_account.php';
    }
</script>
</body>
</html>
