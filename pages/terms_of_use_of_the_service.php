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
        <h2>Terms of Use</h2>

        <p>Effective Date: 22/01/2024
            <br><br>
            Thank you for visiting EcoResource. By accessing or using the Site, you agree to be bound by these Terms of Use. If you do not agree with these Terms of Use, please do not access or use the Site.
        </p>
        <h5>Use of the Site</h5>
        <p>
            The Site is intended for use by individuals who are at least 13 years old. By accessing or using the Site, you represent and warrant that you are at least 13 years old.
        </p>
        <p>
            You may use the Site for lawful purposes only. You agree not to:
        </p>
        <p style="margin-left: 25px">
            - Use the Site in any way that violates any applicable law or regulation <br>
            - Engage in any activity that interferes with or disrupts the Site or the servers and networks connected to the Site
            <br>
            - Attempt to gain unauthorized access to any portion of the Site or any other systems or networks connected to the Site
            <br>
            - Use any robot, spider, scraper, or other automated means to access the Site <br>
            - Use the Site for any commercial purposes without our prior written consent
        </p>
        <h5>Intellectual Property</h5>
        <p>
            All content on the Site, including text, graphics, logos, images, audio clips, and software, is owned or licensed by EcoResource and is protected by copyright, trademark, and other intellectual property laws. You may not copy, reproduce, distribute, or create derivative works based on the content of the Site without our prior written consent.
        </p>
        <h5>Disclaimer of Warranties</h5>
        <p>
            The Site is provided on an "as-is" and "as-available" basis. We make no representations or warranties of any kind, express or implied, regarding the operation of the Site or the accuracy, completeness, or reliability of any content on the Site.
        </p>
        <h5>Limitation of Liability</h5>
        <p>
            To the fullest extent permitted by applicable law, we will not be liable for any indirect, incidental, special, consequential, or punitive damages arising out of or related to your use of the Site.
        </p>
        <h5>Indemnification</h5>
        <p>
            You agree to indemnify and hold EcoResource and its officers, directors, employees, and agents harmless from and against any claims, liabilities, damages, losses, and expenses, including reasonable attorneys' fees, arising out of or related to your use of the Site or any violation of these Terms of Use.
        </p>
        <h5>Changes to These Terms of Use</h5>
        <p>
            We reserve the right to update or modify these Terms of Use at any time without prior notice. We will post the revised Terms of Use on the Site with the effective date. Your continued use of the Site after any changes to these Terms of Use constitutes your acceptance of the changes.
        </p>
        <h5>Governing Law</h5>
        <p>
            These Terms of Use are governed by and construed in accordance with the laws, without regard to its conflict of law principles.
        </p>
        <h5><a href="contact.php">Contact Us</a></h5>
        <p style="text-align: left">
            If you have any questions or concerns about these Terms of Use, please contact us at <a href="mailto:info@sustainabilityenergy.com">info@sustainabilityenergy.com</a>.
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