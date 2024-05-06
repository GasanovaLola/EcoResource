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

    <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick/slick-theme.css"/>

    <link rel="stylesheet" href="./style/main.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <div class="bg">
            <header>
                <div class="container">
                    <div class="top-header">
                        <div class="logo" style="display: flex;">
                            <img src="./images/plant-care_12779251.png" style="width: 50px;" alt="">
                            <p>EcoResource</p>
                        </div>
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
                    <div class="hero-main-block" style="max-width: 600px;">
                        <h1 class="title">Convert waste into opportunities with EcoResource</h1>
                        <p style="text-align: center; color: #f2f2f2; font-size: 17px;">EcoResource is an innovative platform that connects recyclers and caring 
                            consumers in pursuit of a sustainable future. Registered businesses track 
                            and record their recyclables, earning points that can be redeemed for rewards. 
                            Home users, in turn, earn points for properly sorting their waste and engaging 
                            with our partners. <br><br>
            
                            Join EcoResource and together we will create a clean and responsible future for 
                            our planet!
                        </p>
                        <div class="hero-buttons">
                            <div class="row row-medium" style="justify-content: center;">
                                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="justify-content: center;">
                                    <a href="about_us.php" style="width: 100%"><button type="button" class="btn btn-primary shadow" style="width: 100%;">Read More</button></a>
                                </div>
                                <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="justify-content: center;">
                                    <a href="registration.php" style="width: 100%"><button type="button" class="btn btn-primary shadow" style="width: 100%;">Join</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="arrow">
                            <i class="fa-solid fa-angles-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="container">
                <div class="block">
                    <div class="ultra-container">
                        <a style="text-transform: none; text-decoration: none;"  href="about_us.php"><h2 class="title">Our goals</h2></a>
                        <p style="font-size: 18px; color: #0B1C3F; text-align: justify;">
                            At EcoResource, our mission is deeply aligned with <a href="https://en.unesco.org/themes/education/sdgs/material">UNESCO's Sustainable Development Goals (SDGs)</a>.
                            By promoting education, environmental responsibility, and sustainable practices, we contribute to a cleaner,
                            healthier planet. Through partnerships and initiatives, we strive to advance SDGs such as quality education,
                            clean water and sanitation, sustainable cities and communities, responsible consumption and production,
                            and climate action. Join us in achieving these vital global objectives and building a better future for all.
                        </p>

                        <div class="goals-slider slider" style="margin-top: 35px">
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/man-sitting-begging-overpass.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">No Poverty</h5>
                                    <p class="card-text">Resources aimed at understanding and addressing poverty issues globally, including educational materials and initiatives focused on poverty eradication.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/begging-bridge-with-person-who-handed-bread.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Zero Hunger</h5>
                                    <p class="card-text">Materials promoting food security, sustainable agriculture, and initiatives working towards eliminating hunger and malnutrition worldwide.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/young-happy-woman-with-backpack-raising-hand-enjoy-with-nature.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Good Health and Well-Being</h5>
                                    <p class="card-text">Resources focusing on health education, disease prevention, and mental well-being, contributing to healthier communities.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/young-woman-studying-library.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Quality Education</h5>
                                    <p class="card-text">Materials supporting inclusive and equitable education for all, fostering lifelong learning opportunities and enhancing educational outcomes.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/multiracial-group-young-people-taking-selfie.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Gender Equality</h5>
                                    <p class="card-text">Resources advocating for gender equality, empowering individuals of all genders and promoting equal rights and opportunities.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/unrecognizable-ecologist-standing-where-sewage-waste-water-meets-river-taking-samples-determine-level-contamination-pollution.jpg'); background-size: cover; height: 180px" class="card-img-top")">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Clean Water and Sanitation</h5>
                                    <p class="card-text">Initiatives promoting access to clean water and sanitation facilities, raising awareness about water conservation and hygiene practices.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/pexels-ricky-esquivel-3877663.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Affordable and Clean Energy</h5>
                                    <p class="card-text">Materials promoting renewable energy sources, energy efficiency, and initiatives working towards affordable and sustainable energy solutions.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/graph-drawn-glass-blurred-business-people.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Decent Work and Economic Growth</h5>
                                    <p class="card-text">Resources supporting job creation, entrepreneurship, and sustainable economic development, promoting decent work opportunities for all.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/person-using-ai-tool-job.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Industry, Innovation and Infrastructure</h5>
                                    <p class="card-text">Initiatives fostering innovation, sustainable industrialization, and infrastructure development, contributing to economic growth and prosperity.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/community-young-people-posing-together.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Reduced Inequalities</h5>
                                    <p class="card-text">Materials addressing social inclusion, diversity, and combating discrimination, promoting equality and reducing inequalities within societies.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/researchers-looking-alternative-energy-souces.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Sustainable Cities and Communities</h5>
                                    <p class="card-text">Resources promoting sustainable urban development, resilient infrastructure, and inclusive communities for a better quality of life.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/woman-recycling-vegetable-leftovers.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Responsible Consumption</h5>
                                    <p class="card-text">Initiatives promoting sustainable consumption patterns, waste reduction, and responsible production methods to minimize environmental impact.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/pexels-pixabay-219837.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Climate Action</h5>
                                    <p class="card-text">Materials advocating for climate change mitigation, adaptation strategies, and initiatives addressing environmental conservation and sustainability.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/coral-fish-around-sha-ab-mahmud.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Life Below Water</h5>
                                    <p class="card-text">Resources focusing on marine conservation, ocean biodiversity, and initiatives aimed at protecting marine ecosystems and aquatic life.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/beautiful-green-tree-leaf-forest-with-sun.jpg'); background-size: cover; height: 180px" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Life On Land</h5>
                                    <p class="card-text">Materials supporting land conservation, biodiversity preservation, and sustainable land management practices for a thriving ecosystem.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/group-activists-marching-peace.jpg'); background-size: cover; height: 180px;" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Peace, Justice and Strong Institutions</h5>
                                    <p class="card-text">Initiatives promoting peacebuilding, access to justice, and strong institutional frameworks for sustainable development and societal harmony.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                            <div class="card" style="width: 17rem;">
                                <div style="background-image: url('images/colleagues-giving-high-five.jpg'); background-size: cover; height: 180px;" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Partnerships For The Goals</h5>
                                    <p class="card-text">Resources advocating for global partnerships, collaboration, and collective action to achieve the Sustainable Development Goals (SDGs) for a better future.</p>
                                    <a href="about_us.php" class="btn btn-outline-primary" style="width: 100%">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block">
                    <a style="text-transform: none; text-decoration: none;" href="about_us.php"><h2 class="title">Our Work</h2></a>
                    <div class="cards" style="display: flex; justify-content: space-evenly;">
                        <div class="row row-medium" style="justify-content: center;">
                            <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="justify-content: center;">
                                <div class="card" style="width: 25rem; border-color: transparent">
                                    <div class="card-body">
                                        <p class="text" style="font-size: 16px; color: #0B1C3F; text-align: justify;">
                                            Explore the impactful projects and initiatives we undertake to 
                                            make a positive difference. Dive into our commitment to sustainability, 
                                            innovation, and meaningful change.
                                        </p>
                                        <div class="bg-image" style="background-image: url(./images/pexels-pixabay-414837.jpg); background-size: cover; height: 208px; border-radius: 12px; margin-bottom: 15px;"></div>
                                        <a href="about_us.php"><button type="button" class="btn btn-primary shadow">Read More</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="border-left: 1px solid #80FF00; justify-content: center;">
                                <div class="card" style="width: 25rem; border-color: transparent">
                                    <div class="card-body">
                                        <p class="text" style="font-size: 16px; color: #0B1C3F; text-align: justify;">
                                            Visualize our journey through a collection of vibrant images 
                                            showcasing key moments, events, and the visual essence of our 
                                            mission. See the visual story behind our impactful work.
                                        </p>
                                        <div class="bg-image" style="background-image: url(./images/solar-panels-944002_1280.jpg); background-size: cover; height: 208px; border-radius: 12px; margin-bottom: 15px;"></div>
                                        <a href="about_us.php"><button type="button" class="btn btn-primary shadow">Read More</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block">
                    <a style="text-transform: none; text-decoration: none;"  href="membership.php"><h2 class="title">Membership</h2></a>
                    <div class="cards" style="display: flex; justify-content: space-evenly;">
                        <div class="row row-medium" style="justify-content: center;">
                            <div class="column width-1-4-lg width-1-3-md width-1-1-sm" style="justify-content: center;">
                                <div class="card" style="border-color: transparent">
                                    <div class="card-body" style="text-align: center;">
                                        <a href="membership.php"><h5 class="sub-title">Membership Benefits</h5></a>
                                        <div class="design-circle">
                                            <i class="fa-solid fa-award"></i>
                                        </div>
                                        <p class="text">
                                            Unlock exclusive privileges, resources, and unique opportunities by joining us.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="column width-1-4-lg width-1-3-md width-1-1-sm" style="justify-content: center;">
                                <div class="card" style="border-color: transparent">
                                    <div class="card-body" style="text-align: center;">
                                        <a href="membership.php"><h5 class="sub-title">How to Become a Member</h5></a>
                                        <div class="design-circle">
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                        <p class="text">
                                            Explore a simple process to join our community and contribute to our shared goals.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="column width-1-4-lg width-1-3-md width-1-1-sm" style="justify-content: center;">
                                <div class="card" style="border-color: transparent">
                                    <div class="card-body" style="text-align: center;">
                                        <a href="membership.php"><h5 class="sub-title">Events for Members</h5></a>
                                        <div class="design-circle">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                        <p class="text">
                                            Enjoy exclusive gatherings and activities designed to enhance your membership experience.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ultra-container">
                    <div class="block" style="display: flex; justify-content: center; align-items: center;">
                        <div class="block-content" style="text-align: center; border-top: 1px solid #80FF00; border-bottom: 1px solid #80FF00; padding-bottom: 45px;">
                            <a style="text-transform: none; text-decoration: none;" href="sustainability.php"><h2 class="title">Sustainability</h2></a>
                            <p class="text" style="font-size: 18px; color: #0B1C3F; text-align: justify;">Welcome to our commitment to a greener future. At EcoResource, sustainability
                                is more than a goal – it's a way of life. Explore our initiatives that promote
                                eco-friendly practices, support environmental stewardship, and contribute to a
                                world where every choice makes a positive impact. Join us on this journey towards
                                a sustainable tomorrow. Together, let's make a lasting difference.
                            </p>
                            <a href="sustainability.php" style="font-size: 18px">read more</a>
                        </div>
                    </div>
                </div>

                <div class="ultra-container">
                    <h2 class="title">Our Partners</h2>
                    <div class="row row-medium" style="justify-content: center; align-items: center;">
                        <div class="column width-1-2-lg width-1-2-md width-1-1-sm" style="display: block;  margin-bottom: 25px;">
                            <img src="./images/Logo_Edinburgh_college.png" alt="" style="width: 80%;">
                            <p style="margin-top: 15px">Edinburgh College is more than an institution of learning; we're agents of change, committed to fostering
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
                            <p style="margin-top: 15px">UNESCO stands as a beacon of hope, advocating for sustainable development and global unity. Our initiatives
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

                <div class="block">
                    <a style="text-transform: none; text-decoration: none;"  href="support.php"><h2 class="title">Got a Question?</h2></a>

                    <form action="send-email.php" method="post" style="max-width: 800px; margin: 0 auto;">
                        <div class="row row-medium" style="justify-content: center;">
                            <div class="column width-1-2-lg width-1-2-md width-1-1-sm">      
                            <!--<div class="" style="display: flex; justify-content: space-between;">-->
                                <div class="mb-3" style="width: 100%;">
                                    <label for="name" class="form-label text">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name..">
                                </div>
                            </div>
                            <div class="column width-1-2-lg width-1-2-md width-1-1-sm">
                                <div class="mb-3" style="width: 100%;">
                                    <label for="email" class="form-label text">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"  placeholder="Enter your email..">
                                    <div id="emailHelp" class="form-text" style="font-size: 14px; color: #6c757d;">We'll never share your email with anyone else.</div>
                                </div>
                            <!--</div>-->
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Title</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter the title of the email..">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">What is your question?</label>
                            <textarea class="form-control" name="message" id="message" rows="3" style="height: 225px; border-color: #0B1C3F;" placeholder="Enter the text of the letter.."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary shadow">Submit</button>
                    </form>
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
        // Определение максимальной высоты карточек в слайдере и установка этой высоты для всех карточек
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

        // Вызов функции для установки высоты карточек при загрузке страницы
        window.addEventListener('load', setGoalsCardHeights);
        window.addEventListener('load', setFeedbackCardHeights);

        // Вызов функции для установки высоты карточек при изменении размеров окна
        window.addEventListener('resize', setGoalsCardHeights);
        window.addEventListener('resize', setFeedbackCardHeights);
    </script>
</body>
</html>