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
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dgn.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>

        <div class="right-links">
            <a href="logout.php"> <button class="btn">Log Out</button></a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
        <?php 
               if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $ssn = $_POST['ssn'];
                $age = $_POST['age'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con,"UPDATE patient SET Name='$name', Email='$email', Ssn= '$ssn', Age='$age' WHERE Id=$id") or die(mysqli_error($con));

                if($edit_query){
                    echo "<div class='message'>
                               <p>Profile Updated!</p>
                          </div> <br>";
                    echo "<a href='home.php'><button class='btn'>Go Home</button>";
       
                }
               }else{

                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM patient WHERE Id=$id");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['Name'];
                    $res_Email = $result['Email'];
                    $res_Ssn = $result['Ssn'];
                    $res_Age = $result['Age'];
                    $res_id = $result['Id'];
                }

            ?>
            <header>Update Profile</header>
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
                    <input type="ssn" name="ssn" id="ssn" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>

            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>