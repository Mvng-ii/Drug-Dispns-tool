<?php 
   session_start();

   // Make sure the user is logged in as an administrator.
   if(!isset($_SESSION['valid']) || $_SESSION['role'] !== 'admin'){
    header("Location: admin_home.php");
   }

   include("php/config.php");

   // Function to get user data based on role and get this sorted
   function getUserData($table, $id) {
       global $con;
       $query = mysqli_query($con, "SELECT * FROM $table WHERE Id=$id");
       return mysqli_fetch_assoc($query);
   }

   // Fetch patient data
   $patients = array();
   $patientQuery = mysqli_query($con, "SELECT * FROM patient");
   while($patientData = mysqli_fetch_assoc($patientQuery)){
       $patients[] = $patientData;
   }

   // Fetch doctor data
   $doctors = array();
   $doctorQuery = mysqli_query($con, "SELECT * FROM doctor");
   while($doctorData = mysqli_fetch_assoc($doctorQuery)){
       $doctors[] = $doctorData;
   }

   // Fetch pharmacist data
   $pharmacists = array();
   $pharmacistQuery = mysqli_query($con, "SELECT * FROM pharmacist");
   while($pharmacistData = mysqli_fetch_assoc($pharmacistQuery)){
       $pharmacists[] = $pharmacistData;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dgn.css">
    <title>Users List</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>
        <div class="right-links">
            <a href="php/logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <main>
        <div class="main-box top">
            <h2>Users List</h2>

            <div class="user-table">
                <h3>Patients</h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>SSN</th>
                        <th>Age</th>
                        <th>Physician</th>
                        <th>Doctor</th>
                    </tr>
                    <?php foreach($patients as $patient) : ?>
                        <tr>
                            <td><?php echo $patient['Name']; ?></td>
                            <td><?php echo $patient['Email']; ?></td>
                            <td><?php echo $patient['Ssn']; ?></td>
                            <td><?php echo $patient['Age']; ?></td>
                            <td><?php echo $patient['Physician']; ?></td>
                            <td><?php echo $patient['Doctor']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="user-table">
                <h3>Doctors</h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Specialty</th>
                    </tr>
                    <?php foreach($doctors as $doctor) : ?>
                        <tr>
                            <td><?php echo $doctor['Name']; ?></td>
                            <td><?php echo $doctor['Email']; ?></td>
                            <td><?php echo $doctor['Specialty']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="user-table">
                <h3>Pharmacists</h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>License Number</th>
                    </tr>
                    <?php foreach($pharmacists as $pharmacist) : ?>
                        <tr>
                            <td><?php echo $pharmacist['Name']; ?></td>
                            <td><?php echo $pharmacist['Email']; ?></td>
                            <td><?php echo $pharmacist['LicenseNumber']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
