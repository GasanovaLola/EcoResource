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
    <div class="bg-sustainability">
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
        <div class="hero">
            <div class="container" style="height: 567px; display: flex; justify-content: center; align-items: center;">
                <div class="hero-main-block" style="max-width: 600px; text-align: center">
                    <h2 class="textToSpeak title">Our Approach to Green Energy</h2>
                    <p class="textToSpeak" style="text-align: center; color: #0B1C3F; font-size: 17px;">At the heart of our mission is the adoption of sustainable energy practices. We are dedicated to
                        reducing our carbon footprint and minimizing environmental impact through the implementation of innovative
                        green energy solutions. By prioritizing renewable sources such as solar, wind, hydro, and biomass, we strive
                        to lead the way in sustainable energy adoption.
                        <br><br>
                        Join us in shaping a greener tomorrow, today.
                        <br><br>
                    </p>
                    <button id="speakButton" onclick="speakText()" class="volume" style="margin-bottom: 15px;"><i class="fa-solid fa-volume-high" style="text-align: center; color: #0B1C3F; font-size: 25px;"></i></button>
                    <button id="stopButton" onclick="stopText()" class="volume" style="display: none; margin-bottom: 15px;"><i class="fa-solid fa-volume-xmark" style="text-align: center; color: #0B1C3F; font-size: 25px;"></i></button>

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
        </div>
    </div>

        <div class="main container ultra-container" style="margin-top: 100px;">
            <h2 class="textToSpeak title">Leading the Way Towards Sustainability</h2>
            <p class="textToSpeak" style="font-size: 18px; color: #0B1C3F; text-align: justify; margin-bottom: 50px;">
                Our commitment to sustainability at EcoResource is evident through our comprehensive array of key initiatives aimed
                at reducing our environmental impact and fostering social responsibility. By focusing on areas such as carbon emissions
                reduction, renewable energy usage, waste reduction, and community engagement, we strive to make a positive difference in
                the world.
                <br><br>
                Through innovative practices such as investing in renewable energy sources, implementing energy-efficient infrastructure,
                and offering eco-friendly products and services, we are actively working towards building a more sustainable future.
                Additionally, our dedication to transparency and reporting ensures that we remain accountable for our actions and strive
                for continuous improvement.
                <br><br>
                Ultimately, our goal is to inspire others to join us on this journey towards sustainability and to leave a lasting legacy
                of environmental stewardship. Together, let us work towards creating a world where future generations can thrive in harmony
                with the planet. Join us at EcoResource as we pave the way towards a more sustainable and equitable future for all.
            </p>
            <h2 class="textToSpeak title">Our Key Initiatives:</h2>
            <div class="row row-medium" style="align-items: stretch;">
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-right: 1px solid #80FF00; border-bottom: 1px solid #80FF00; padding-right: 25px; padding-top: 20px;">
                    <h5 style="" class="textToSpeak">Carbon Emissions Reduction:</h5>
                    <p class="textToSpeak p-sustainability">One of our primary focuses is on reducing carbon emissions across all aspects of our operations.
                        Through the implementation of energy-efficient practices, investment in renewable energy sources,
                        and the adoption of cleaner technologies, we strive to decrease our carbon footprint and mitigate
                        climate change.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-bottom: 1px solid #80FF00; padding-left: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Renewable Energy Usage:</h5>
                    <p class="textToSpeak p-sustainability">We recognize the importance of transitioning towards renewable energy sources to power our operations sustainably.
                        By investing in solar, wind, and hydroelectricity projects, we aim to increase our reliance on clean energy and
                        contribute to the global shift towards a low-carbon economy.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-right: 1px solid #80FF00; border-bottom: 1px solid #80FF00; padding-right: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Waste Reduction:</h5>
                    <p class="textToSpeak p-sustainability">Minimizing waste generation and promoting responsible waste management practices are integral parts of our
                        sustainability strategy. Through recycling initiatives, waste reduction programs, and the promotion of circular
                        economy principles, we aim to minimize our environmental impact and conserve natural resources.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-bottom: 1px solid #80FF00; padding-left: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Sustainable Supply Chain:</h5>
                    <p class="textToSpeak p-sustainability">We are committed to ensuring that our supply chain operates sustainably and ethically. By partnering with suppliers
                        who share our values and adhering to strict environmental and social standards, we strive to create a more sustainable
                        and resilient supply chain that benefits both people and the planet.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-right: 1px solid #80FF00; border-bottom: 1px solid #80FF00; padding-right: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Energy-Efficient Infrastructure:</h5>
                    <p class="textToSpeak p-sustainability">Investing in energy-efficient infrastructure is essential to reducing our overall energy consumption and environmental
                        footprint. Through building upgrades, equipment optimization, and the adoption of smart technology solutions, we aim
                        to minimize energy waste and improve operational efficiency.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-bottom: 1px solid #80FF00; padding-left: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Eco-friendly Products/Services:</h5>
                    <p class="textToSpeak p-sustainability">We are dedicated to offering eco-friendly products and services that meet the highest environmental standards. From sustainable
                        packaging options to energy-efficient appliances and green building materials, we strive to provide our customers with sustainable
                        choices that support a healthier planet.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-right: 1px solid #80FF00; border-bottom: 1px solid #80FF00; padding-right: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Transportation Sustainability:</h5>
                    <p class="textToSpeak p-sustainability">Reducing the environmental impact of transportation is a key priority for us. Through the adoption of fuel-efficient vehicles,
                        the promotion of alternative transportation options, and the optimization of logistics processes, we aim to minimize emissions
                        and promote sustainable mobility solutions.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-bottom: 1px solid #80FF00; padding-left: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Sustainable Packaging:</h5>
                    <p class="textToSpeak p-sustainability">We are committed to reducing the environmental impact of our packaging materials by prioritizing recyclable, compostable,
                        and biodegradable options. By redesigning packaging and implementing waste reduction strategies, we aim to minimize packaging
                        waste and promote a circular economy.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-right: 1px solid #80FF00; border-bottom: 1px solid #80FF00; padding-right: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Community Engagement:</h5>
                    <p class="textToSpeak p-sustainability">Engaging with our local communities is an essential part of our sustainability efforts. Through partnerships, outreach programs,
                        and volunteer initiatives, we strive to support and empower communities to become more resilient, sustainable, and environmentally
                        aware.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-bottom: 1px solid #80FF00; padding-left: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Transparency and Reporting:</h5>
                    <p class="textToSpeak p-sustainability">We believe in transparency and accountability in our sustainability practices. Through regular reporting, stakeholder engagement,
                        and public disclosure of our environmental and social performance, we aim to build trust and demonstrate our commitment to
                        responsible business practices.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; border-right: 1px solid #80FF00; padding-right: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Sustainable Packaging:</h5>
                    <p class="textToSpeak p-sustainability">We are committed to reducing the environmental impact of our packaging materials by prioritizing recyclable, compostable,
                        and biodegradable options. By redesigning packaging and implementing waste reduction strategies, we aim to minimize packaging
                        waste and promote a circular economy.
                    </p>
                </div>
                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="flex-wrap: wrap; padding-left: 25px; padding-top: 20px;">
                    <h5 class="textToSpeak">Sustainable Packaging:</h5>
                    <p class="textToSpeak p-sustainability">We are committed to reducing the environmental impact of our packaging materials by prioritizing recyclable, compostable,
                        and biodegradable options. By redesigning packaging and implementing waste reduction strategies, we aim to minimize packaging
                        waste and promote a circular economy.
                    </p>
                </div>
            </div>

            <h2 class="title textToSpeak">Our Impact:</h2>
            <p class="textToSpeak" style="font-size: 18px; color: #0B1C3F; text-align: justify">
                By embracing green energy practices, we are proud to play a part in combating climate change and building a more sustainable world.
                Through our initiatives, we aim to inspire others to join us in the transition towards a cleaner, greener energy future.
                <br><br>
                EcoResource is dedicated to making a difference through sustainable energy. Join us in our mission to build a cleaner, greener future
                for all.
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