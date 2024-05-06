<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
    }
    $isUserLoggedIn = isset($_SESSION["user"]) && is_array($_SESSION["user"]);
    $user_id = $_SESSION["user"]["id"];

    require_once "database.php";
    $sql = "SELECT full_name FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $full_name = $row['full_name'];
            if ($full_name) {
                $arText["USER_NAME"] = $full_name;
            } else {
                $arText["USER_NAME"] = "USER";
            }
        }
    }

    $sql = "SELECT company_name FROM companies WHERE user_id = '$user_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $company_name = $row['company_name'];
            if ($company_name) {
                $arText["FINAL_CONGRATULATIONS"] = "Thank you, $company_name, for your significant \ncontribution to the health of the \nenvironment and our planet Earth.";
            } else {
                $arText["FINAL_CONGRATULATIONS"] = "Thank you Company for your significant \ncontribution to the health of the \nenvironment and our Planet Earth.";
            }
        } else {
            $arText["FINAL_CONGRATULATIONS"] = "Thank you Company for your significant \ncontribution to the health of the \nenvironment and our Planet Earth.";
        }
    } else {
        $arText["FINAL_CONGRATULATIONS"] = "Thank you Company for your significant \ncontribution to the health of the \nenvironment and our Planet Earth.";
    }

    $sql = "SELECT count_of_green_points FROM recycling_data_history WHERE id_user = ?";

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
        mysqli_stmt_bind_result($stmt, $count_of_green_points);

        // Check if there are rows returned
        if (mysqli_stmt_fetch($stmt)) {
            while (mysqli_stmt_fetch($stmt)) {
            }
            $green_points = $count_of_green_points;
        }
    }

    require_once "database.php";

    $sql = "SELECT count_of_green_points FROM payment_history WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        $user_id = $_SESSION["user"]["id"];

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
            $voucher = $count_of_green_points;
        } else {
            $voucher = 0;
        }
    }


    if ($green_points >= 90 && $green_points <= 100) {
        require_once('fpdf184/fpdf.php');

        $arText["CERTIFICATE"] = "CERTIFICATE";
        $arText["USER_CONGRATULATIONS"] = "this certificate confirms that";
        $arText["USER_CONGRATULATIONS_SECOND_PART"] = "participated in a project at Edinburgh \nCollege, which focuses on nature \nconservation and recycling. ";
        $arText["AUTHOR"] = "by Lolita Hasanova";

        // Create a new instance of FPDF with landscape orientation and custom page size
        $pdf = new FPDF("L", "pt", [1920, 1200]);

        // Add a new page
        $pdf->AddPage();

        // Set fill color for the rectangle
        $pdf->SetFillColor(11, 28, 63);

        // Draw a filled rectangle with specified dimensions
        $pdf->Rect(50, 50, 945, 1101, 'F');

        $pdf->Image('images/windmills-wheat-field-with-evening-light-ai-generative.jpg', 995, 50, 875, 1100);

        $pdf->Image('images/Edinburgh-College.png', 1460, 60, 400);

        $pdf->Image('images/gold-medal.png', 1760, 1025, 150);

        $pdf->SetXY(150, 160);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 56);
        $pdf->MultiCell(700, 62, $arText["CERTIFICATE"]);

        $pdf->SetFillColor(255, 205, 129);
        $pdf->Rect(150, 250, 745, 5, 'F');

        $pdf->SetXY(150, 350);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 62, $arText["USER_CONGRATULATIONS"]);

        $pdf->SetXY(150, 430);
        $pdf->SetTextColor(255, 205, 129);
        $pdf->SetFont('Arial', '', 48);
        $pdf->MultiCell(700, 62, $arText["USER_NAME"]);

        $pdf->SetXY(150, 510);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 50, $arText["USER_CONGRATULATIONS_SECOND_PART"]);

        $pdf->SetXY(150, 740);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 50, $arText["FINAL_CONGRATULATIONS"]);

        $pdf->SetFillColor(255, 205, 129);
        $pdf->Rect(150, 1000, 745, 0.5, 'F');

        $pdf->SetXY(400, 1040);
        $pdf->SetTextColor(255, 205, 129);
        $pdf->SetFont('Arial', '', 28);
        $pdf->MultiCell(700, 62, $arText["AUTHOR"]);

        // $pdf->Output('certificate.pdf', 'I'); // Вывод PDF-документа в браузер
        $pdf->Output('certificate.pdf', 'F');
    } else if (($green_points >= 75 && $green_points <= 90) || $voucher > 0) {
        require_once('fpdf184/fpdf.php');

        $arText["CERTIFICATE"] = "CERTIFICATE";
        $arText["USER_CONGRATULATIONS"] = "this certificate confirms that";
        $arText["USER_CONGRATULATIONS_SECOND_PART"] = "participated in a project at Edinburgh \nCollege, which focuses on nature \nconservation and recycling. ";
        $arText["AUTHOR"] = "by Lolita Hasanova";

        // Create a new instance of FPDF with landscape orientation and custom page size
        $pdf = new FPDF("L", "pt", [1920, 1200]);

        // Add a new page
        $pdf->AddPage();

        // Set fill color for the rectangle
        $pdf->SetFillColor(11, 28, 63);

        // Draw a filled rectangle with specified dimensions
        $pdf->Rect(50, 50, 945, 1101, 'F');

        $pdf->Image('images/pexels-pixabay-219837.jpg', 995, 50, 875, 1100);

        $pdf->Image('images/Edinburgh-College.png', 1460, 60, 400);

        $pdf->Image('images/2nd-place_11166480.png', 1760, 1025, 150);

        $pdf->SetXY(150, 160);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 56);
        $pdf->MultiCell(700, 62, $arText["CERTIFICATE"]);

        $pdf->SetFillColor(127, 224, 255);
        $pdf->Rect(150, 250, 745, 5, 'F');

        $pdf->SetXY(150, 350);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 62, $arText["USER_CONGRATULATIONS"]);

        $pdf->SetXY(150, 430);
        $pdf->SetTextColor(127, 224, 255);
        $pdf->SetFont('Arial', '', 48);
        $pdf->MultiCell(700, 62, $arText["USER_NAME"]);

        $pdf->SetXY(150, 510);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 50, $arText["USER_CONGRATULATIONS_SECOND_PART"]);

        $pdf->SetXY(150, 740);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 50, $arText["FINAL_CONGRATULATIONS"]);

        $pdf->SetFillColor(127, 224, 255);
        $pdf->Rect(150, 1000, 745, 0.5, 'F');

        $pdf->SetXY(400, 1040);
        $pdf->SetTextColor(127, 224, 255);
        $pdf->SetFont('Arial', '', 28);
        $pdf->MultiCell(700, 62, $arText["AUTHOR"]);

        // $pdf->Output('certificate.pdf', 'I'); // Вывод PDF-документа в браузер
        $pdf->Output('certificate.pdf', 'F');
    } else if ($green_points >= 50 && $green_points <= 75) {
        require_once('fpdf184/fpdf.php');

        $arText["CERTIFICATE"] = "CERTIFICATE";
        $arText["USER_CONGRATULATIONS"] = "this certificate confirms that";
        $arText["USER_CONGRATULATIONS_SECOND_PART"] = "participated in a project at Edinburgh \nCollege, which focuses on nature \nconservation and recycling. ";
        $arText["AUTHOR"] = "by Lolita Hasanova";

        // Create a new instance of FPDF with landscape orientation and custom page size
        $pdf = new FPDF("L", "pt", [1920, 1200]);

        // Add a new page
        $pdf->AddPage();

        // Set fill color for the rectangle
        $pdf->SetFillColor(11, 28, 63);

        // Draw a filled rectangle with specified dimensions
        $pdf->Rect(50, 50, 945, 1101, 'F');

        $pdf->Image('images/grass-flower-sunset.jpg', 995, 50, 875, 1100);

        $pdf->Image('images/Edinburgh-College.png', 1460, 60, 400);

        $pdf->Image('images/bronze-medal_7645366.png', 1760, 1025, 150);

        $pdf->SetXY(150, 160);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 56);
        $pdf->MultiCell(700, 62, $arText["CERTIFICATE"]);

        $pdf->SetFillColor(255, 147, 113);
        $pdf->Rect(150, 250, 745, 5, 'F');

        $pdf->SetXY(150, 350);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 62, $arText["USER_CONGRATULATIONS"]);

        $pdf->SetXY(150, 430);
        $pdf->SetTextColor(255, 147, 113);
        $pdf->SetFont('Arial', '', 48);
        $pdf->MultiCell(700, 62, $arText["USER_NAME"]);

        $pdf->SetXY(150, 510);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 50, $arText["USER_CONGRATULATIONS_SECOND_PART"]);

        $pdf->SetXY(150, 740);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 50, $arText["FINAL_CONGRATULATIONS"]);

        $pdf->SetFillColor(255, 147, 113);
        $pdf->Rect(150, 1000, 745, 0.5, 'F');

        $pdf->SetXY(400, 1040);
        $pdf->SetTextColor(255, 147, 113);
        $pdf->SetFont('Arial', '', 28);
        $pdf->MultiCell(700, 62, $arText["AUTHOR"]);

        // $pdf->Output('certificate.pdf', 'I'); // Вывод PDF-документа в браузер
        $pdf->Output('certificate.pdf', 'F');
    } else {
        require_once('fpdf184/fpdf.php');

        $arText["CERTIFICATE"] = "CERTIFICATE";
        $arText["USER_CONGRATULATIONS"] = "this certificate confirms that";
        $arText["USER_CONGRATULATIONS_SECOND_PART"] = "participated in a project at Edinburgh \nCollege, which focuses on nature \nconservation and recycling. ";
        $arText["AUTHOR"] = "by Lolita Hasanova";

        $pdf = new FPDF("L", "pt", [1920, 1200]);
        $pdf->AddPage();

        $pdf->SetFillColor(11, 28, 63);
        $pdf->Rect(50, 50, 945, 1101, 'F');

        $pdf->Image('images/pexels-pixabay-414837 - Copy.png', 995, 50, 875, 1100);

        $pdf->Image('images/Edinburgh-College.png', 1460, 60, 400);

        $pdf->SetXY(150, 160);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 56);
        $pdf->MultiCell(700, 62, $arText["CERTIFICATE"]);

        $pdf->SetFillColor(128, 255, 0);
        $pdf->Rect(150, 250, 745, 5, 'F');

        $pdf->SetXY(150, 350);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 62, $arText["USER_CONGRATULATIONS"]);

        $pdf->SetXY(150, 430);
        $pdf->SetTextColor(128, 255, 0);
        $pdf->SetFont('Arial', '', 48);
        $pdf->MultiCell(700, 62, $arText["USER_NAME"]);

        $pdf->SetXY(150, 510);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 50, $arText["USER_CONGRATULATIONS_SECOND_PART"]);

        $pdf->SetXY(150, 740);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 34);
        $pdf->MultiCell(700, 50, $arText["FINAL_CONGRATULATIONS"]);

        $pdf->SetFillColor(128, 255, 0);
        $pdf->Rect(150, 1000, 745, 0.5, 'F');

        $pdf->SetXY(400, 1040);
        $pdf->SetTextColor(128, 255, 0);
        $pdf->SetFont('Arial', '', 28);
        $pdf->MultiCell(700, 62, $arText["AUTHOR"]);

        // $pdf->Output('certificate.pdf', 'I'); // Вывод PDF-документа в браузер
        $pdf->Output('certificate.pdf', 'F');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

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
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about_us.php">About Us</a>
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
        <div class="container ultra-container" style="margin-top: 50px">
            <div class="block-certificate shadow" style="border: 1px solid #0B1C3F; border-radius: 12px; background-color: #0B1C3F; padding: 25px;">
                <div class="row row-medium" style="align-items: center">
                    <div class="column width-1-1-lg width-1-1-md width-1-1-sm">
                        <canvas id="pdf-canvas" style="width: 100%"></canvas>
                    </div>
                    <div class="column width-1-1-lg width-1-1-md width-1-1-sm">
                        <div class="" style="margin: 0 auto; margin-bottom: 15px;">
                            <h2 style="color: #F4F4F4; margin-top: 25px">Congratulations!</h2>
                            <p class="text" style="color: #F4F4F4; font-weight: 300;margin: 30px 0;">Thank you for your valuable contribution. We appreciate your dedication to sustainability and are grateful for your commitment to environmental conservation. Your support for our green initiatives is invaluable, and your active role in the green sustainable action is inspiring. We are thankful for your contribution to a greener future.</p>
                            <button type="button" class="btn btn-outline-light" onclick="redirectToCertificate()" style="white-space: nowrap; margin-right: 5px;"><i class="fa-solid fa-print" style="color: #F4F4F4; font-size: 21px"></i></button>
                            <a class="btn btn-outline-light extra" href="certificate.pdf" style="color: #F4F4F4; font-size: 16px" download>Download Certificate</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="pdf-container">
            <embed class="pdf-object" src="certificate.pdf" type="application/pdf" />
        </div>-->

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
        const pdfUrl = 'certificate.pdf';

        const options = { scale: 1.5 };

        pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
            pdf.getPage(1).then(page => {
                const canvas = document.getElementById('pdf-canvas');
                const context = canvas.getContext('2d');
                const viewport = page.getViewport(options);
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };

                page.render(renderContext).promise.then(() => {
                    // Преобразование содержимого canvas в изображение
                    const imageDataURL = canvas.toDataURL('image/png');

                    // Создание элемента изображения и добавление его на страницу
                    const img = new Image();
                    img.src = imageDataURL;
                });
            });
        });

        function redirectToRegistration() {
            window.location.href = 'registration.php';
        }

        function redirectToLogin() {
            window.location.href = 'login.php';
        }

        function redirectToLogout() {
            window.location.href = 'logout.php';
        }

        function redirectToCertificate() {
            window.location.href = 'certificate.pdf';
        }

        function redirectToPersonalAccount() {
            window.location.href = 'personal_account.php';
        }
    </script>
</body>
</html>