<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dgn.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a> </p>
        </div>

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM doctor WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Name'];
                $res_SSN = $result['SSN'];
                $res_Specialization = $result['Specialization'];
                $res_Experience = $result['Experience'];
                $res_Email = $result['Email'];
                $res_Drug_prescription = $result['Drug_Prescription'];
                $res_Patient = $result['Patient'];
                $res_id = $result['Id'];
            }
            
            echo "<a href='edit.php?Id=$res_id'>Update Profile</a>";
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b>Dr.<?php echo $res_Uname ?></b>, Welcome.</p>
                </div>
            </div>
            <div class="bottom">
                <?php 
                // Fetch the list of patients assigned to the doctor
                $doctor_id = 'id';
                $doctor_id = $_SESSION['id'];
                $patient_query = mysqli_query($con, "SELECT * FROM patient WHERE Assigned_doctor=$doctor_id");
                $doctor_id = $_SESSION['id'];
                $patient_query = mysqli_query($con, "SELECT * FROM patient WHERE Assigned_doctor=$doctor_id");

                // Check if there are any patients assigned to the doctor
                if (mysqli_num_rows($patient_query) > 0) {
                    while ($patient_result = mysqli_fetch_assoc($patient_query)) {
                        $patient_id = $patient_result['Id'];
                        $patient_name = $patient_result['Name'];
                        $prescription = $patient_result['Prescription'];

                        // Display patient's name with a link to view their details
                        echo "<p><a href='patient_deets.php?id=$patient_id'>$patient_name</a></p>";
                    }
                } else {
                    // If no patients are assigned, display a message
                    echo "<p>No patients assigned yet.</p>";
                }
                ?>
            </div>
        </div>
    </main>
</body>
</html>