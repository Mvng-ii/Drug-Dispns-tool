<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Home page/cl.css">
    <title>Home Page</title>
    <style>
        /* Add the below-the-fold styles here */
        .below-the-fold {
            background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)), url(https://c0.wallpaperflare.com/preview/839/207/808/capsule-cure-dosage-dose.jpg);
            background-size: cover;
            background-position: center;
            padding: 30px;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .below-the-fold h2 {
            font-size: 40px;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .testimonial-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .testimonial {
            flex: 1;
            font-size: 18px;
            line-height: 1.5;
            padding: 10px;
            border-radius: 10px;
        }

        .social-links {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
        }

        .social-links a {
            display: inline-block;
            margin-right: 15px;
        }

        .social-links img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
            padding: 5px;
            transition: transform 0.3s ease-in-out;
        }

        .social-links img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <!-- Code number 1: Banner and Content Section -->
    <div class="banner">
        <div class="navbar">
            <img src="logo.png" class="logo">
            <ul>
                <li><a href="#banner">Home</a></li>
                <li><a href="#below-the-fold">About Us</a></li>
                <li><a href="#below-the-fold">Contact Us</a></li>
                <!-- Redirect to register.php when Sign Up is clicked -->
                <li><a href="signup.php">Sign Up</a></li>
                <!-- Redirect to homep.php when Login is clicked -->
                <li><a href="homep.php">Login</a></li>
            </ul>
        </div>

        <div class="content" id="banner">
            <h1>GET YOUR MEDICATION TODAY</h1>
            <p>Your <b>Health Matters</b> to us.<br> We offer efficient and effective services to get you back on your feet in no time!</p>
            <div>
                <!-- Redirect to register.php when Sign Up is clicked -->
                <a href="signup.php"><button type="button"><span></span>Sign Up</button></a>
                <!-- Redirect to homep.php when Login is clicked -->
                <a href="homep.php"><button type="button"><span></span>Login</button></a>
            </div>
        </div>
    </div>

    <!-- Code number 2: Below-the-fold Section -->
    <div class="below-the-fold" id="below-the-fold">
        <h3>What do people have to say?...</h3>
        <div class="testimonial">
            <p>They sure are effective! I had a challenge accessing my medicine and keeping track.<br> Howeve, due to their website. I can.<br><b>Johann</b></p>
        </div>
        <div class="testimonial">
            <p>Keeping tabs on my medicine intake and when to go back can be a challenge, especially to busy people. <br>But with dispns.co, keeping tabs has just been made a lot easier.<br><b>Larry</b></p>
        </div>
        <div class="testimonial">
            <p>My son may be clumsy at times and misplace his medicine. <br>Dispns.co have offered an efficient way to get a refill.<br><b>Nancy</b></p>
        </div>
        <div class="social-links">
            <!-- Add your social platform links here -->
            <a href="whatsapp-link"><img src="wa.png" alt="WhatsApp"></a>
            <a href="instagram-link"><img src="in.png" alt="Instagram"></a>
            <a href="facebook-link"><img src="fb.png" alt="Facebook"></a>
            <a href="twitter-link"><img src="tw.png" alt="Twitter"></a>
        </div>
    </div>
</body>
</html>
