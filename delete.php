<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "finaloutput");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $query = "DELETE FROM members WHERE id = $id";
    if (mysqli_query($connection, $query)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
}
mysqli_close($connection);
header("Location: tables.php"); // Redirect back to the main page
?>
