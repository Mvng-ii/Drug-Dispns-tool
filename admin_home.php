<?php 
   session_start();

   include("php/config.php");

   if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit(); // Add this to prevent further execution if the user is not logged in
 }

 if (isset($_SESSION['Id'])) {
      $patientID = $_SESSION['Id'];

      // Make sure to sanitize the input to prevent SQL injection (not shown in this example)
      $query = mysqli_query($con, "SELECT * FROM admin WHERE Id='$id'");

      if ($result = mysqli_fetch_assoc($query)) {
         $res_Uname = $result['Name'];
         $res_Email = $result['Email'];
         $res_id = $result['Id'];
      }
   }


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
    <style>
        /* Add the new styles here */
        .tabs-container {
            display: flex;
            justify-content: space-around;
            background-color: #fff;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 2px solid transparent;
            transition: border-bottom-color 0.3s;
        }

        .tab.active {
            border-bottom-color: #4c44b6; /* Active tab color */
        }

        .user-table {
            display: none;
        }

        .user-table.active {
            display: block;
        }
    </style>
    <title>Users List</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>
        <div class="right-links">
            <?php
            if(isset($_SESSION['Id'])){
                echo "<a href='edit.php?Id=$res_id'>Update Profile</a>";
            }
            ?>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <main>
        <div class="main-box top">
            <h2>Users List</h2>

            <!-- Tabs container -->
            <div class="tabs-container">
                <!-- Add onclick events to switch tabs -->
                <div class="tab active" onclick="showTab('patients-table')">Patients</div>
                <div class="tab" onclick="showTab('doctors-table')">Doctors</div>
                <div class="tab" onclick="showTab('pharmacists-table')">Pharmacists</div>
            </div>

            <!-- User tables -->
            <div class="user-table active" id="patients-table">
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
                            <td><?php echo $patient['Doc_Name']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="user-table" id="doctors-table">
                <h3>Doctors</h3>
                <table>
                    <tr>
                        <th>Doctor_ID</th>
                        <th>Name</th>
                        <th>SSN</th>
                        <th>Specialization</th>
                        <th>Experience</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Drug_Prescription</th>
                        <th>Dosage</th>
                    </tr>
                    <?php foreach($doctors as $doctor) : ?>
                        <tr>
                            <td><?php echo $doctor['Id']; ?></td>
                            <td><?php echo $doctor['Name']; ?></td>
                            <td><?php echo $doctor['SSN']; ?></td>
                            <td><?php echo $doctor['Specialization']; ?></td>
                            <td><?php echo $doctor['Experience']; ?></td>
                            <td><?php echo $doctor['Email']; ?></td>
                            <td><?php echo $doctor['Password']; ?></td>
                            <td><?php echo $doctor['Drug_Prescription']; ?></td>
                            <td><?php echo $doctor['Dosage']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="user-table" id="pharmacists-table">
                <h3>Pharmacists</h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>SSN</th>
                        <th>Age</th>
                        <th>Password</th>
                    </tr>
                    <?php foreach($pharmacists as $pharmacist) : ?>
                        <tr>
                            <td><?php echo $pharmacist['Name']; ?></td>
                            <td><?php echo $pharmacist['Email']; ?></td>
                            <td><?php echo $pharmacist['SSN']; ?></td>
                            <td><?php echo $pharmacist['Age']; ?></td>
                            <td><?php echo $pharmacist['Password']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </main>

    <!-- JavaScript to handle tab switching -->
    <script>
        // Initialize the first tab and user table as active
        document.addEventListener("DOMContentLoaded", function () {
            showTab('patients-table');
        });

        function showTab(tabName) {
            const tabs = document.querySelectorAll('.tab');
            const userTables = document.querySelectorAll('.user-table');

            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            userTables.forEach(table => {
                table.classList.remove('active');
            });

            const selectedTab = document.querySelector(`[onclick="showTab('${tabName}')"]`);
            selectedTab.classList.add('active');

            const selectedUserTable = document.querySelector(`#${tabName}`);
            selectedUserTable.classList.add('active');
        }
    </script>
</body>
</html>
