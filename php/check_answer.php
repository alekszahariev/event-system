<?php
include("./conn.php");

// Check if phone number exists in the database
$phoneValue = $_POST['phone'];

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM answers WHERE TRIM(instagram) = ?");
$stmt->bind_param("s", $phoneValue);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    echo $id;
} else {
    echo 'not_exists';
}

// Close the statement and connection
$stmt->close();
$conn->close();

?>
