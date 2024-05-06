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
    <div class="bg-about-us">
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
        <div class="hero">
            <div class="container" style="height: 567px; display: flex; justify-content: center; align-items: center;">
                <div class="hero-main-block" style="max-width: 600px; text-align: center">
                    <h2 class="textToSpeak title">Discover EcoResource: your gateway to a sustainable future.</h2>
                    <p class="textToSpeak" style="text-align: center; color: #0B1C3F; font-size: 17px;">Our platform empowers businesses to make
                        eco-conscious decisions and compete for environmental excellence. With our green calculator,
                        educational resources, and community engagement, together, we can create a cleaner, more responsible world.
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
    <div class="main">
        <div class="container">
            <div class="block">
                <h2 class="title textToSpeak">About Us</h2>

                <div class="ultra-container">
                    <p class="textToSpeak" style="font-size: 18px; color: #0B1C3F; text-align: justify;">
                        EcoResource is not just an initiative; it's a comprehensive and transformative system designed to engage companies in sustainability and nature conservation. Our primary goal is to enhance environmental responsibility for businesses and end consumers alike. We've created an integrated platform that plays a pivotal role in reducing environmental impact, promoting sustainable resource usage, and fostering a society inherently conscious of its ecological footprint.
                        <br><br>
                        Tailored specifically for corporate entities, EcoResource offers a unique opportunity for registered organizations to participate in a sustainability competition. This competition evaluates various activities such as material processing, the use of green energy, waste collection, systematic material sorting, and other practices significantly impacting the environment.
                        <br><br>
                        Once registered and with detailed activity information compiled, each participating company receives a rating using our green calculator. This tool calculates green points based on the volume and type of processed materials, creating a system that encourages sustainability and fosters healthy competition among participants.
                        <br><br>
                        But EcoResource is more than just rewards and recognition. We provide an extensive array of educational resources aimed at raising awareness of sustainable consumption habits and advanced waste management methods. Users have the opportunity to deepen their understanding of ecological issues through informational articles, videos, and interactive modules, contributing to the formation of eco-friendly behavioral models.
                        <br><br>
                        Serving as the central hub for community interaction, EcoResource becomes the epicenter for discussions, events, and initiatives related to environmental sustainability. Through active participation and collective efforts, users become integral contributors to our common mission: creating a cleaner and more responsible future for society.
                        <br><br>
                        EcoResource aspires to be more than just a waste management application; it aims to be a powerful catalyst for positive change, inspiring both individuals and businesses to embrace environmentally conscious practices and chart a course towards a greener and more sustainable future. Join us in this journey towards a better tomorrow!
                    </p>

                    <h2 class="title textToSpeak">Our goals</h2>
                    <p class="textToSpeak" style="font-size: 18px; color: #0B1C3F; text-align: justify;">
                        At EcoResource, our mission is deeply aligned with <a href="https://en.unesco.org/themes/education/sdgs/material">UNESCO's Sustainable Development Goals (SDGs)</a>.
                        By promoting education, environmental responsibility, and sustainable practices, we contribute to a cleaner,
                        healthier planet. Through partnerships and initiatives, we strive to advance SDGs such as quality education,
                        clean water and sanitation, sustainable cities and communities, responsible consumption and production,
                        and climate action. Join us in achieving these vital global objectives and building a better future for all.
                    </p>

                    <div class="goals-slider slider" style="margin-top: 35px">
                        <div class="card" style="width: 18rem;">
                            <div style="background-image: url('images/man-sitting-begging-overpass.jpg'); background-size: cover; height: 180px" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">No Poverty</h5>
                                <p class="card-text">Resources aimed at understanding and addressing poverty issues globally, including educational materials and initiatives focused on poverty eradication.</p>
                                <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div style="background-image: url('images/begging-bridge-with-person-who-handed-bread.jpg'); background-size: cover; height: 180px" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Zero Hunger</h5>
                                <p class="card-text">Materials promoting food security, sustainable agriculture, and initiatives working towards eliminating hunger and malnutrition worldwide.</p>
                                <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div style="background-image: url('images/young-happy-woman-with-backpack-raising-hand-enjoy-with-nature.jpg'); background-size: cover; height: 180px" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Good Health and Well-Being</h5>
                                <p class="card-text">Resources focusing on health education, disease prevention, and mental well-being, contributing to healthier communities.</p>
                                <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div style="background-image: url('images/young-woman-studying-library.jpg'); background-size: cover; height: 180px" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Quality Education</h5>
                                <p class="card-text">Materials supporting inclusive and equitable education for all, fostering lifelong learning opportunities and enhancing educational outcomes.</p>
                                <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div style="background-image: url('images/multiracial-group-young-people-taking-selfie.jpg'); background-size: cover; height: 180px" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Gender Equality</h5>
                                <p class="card-text">Resources advocating for gender equality, empowering individuals of all genders and promoting equal rights and opportunities.</p>
                                <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div style="background-image: url('images/unrecognizable-ecologist-standing-where-sewage-waste-water-meets-river-taking-samples-determine-level-contamination-pollution.jpg'); background-size: cover; height: 180px" class="card-img-top")">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Clean Water and Sanitation</h5>
                            <p class="card-text">Initiatives promoting access to clean water and sanitation facilities, raising awareness about water conservation and hygiene practices.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/pexels-ricky-esquivel-3877663.jpg'); background-size: cover; height: 180px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Affordable and Clean Energy</h5>
                            <p class="card-text">Materials promoting renewable energy sources, energy efficiency, and initiatives working towards affordable and sustainable energy solutions.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/graph-drawn-glass-blurred-business-people.jpg'); background-size: cover; height: 180px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Decent Work and Economic Growth</h5>
                            <p class="card-text">Resources supporting job creation, entrepreneurship, and sustainable economic development, promoting decent work opportunities for all.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/person-using-ai-tool-job.jpg'); background-size: cover; height: 180px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Industry, Innovation and Infrastructure</h5>
                            <p class="card-text">Initiatives fostering innovation, sustainable industrialization, and infrastructure development, contributing to economic growth and prosperity.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/community-young-people-posing-together.jpg'); background-size: cover; height: 180px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Reduced Inequalities</h5>
                            <p class="card-text">Materials addressing social inclusion, diversity, and combating discrimination, promoting equality and reducing inequalities within societies.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/researchers-looking-alternative-energy-souces.jpg'); background-size: cover; height: 180px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sustainable Cities and Communities</h5>
                            <p class="card-text">Resources promoting sustainable urban development, resilient infrastructure, and inclusive communities for a better quality of life.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/woman-recycling-vegetable-leftovers.jpg'); background-size: cover; height: 180px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Responsible Consumption</h5>
                            <p class="card-text">Initiatives promoting sustainable consumption patterns, waste reduction, and responsible production methods to minimize environmental impact.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/pexels-pixabay-219837.jpg'); background-size: cover; height: 180px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Climate Action</h5>
                            <p class="card-text">Materials advocating for climate change mitigation, adaptation strategies, and initiatives addressing environmental conservation and sustainability.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/coral-fish-around-sha-ab-mahmud.jpg'); background-size: cover; height: 180px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Life Below Water</h5>
                            <p class="card-text">Resources focusing on marine conservation, ocean biodiversity, and initiatives aimed at protecting marine ecosystems and aquatic life.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/beautiful-green-tree-leaf-forest-with-sun.jpg'); background-size: cover; height: 180px" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Life On Land</h5>
                            <p class="card-text">Materials supporting land conservation, biodiversity preservation, and sustainable land management practices for a thriving ecosystem.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/group-activists-marching-peace.jpg'); background-size: cover; height: 180px;" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Peace, Justice and Strong Institutions</h5>
                            <p class="card-text">Initiatives promoting peacebuilding, access to justice, and strong institutional frameworks for sustainable development and societal harmony.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div style="background-image: url('images/colleagues-giving-high-five.jpg'); background-size: cover; height: 180px;" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Partnerships For The Goals</h5>
                            <p class="card-text">Resources advocating for global partnerships, collaboration, and collective action to achieve the Sustainable Development Goals (SDGs) for a better future.</p>
                            <a href="https://www.unesco.org/en/sustainable-development" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ultra-container">
                <div class="block">
                    <h2 class="title textToSpeak">Our Partners</h2>
                    <div class="row row-medium" style="justify-content: center;">
                        <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="display: block;  margin-bottom: 25px;">
                            <img src="./images/Logo_Edinburgh_college.png" alt="" style="width: 80%;">
                            <p class="textToSpeak" style="margin-top: 15px">Edinburgh College is more than an institution of learning; we're agents of change, committed to fostering
                                a sustainable future for all. Through innovative education and community engagement, we're cultivating a
                                culture of environmental stewardship and responsibility.
                                <br><br>
                                Step into our world of sustainability where every action, every decision, contributes to a greener, more
                                equitable tomorrow. Join us as we pave the way for generations to come.
                            </p>

                            <a href="https://www.edinburghcollege.ac.uk/about-us/corporate-and-governance/sustainability" style="font-size: 18px">Read in detail</a>
                        </div>
                        <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="display: block">
                            <img src="./images/Logo_UNESCO_2021.svg.png" alt="" style="width: 100%">
                            <p class="textToSpeak" style="margin-top: 15px">UNESCO stands as a beacon of hope, advocating for sustainable development and global unity. Our initiatives
                                span continents, addressing pressing environmental challenges and championing cultural diversity.
                                <br><br>
                                Join us in our mission to preserve our planet's rich heritage and ensure a sustainable future for all.
                                Together, we can create lasting change and build a world where every voice is heard, and every ecosystem
                                protected.
                            </p>

                            <a href="https://www.unesco.org/en/sustainable-development/education" style="font-size: 18px">Read in detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block">
                <h2 class="title">Leave feedback</h2>

                <?php
                // Check if form is submitted
                if(isset($_POST["submit"])) {
                    // Retrieve form data
                    $name = $_POST["name"];
                    $feedback = $_POST["feedback"];
                    $user_id = $_SESSION["user"]["id"];

                    // Set default name if empty
                    if (empty($name)) {
                        $name = "Anonymous";
                    }

                    // Validate feedback
                    $errors = array();
                    if (empty($feedback)) {
                        $errors[] = "The comment field must not be empty.";
                    }

                    // Check for database connection and handle errors
                    require_once "database.php"; // Ensure that database.php contains the correct database connection information

                    if ($conn === false) {
                        die("Error: Could not connect. " . mysqli_connect_error());
                    }

                    // Insert feedback into database
                    if (empty($errors)) {
                        $sql = "INSERT INTO feedback (user_id, name, feedback) VALUES (?,?,?)";
                        $stmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, "sss", $user_id, $name, $feedback);
                            mysqli_stmt_execute($stmt);

                            echo "<div class='alert alert-success' style=\"max-width: 800px; margin: 0 auto;\">Your feedback has been sent successfully.</div>";
                        } else {
                            echo "<div class='alert alert-danger' style=\"max-width: 800px; margin: 0 auto;\">Error: Could not execute query.</div>";
                        }
                    } else {
                        // Display errors
                        foreach ($errors as $error) {
                            echo "<div class='alert alert-danger' style=\"max-width: 800px; margin: 0 auto;\">$error</div>";
                        }
                    }
                }
                ?>
                <form action="" method="post" style="max-width: 800px; margin: 0 auto; margin-top: 15px">
                    <div class="mb-3" style="width: 100%;">
                        <label for="name" class="form-label text">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name..">
                    </div>
                    <div class="mb-3">
                        <label for="feedback" class="form-label">Your comment</label>
                        <textarea class="form-control" name="feedback" id="feedback" rows="3" style="height: 225px; border-color: #0B1C3F;" placeholder="Enter the text of the comment.."></textarea>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary shadow">Submit</button>
                </form>

                <div class="ultra-container">
                    <div class="feedback-slider slider" style="margin-top: 35px; width: 100%;">
                        <?php
                        // Database connection
                        require_once "database.php"; // Ensure this file contains database connection code

                        // Fetch feedback data from database
                        $sql = "SELECT name, feedback FROM feedback";
                        $result = mysqli_query($conn, $sql);

                        // Check if there are any feedbacks
                        if (mysqli_num_rows($result) > 0) {
                            // Display feedbacks
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='card mb-3'>";
                                echo "<div class='card-body'>";
                                echo "<div style='display: flex; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #80FF00; padding-bottom: 15px'>";
                                echo "<i class='fa-solid fa-circle-user' style='font-size: 40px; color: #80FF00; margin-right: 15px;'></i>";
                                echo "<h5 class='card-title' style='margin: 0'>" . htmlspecialchars($row['name']) . "</h5>";
                                echo "</div>";
                                echo "<p class='card-text'>" . htmlspecialchars($row['feedback']) . "</p>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div style='width: 100%;'><p class='alert alert-info' style='width: 100%;'>No feedbacks available.</p></div>";
                        }

                        // Close database connection
                        mysqli_close($conn);
                        ?>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script src="https://kit.fontawesome.com/813d54a682.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
    $(document).ready(function(){
        $('.goals-slider').slick({
            dots: true, // Add Dots to Bottom of Slide
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            adaptiveHeight: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        dots: true
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true
                    }
                }
            ]
        });
    });
    $(document).ready(function(){
        $('.feedback-slider').slick({
            dots: true, // Add Dots to Bottom of Slide
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            adaptiveHeight: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        dots: true
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true
                    }
                }
            ]
        });
    });
</script>
<script>
    // Function to set the maximum height of cards in the goals slider and set this height for all cards
    function setGoalsCardHeights() {
        var cards = document.querySelectorAll('.goals-slider .card');
        var maxHeight = 0;
        cards.forEach(function(card) {
            maxHeight = Math.max(maxHeight, card.offsetHeight);
        });
        cards.forEach(function(card) {
            card.style.height = maxHeight + 'px';
        });
    }

    // Function to set the maximum height of cards in the feedback slider and set this height for all cards
    function setFeedbackCardHeights() {
        var cards = document.querySelectorAll('.feedback-slider .card');
        var maxHeight = 0;
        cards.forEach(function(card) {
            maxHeight = Math.max(maxHeight, card.offsetHeight);
        });
        cards.forEach(function(card) {
            card.style.height = maxHeight + 'px';
        });
    }

    // Call the function to set card heights on page load
    window.addEventListener('load', function() {
        setGoalsCardHeights();
        setFeedbackCardHeights();
    });

    // Call the function to set card heights on window resize
    window.addEventListener('resize', function() {
        setGoalsCardHeights();
        setFeedbackCardHeights();
    });
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