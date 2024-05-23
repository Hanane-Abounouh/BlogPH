<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    $stmt = $bddPDO->prepare("INSERT INTO utilisateurs (nom_utilisateur, email, mobil, id_role) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $fullName);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $phone);
    $stmt->bindParam(4, $role);

    if ($stmt->execute()) {
        echo "User added successfully";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $stmt->closeCursor(); // closeCursor() instead of close() for PDO
}
?>
