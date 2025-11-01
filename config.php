<?php
$conn = mysqli_connect("localhost", "root", "", "pmp_smart");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
