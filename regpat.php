<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dgn.css">
    <title>Patient Registration</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
               include("php/config.php");
               if (isset($_POST['submit'])) {
                   $name = $_POST['name'];
                   $email = $_POST['email'];
                   $ssn = $_POST['ssn'];
                   $age = $_POST['age'];
                   $password = $_POST['password'];
                   $doctor_id = $_POST['Assigned_doctor'];

                   // Generate Patient_ID by counting existing rows and adding 1
                   $id = 'id';
                   $patient_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM patient"));
                   $patient_id = $patient_count + 1;

                   // Verify the unique email
                   $verify_query = mysqli_query($con, "SELECT Email FROM patient WHERE Email='$email'");
                   if (mysqli_num_rows($verify_query) != 0) {
                        echo "<div class='message'>
                                <p>This email is already in use. Please try again.</p>
                            </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                    } else {
                        // Insert data into the 'patient' table
                        mysqli_query($con, "INSERT INTO patient(Id, Name, Email, SSN, Age, Password, Assigned_doctor) VALUES ('$id', '$name', '$email', '$ssn', '$age', '$password', '$doctor_id')") or die(mysqli_error($con));

                        echo "<div class='message'>
                                <p>Patient registration successful!</p>
                            </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Login Now</button>";
                    }
                }
            ?>
            <header>Patient Registration</header>
            <form action="" method="post">

                <div class="field input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="ssn">SSN</label>
                    <input type="number" name="ssn" id="ssn" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field select">
                    <label for="doctor">Select Doctor</label>
                    <select name="doctor" id="doctor" required>
                        <!-- Fetch the list of doctors from the 'doctor' table and populate the dropdown options -->
                        <?php
                            $doctor_query = mysqli_query($con, "SELECT Id, Name FROM doctor");
                            while ($doctor_result = mysqli_fetch_assoc($doctor_query)) {
                                $doctor_id = $doctor_result['Id'];
                                $doctor_name = $doctor_result['Name'];
                                echo "<option value='$doctor_id'>$doctor_name</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Sign up" required>
                </div>

                <div class="links">
                    Already Have an Account? <a href="homep.php">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
