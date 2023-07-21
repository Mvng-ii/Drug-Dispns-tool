<?php
session_start();

// Database connection configuration
include("php/config.php");

$error_message = "";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query for the "patient" table
    $patient_result = mysqli_query($con, "SELECT * FROM patient WHERE Email='$email' AND Password='$password'");
    $patient_row = mysqli_fetch_assoc($patient_result);

    // Query for the "doctor" table
    $doctor_result = mysqli_query($con, "SELECT * FROM doctor WHERE Email='$email' AND Password='$password'");
    $doctor_row = mysqli_fetch_assoc($doctor_result);

    // Query for the "admin" table
    $admin_result = mysqli_query($con, "SELECT * FROM admin WHERE Email='$email' AND Password='$password'");
    $admin_row = mysqli_fetch_assoc($admin_result);

    // Query for the "pharmacist" table
    $pharmacist_result = mysqli_query($con, "SELECT * FROM pharmacist WHERE Email='$email' AND Password='$password'");
    $pharmacist_row = mysqli_fetch_assoc($pharmacist_result);

    if (is_array($patient_row) && !empty($patient_row)) {
        $_SESSION['valid'] = $patient_row['Email'];
        $_SESSION['name'] = $patient_row['Name'];
        $_SESSION['ssn'] = $patient_row['Ssn'];
        $_SESSION['age'] = $patient_row['Age'];
        $_SESSION['doctor'] = $patient_row['Doctor'];
        $_SESSION['physician'] = $patient_row['Physician'];
        $_SESSION['id'] = $patient_row['Id'];

        header("Location: home.php"); // Redirect to the home page after successful patient login
        exit();
    } elseif (is_array($doctor_row) && !empty($doctor_row)) {
        $_SESSION['valid'] = $doctor_row['Email'];
        $_SESSION['name'] = $doctor_row['Name'];
        $_SESSION['ssn'] = $doctor_row['SSN'];
        $_SESSION['specialization'] = $doctor_row['Specialization'];
        $_SESSION['experience'] = $doctor_row['Experience'];
        $_SESSION['patient'] = $doctor_row['Patient'];
        $_SESSION['drug_prescription'] = $doctor_row['Drug_Prescription'];
        $_SESSION['prescription'] = $doctor_row['Prescription'];
        $_SESSION['id'] = $doctor_row['Id'];

        header("Location: doctor_home.php"); // Redirect to the doctor home page after successful doctor login

    } elseif (is_array($admin_row) && !empty($admin_row)) {
        // Admin login
        $_SESSION['valid'] = $admin_row['Email'];
        $_SESSION['name'] = $admin_row['Name'];
        $_SESSION['id'] = $admin_row['Id'];

        header("Location: admin.php"); // Redirect to the admin home page after successful admin login
        exit();

    } elseif (is_array($pharmacist_row) && !empty($pharmacist_row)) {
        // Pharmacist login
        $_SESSION['valid'] = $pharmacist_row['Email'];
        $_SESSION['name'] = $pharmacist_row['Name'];
        $_SESSION['ssn'] = $pharmacist_row['SSN'];
        $_SESSION['age'] = $pharmacist_row['Age'];
        $_SESSION['id'] = $pharmacist_row['Email']; // Using Email as the ID for pharmacists

        header("Location: phar_home.php"); // Redirect to the pharmacist home page after successful pharmacist login
        exit();

    } else {
        $error_message = "Wrong Email or Password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dgn.css">
    <title>Login Form</title>
</head>    
<body>
    <div class="container">
        <div class="box form-box">
            <?php
            if (!empty($error_message)) {
                echo "<div class='message'>
                    <p>$error_message</p>
                </div> <br>";
            }
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign up Now</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
