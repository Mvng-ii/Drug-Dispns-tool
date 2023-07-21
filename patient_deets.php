<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
    exit(); // Make sure to add exit() after header redirection to prevent further execution.
   }

   // Check if the patient ID is provided in the URL
   if (!isset($_GET['id']) || empty($_GET['id'])) {
       // Redirect or display an error message if the ID is not provided or invalid
       header("Location: doctor_home.php"); // Replace 'doctor_tab.php' with the URL of the doctor's tab
       exit();
   }
    
   $patient_id = 'id';
   $patient_id = $_GET['id'];
   $doctor_id = $_SESSION['id'];

   // Fetch patient details from the database based on the patient ID and doctor ID
   $patient_query = mysqli_query($con, "SELECT * FROM patient WHERE Id=$patient_id AND Assigned_doctor=$doctor_id");

    // Handle form submissions for adding a new prescription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_prescription'])) {
        // Process the form for adding a new prescription
        // Assuming you have form fields for adding prescription and dosage
        $new_prescription = $_POST['new_prescription'];
        $new_dosage = $_POST['new_dosage'];

        // Perform the insert into the database
        $insert_query = mysqli_query($con, "INSERT INTO prescriptions (Patient_ID, Prescription, Dosage) VALUES ($patient_id, '$new_prescription', '$new_dosage')");

        if ($insert_query) {
            // Success! Display a success message or redirect to a confirmation page
            header("Location: patient_details.php?id=$patient_id");
            exit();
        } else {
            // Handle the case when the insertion fails (optional)
            $add_prescription_error_message = "Failed to add new prescription. Please try again.";
        }
    } elseif (isset($_POST['update_patient'])) {
        // Process the form for updating patient details
        // Existing code to update prescription and dosage (from previous response)
    } elseif (isset($_POST['remove_patient'])) {
        // Process the form for removing the patient from the doctor's list
        // Existing code to remove the patient (from previous response)
    }
 }

    // Handle form submissions for updating patient details
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_patient'])) {
        // Process the form for updating patient details
        // Assuming you have form fields for updating prescription and dosage
        $updated_prescription = $_POST['prescription'];
        $updated_dosage = $_POST['dosage'];

        // Perform the update in the database
        $update_query = mysqli_query($con, "UPDATE patients SET prescription='$updated_prescription', dosage='$updated_dosage' WHERE patient_id=$patient_id AND Assigned_doctor=$doctor_id");

        if ($update_query) {
            // Success! Display a success message or redirect to a confirmation page
            header("Location: patient_details.php?id=$patient_id");
            exit();
        } else {
            // Handle the case when the update fails (optional)
            $update_error_message = "Failed to update patient details. Please try again.";
        }
    } elseif (isset($_POST['remove_patient'])) {
        // Process the form for removing the patient from the doctor's list
        // Perform the delete operation in the database
        $delete_query = mysqli_query($con, "DELETE FROM patients WHERE patient_id=$patient_id AND Assigned_doctor=$doctor_id");

        if ($delete_query) {
            // Success! Redirect to the doctor's tab or a confirmation page
            header("Location: doctor_tab.php");
            exit();
        } else {
            // Handle the case when the deletion fails (optional)
            $delete_error_message = "Failed to remove patient. Please try again.";
        }
    }
 }


   // Check if the patient exists and is assigned to the doctor
   if (mysqli_num_rows($patient_query) == 1) {
       $patient_result = mysqli_fetch_assoc($patient_query);
       $patient_name = $patient_result['Name'];
       $prescription = $patient_result['Prescription'];

       // You can display patient details here as you wish
   } else {
       // Redirect or display an error message if the patient is not found or not assigned to the doctor
       header("Location: doctor_home.php"); // Replace 'doctor_tab.php' with the URL of the doctor's tab
       exit();
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
                $res_Dosage = $result['Dosage'];
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
                <!-- Display patient details here -->
                <div class="box">
                    <p>Patient Name: <?php echo $patient_name ?></p>
                    <p>Prescription: <?php echo $prescription ?></p>
                </div>

                <!-- Form for adding a new prescription -->
                <div class="box">
                    <h3>Add New Prescription</h3>
                    <form method="post">
                        <label for="new_prescription">New Prescription:</label>
                        <input type="text" name="new_prescription" id="new_prescription" required>
                        <br>
                        <label for="new_dosage">New Dosage:</label>
                        <input type="text" name="new_dosage" id="new_dosage" required>
                        <br>
                        <input type="submit" name="add_prescription" value="Add Prescription">
                    </form>
                    <?php
                    // Display add prescription error message (if any)
                    if (isset($add_prescription_error_message)) {
                        echo "<p style='color: red;'>$add_prescription_error_message</p>";
                    }
                    ?>
                </div>
                     
                <!-- Form for updating patient details -->
                <div class="box">
                    
                    <h3>Update Patient Details</h3>
                    <form method="post">
                        <label for="prescription">Prescription:</label>
                        <input type="text" name="prescription" id="prescription" value="<?php echo $prescription ?>">
                        <br>
                        <input type="submit" name="update_patient" value="Update">
                    </form>
                    <?php
                        // Display update error message (if any)
                        if (isset($update_error_message)) {
                            echo "<p style='color: red;'>$update_error_message</p>";
                        }
                    ?>
                </div>

                <!-- Form for removing the patient -->
                <div class="box">
                    <h3>Remove Patient</h3>
                    <form method="post">
                        <p>Are you sure you want to remove this patient?</p>
                        <input type="submit" name="remove_patient" value="Remove">
                    </form>
                    <?php
                        // Display delete error message (if any)
                        if (isset($delete_error_message)) {
                            echo "<p style='color: red;'>$delete_error_message</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>