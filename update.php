<?php
session_start();
$con = mysqli_connect("localhost","root","","drug_dispns_tool");

if(isset($_POST['update_my_data']))
{
    $ssn = $_POST['ssn'];

    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $query = "UPDATE patient SET name ='$name', age='$age', email='$email' WHERE ssn='$ssn' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data Updated Successfully";
        header("Location: update.php");
    }
    else
    {
        $_SESSION['status'] = "Not Updated";
        header("Location: update.php");
    }
}

?>