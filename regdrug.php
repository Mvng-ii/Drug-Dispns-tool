<!-- regdrug.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dgn.css">
    <title>Drug Registration</title>
</head>
<body>

    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a> </p>
        </div>

        <div class="right-links">

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>

    <div class="container">
        <div class="box form-box">
            <?php 
            include("php/config.php");
            if (isset($_POST['submit'])) {
                $pharmacist = $_POST['pharmacist'];
                $capacity = $_POST['capacity'];
                $price = $_POST['price'];
                $trade_name = $_POST['trade_name'];
                $formula = $_POST['formula'];

                // Verify the unique trade name (assuming trade names should be unique)
                $verify_query = mysqli_query($con, "SELECT Trade_Name FROM drugs WHERE Trade_Name='$trade_name'");
                if (mysqli_num_rows($verify_query) != 0) {
                        echo "<div class='message'>
                                <p>This trade name is already in use. Please try again.</p>
                            </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                    } else {
                        // Insert data into the 'drugs' table
                        mysqli_query($con, "INSERT INTO drugs(Pharmacist, Capacity, Price, Trade_Name, Formula) VALUES ('$pharmacist', '$capacity', '$price', '$trade_name', '$formula')") or die(mysqli_error($con));

                        echo "<div class='message'>
                                <p>Drug added successfully!</p>
                            </div> <br>";
                        echo "<a href='home.php'><button class='btn'>Go to Home</button>";
                    }
                }
            ?>
            <header>Add Drug</header>
            <form action="" method="post">

                <div class="field input">
                    <label for="pharmacist">Pharmacist</label>
                    <input type="text" name="pharmacist" id="pharmacist" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="capacity">Capacity</label>
                    <input type="text" name="capacity" id="capacity" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="price">Price</label>
                    <input type="text" step="0.01" name="price" id="price" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="trade_name">Trade Name</label>
                    <input type="text" name="trade_name" id="trade_name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="formula">Formula</label>
                    <input type="text" name="formula" id="formula" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Add Drug" required>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
