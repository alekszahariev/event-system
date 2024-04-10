<?php
include("./conn.php");

// Check if phone number exists in the database
$phoneValue = $_POST['phone'];
$case = "rebecca";

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM orders WHERE TRIM(phone) = ? AND sluchai = ?");
$stmt->bind_param("ss", $phoneValue, $case);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo 'exists';
} else {
    echo 'not_exists';
}

// Close the statement and connection
$stmt->close();
$conn->close();

?>
