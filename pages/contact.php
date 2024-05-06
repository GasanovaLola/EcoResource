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

    <div class="main container ultra-container" style="margin-top: 100px;">
        <h2 class="title textToSpeak">Contact Us</h2>

        <button id="speakButton" onclick="speakText()" class="volume" style="margin-bottom: 15px;"><i class="fa-solid fa-volume-high" style="text-align: center; color: #0B1C3F; font-size: 25px;"></i></button>
        <button id="stopButton" onclick="stopText()" class="volume" style="display: none; margin-bottom: 15px;"><i class="fa-solid fa-volume-xmark" style="text-align: center; color: #0B1C3F; font-size: 25px;"></i></button>

        <p class="textToSpeak" style="font-size: 18px; color: #0B1C3F;">
            Thank you for your interest in our sustainability and green energy initiatives. Whether you have questions, feedback,
            or partnership inquiries, we're here to help. Get in touch with us using the contact information below:
            <br><br>
            Email: <a href="mailto:info@sustainabilityenergy.com">info@sustainabilityenergy.com</a>
            <br>
            Phone: <a href="tel:+11234567890">+1 (123) 456-7890</a>
            <br>
            Address: 123 Green Way, EcoCity, Earth
            <br><br>
        </p>
        <p class="textToSpeak" style="font-size: 18px; color: #0B1C3F;">We also invite you to connect with us on social media to
            stay updated on our latest projects and events:
            <br><br>
            Facebook: <a href="">@SustainabilityEnergy</a>
            <br>
            Twitter: <a href="">@GreenEnergyCo</a>
            <br>
            Instagram: <a href="">@SustainabilityEco</a>
            <br><br>
        </p>
        <p class="textToSpeak" style="font-size: 18px; color: #0B1C3F;">For media inquiries or press-related matters, please contact our press team:
            <br><br>
            Email: <a href="mailto:press@sustainabilityenergy.com">press@sustainabilityenergy.com</a>
            <br>
            Phone: <a href="tel:+11234567890">+1 (123) 456-7890 ext. 123</a>
            <br><br>
            Thank you for joining us on our journey towards a more sustainable and eco-friendly future. We look forward to hearing
            from you!
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
<script>
    var utterance = null;

    function speakText() {
        var elements = document.querySelectorAll(".textToSpeak");
        var text = "";
        elements.forEach(function(element) {
            text += element.innerText + " ";
        });

        // Speech synthesis part
        utterance = new SpeechSynthesisUtterance();
        utterance.lang = "en-US";
        utterance.text = text;
        utterance.volume = 1;
        utterance.rate = 1;
        utterance.pitch = 1;

        window.speechSynthesis.speak(utterance);
        document.getElementById("speakButton").style.display = "none";
        document.getElementById("stopButton").style.display = "inline";
    }

    function stopText() {
        if (utterance) {
            window.speechSynthesis.cancel();
            document.getElementById("speakButton").style.display = "inline";
            document.getElementById("stopButton").style.display = "none";
        }
    }
</script>
</body>
</html>