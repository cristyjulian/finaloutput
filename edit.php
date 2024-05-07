<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "finaloutput");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $age = intval($_POST['age']);

    $updateQuery = "UPDATE members SET fname='$fname', lname='$lname', age=$age WHERE id=$id";
    if (mysqli_query($connection, $updateQuery)) {
        $_SESSION['message'] = "Record updated successfully";
    } else {
        $_SESSION['error'] = "Error updating record: " . mysqli_error($connection);
    }
    mysqli_close($connection);
    header("Location: tables.php"); // Redirect back to the main page
    exit();
} else {
    // handle invalid access
    $_SESSION['error'] = "Invalid request";
    header("Location: tables.php");
    exit();
}
?>
