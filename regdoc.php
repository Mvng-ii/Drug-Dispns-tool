<!-- doctor_registration.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dgn.css">
    <title>Doctor Registration</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
               include("php/config.php");
               if (isset($_POST['submit'])) {
                   $name = $_POST['name'];
                   $ssn = $_POST['ssn'];
                   $specialization = $_POST['specialization'];
                   $experience = $_POST['experience'];
                   $email = $_POST['email'];
                   $password = $_POST['password'];

                   // Generate Doctor_ID by counting existing rows and adding 1
                   $doctor_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM doctor"));
                   $doctor_id = $doctor_count + 1;

                   // Verify the unique email
                   $verify_query = mysqli_query($con, "SELECT Email FROM doctor WHERE Email='$email'");
                   if (mysqli_num_rows($verify_query) != 0) {
                        echo "<div class='message'>
                                <p>This email is already in use. Please try again.</p>
                            </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                    } else {
                        // Insert data into the 'doctor' table
                        mysqli_query($con, "INSERT INTO doctor(Id, Name, SSN, Specialization, Experience, Email, Password) VALUES ('$id', '$name', '$ssn', '$specialization', '$experience', '$email', '$password')") or die(mysqli_error($con));

                        echo "<div class='message'>
                                <p>Doctor registration successful!</p>
                            </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Login Now</button>";
                    }
                }
            ?>
            <header>Doctor Registration</header>
            <form action="" method="post">

                <div class="field input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="ssn">SSN</label>
                    <input type="number" name="ssn" id="ssn" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="specialization">Specialization</label>
                    <input type="text" name="specialization" id="specialization" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="experience">Experience</label>
                    <input type="number" name="experience" id="experience" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
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
