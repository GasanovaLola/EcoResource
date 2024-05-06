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
<style>
    .temp p {
        font-size: 18px;
        text-align: justify;
    }
    .temp h5 {
        color: #0B1C3F;
        margin-bottom: 15px;
        margin-top: 45px;
    }
    .temp h2 {
        color: #0B1C3F;
        margin-bottom: 25px;
        text-align: center;
    }
</style>
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
                        <button type="button" class="btn btn-outline-primary shadow" onclick="redirectToRegistration()" style="margin: 0 2px">Registration</button>
                        <button type="button" class="btn btn-outline-primary shadow" onclick="redirectToLogin()" style="margin: 0 2px">Log in</button>
                    <?php endif; ?>
                    <?php if ($isUserLoggedIn && isset($_SESSION["user"]["full_name"])) : ?>
                        <button type="button" class="btn btn-outline-primary shadow" onclick="redirectToLogout()" style="margin: 0 2px">Log Out</button>
                        <button type="button" class="btn btn-primary shadow" onclick="redirectToPersonalAccount()" style="margin: 0 2px"><?php echo "Account: " . $_SESSION["user"]["full_name"]; ?></button>
                    <?php endif; ?>

                </div>
            </div><nav class="navbar navbar-expand-lg navbar-light">
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
    <!--<div class="hero">
        <div class="container" style="height: 567px; display: flex; justify-content: center; align-items: center;">
            <div class="hero-main-block" style="max-width: 600px;">
                <h2 class="title">Our Approach to Green Energy</h2>
                <p style="text-align: center; color: #0B1C3F; font-size: 17px;">At the heart of our mission is the adoption of sustainable energy practices. We are dedicated to
                    reducing our carbon footprint and minimizing environmental impact through the implementation of innovative
                    green energy solutions. By prioritizing renewable sources such as solar, wind, hydro, and biomass, we strive
                    to lead the way in sustainable energy adoption.
                    <br><br>
                    Join us in shaping a greener tomorrow, today.
                    <br><br>
                </p>
                <div class="hero-buttons">
                    <div class="row row-medium" style="justify-content: center;">
                        <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="justify-content: center;">
                            <button type="button" class="btn btn-primary shadow" style="width: 100%;">Read More</button>
                        </div>
                        <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="justify-content: center;">
                            <button type="button" class="btn btn-primary shadow" style="width: 100%;">Join</button>
                        </div>
                    </div>
                </div>
                <div class="arrow" style="color: #0B1C3F">
                    <i class="fa-solid fa-angles-down"></i>
                </div>
            </div>
        </div>
    </div>-->

    <div class="main container ultra-container temp" style="margin-top: 100px;">
        <h2>Privacy Policy</h2>
        <p>
            Effective Date: 22/01/2024
            <br><br>
            Thank you for visiting EcoResource. Your privacy is important to us, and we are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, disclose, and safeguard your information when you visit our website.
            <br><br>
            By accessing or using the Site, you agree to the terms of this Privacy Policy. If you do not agree with the terms of this Privacy Policy, please do not access the Site.
        </p>
        <h5>Information We Collect</h5>
        <p>
            We may collect personal information from you when you voluntarily provide it to us through forms, registrations, surveys, or other interactions on the Site. This information may include your name, email address, company name, and any other information you choose to provide.
            <br><br>
            We may also automatically collect certain information about your device and usage of the Site through cookies, web beacons, and similar tracking technologies. This information may include your IP address, browser type, operating system, and browsing behavior.
        </p>
        <h5>How We Use Your Information</h5>
        <p>
            We may use the information we collect from you to:
        </p>
        <p style="margin-left: 25px">
            - Provide, operate, and improve the Site <br>
            - Communicate with you, including responding to your inquiries and providing updates <br>
            - Analyze trends and usage of the Site <br>
            - Personalize your experience on the Site <br>
            - Enforce our terms and policies <br>
            - Protect against illegal activities, fraud, and other liabilities
        </p>

        <h5>Disclosure of Your Information</h5>
        <p>
            We may share your personal information with third parties only in the following circumstances:
        </p>
        <p style="margin-left: 25px">
            - With your consent <br>
            - To comply with legal obligations or requests <br>
            - To protect the rights, property, or safety of EcoResource, our users, or others
        </p>
        <p>
            We will not sell, rent, or otherwise disclose your personal information to third parties for marketing purposes without your consent.
        </p>
        <h5>Data Security</h5>
        <p>
            We take reasonable measures to protect your personal information from unauthorized access, use, or disclosure. However, no method of transmission over the Internet or electronic storage is completely secure, so we cannot guarantee absolute security.
        </p>
        <h5>Children's Privacy</h5>
        <p>
            The Site is not directed to children under the age of 13, and we do not knowingly collect personal information from children under the age of 13. If you believe that we have inadvertently collected personal information from a child under 13, please contact us immediately.
        </p>
        <h5>Changes to This Privacy Policy</h5>
        <p>
            We reserve the right to update or modify this Privacy Policy at any time without prior notice. We will post the revised Privacy Policy on the Site with the effective date. Your continued use of the Site after any changes to this Privacy Policy constitutes your acceptance of the changes.
        </p>
        <h5><a href="contact.php">Contact Us</a></h5>
        <p style="text-align: left">
            If you have any questions or concerns about this Privacy Policy, please contact us at <a href="mailto:info@sustainabilityenergy.com">info@sustainabilityenergy.com</a>.
            <br><br>
            Last Updated: 22/04/2024
        </p>
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

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick-1.8.1/slick/slick.min.js"></script>

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
</body>
</html>