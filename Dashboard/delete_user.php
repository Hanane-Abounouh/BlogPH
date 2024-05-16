<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "phblog";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID to delete
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'];

// SQL query to delete the user
$sql = "DELETE FROM utilisateurs WHERE id_utilisateur = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();

// Close the connection
$stmt->close();
$conn->close();
?>