<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dgn.css">
    <title>Register</title>
</head>
    <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }

            body {
                background: #e4e9f7 url(1.jpg);
            }

            .container {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 90vh;
            }

            .box {
                background: #fdfdfd;
                display: flex;
                flex-direction: column;
                padding: 25px 25px;
                border-radius: 20px;
                box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                            0 32px 64px -48px rgba(0, 0, 0, 0.5);
            }

            .form-box {
                width: 450px;
                margin: 0px 10px;
            }

            .form-box header {
                font-size: 25px;
                font-weight: 600;
                padding-bottom: 10px;
                border-bottom: 1px solid #e6e6e6;
                margin-bottom: 10px;
            }

            .form-box .field {
                display: flex;
                margin-bottom: 10px;
                flex-direction: column;
            }

            .form-box .field label {
                margin-bottom: 5px;
            }

            .form-box .field input[type="radio"] {
                margin-right: 5px;
                cursor: pointer;
            }

            .form-box .btn {
                height: 35px;
                background: rgba(76, 68, 182, 0.808);
                border: 0;
                border-radius: 5px;
                color: #fff;
                font-size: 15px;
                cursor: pointer;
                transition: all .3s;
                margin-top: 10px;
                padding: 0px 10px;
            }

            .form-box .btn:hover {
                opacity: 0.82;
            }

            .links {
                margin-bottom: 15px;
            }

            /* Additional styles for the tab design */
            .field {
                display: flex;
                align-items: center;
                margin-bottom: 15px;
            }

            .field label {
                margin-right: 10px;
            }

            .field input[type="radio"] {
                display: none;
            }

            .field input[type="radio"] + label {
                padding: 5px 10px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .field input[type="radio"] + label:hover {
                background-color: #f1f1f1;
            }

            .field input[type="radio"]:checked + label {
                background-color: #f1f1f1;
                color: #4c44b6;
            }

    </style>
    <body>
    <?php
    include("php/config.php");

    if (isset($_POST['submit'])) {
        $userType = $_POST['userType'];
        if ($userType === 'admin') {
            // Open a new tab for Admin registration form
            echo '<script>window.open("regadmin.php", "_blank");</script>';
        } elseif ($userType === 'doctor') {
            // Open a new tab for Doctor registration form
            echo '<script>window.open("regdoc.php", "_blank");</script>';
        } elseif ($userType === 'patient') {
            // Open a new tab for Patient registration form
            echo '<script>window.open("regpat.php", "_blank");</script>';
        } elseif ($userType === 'pharmacist') {
            // Open a new tab for Pharmacist registration form
            echo '<script>window.open("regphar.php", "_blank");</script>';
        } else {
            // Invalid user type selected, redirect back to register.php
            header("Location: register.php");
        }
    }
    ?>

    <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form action="" method="post">
                <!-- Add an option to choose between user types -->
                <div class="field">
                    <label for="userType">Register as:</label>
                    <input type="radio" name="userType" id="admin" value="admin" required>
                    <label for="admin">Admin</label>
                    <input type="radio" name="userType" id="doctor" value="doctor" required>
                    <label for="doctor">Doctor</label>
                    <input type="radio" name="userType" id="patient" value="patient" required>
                    <label for="patient">Patient</label>
                    <input type="radio" name="userType" id="pharmacist" value="pharmacist" required>
                    <label for="pharmacist">Pharmacist</label>
                </div>

                <!-- Add submit button -->
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Sign up" required>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>
