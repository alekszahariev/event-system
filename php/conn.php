<?php
$servername = "shipka.ns1.bg:3306";  // Replace with your MySQL server name
$username = "animaliu_crimeorders";  // Replace with your MySQL username
$password = "0141241900Azz";  // Replace with your MySQL password
$database = "animaliu_crimeorders";  // Replace with your MySQL database name
// Create a connection
$conn = new mysqli($servername, $username, $password, $database);
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>