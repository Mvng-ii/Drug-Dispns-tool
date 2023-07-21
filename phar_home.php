<?php 
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
        exit(); // Terminate the script to prevent further execution
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
            $query = mysqli_query($con,"SELECT*FROM pharmacist WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Name'];
                $res_Email = $result['Email'];
                $res_SSN = $result['SSN'];
                $res_Age = $result['Age'];
                $res_Prescription = $result['Prescription'];
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
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $res_Email ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>Your SSN is <b><?php echo $res_SSN ?></b>.</p> 
            </div>
          </div>
          <div class="main-box bottom"> 
            <!-- Added a new div to contain the 'Add drug' button -->
            <a href="regdrug.php"> <button class="btn">Add drug</button> </a> <!-- This is the new button at the bottom -->
            <a href="patprsr.php"> <button class="btn">View Prescription</button> </a> <!-- This is the new 'View Prescription' button -->
          </div>
          
        </div>

    </main>
</body>
</html>
