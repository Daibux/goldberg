<?php
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Hash the password for secure storage
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user record
        $stmt = $pdo->prepare(query: "INSERT INTO usertable (username, phone, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $phone, $email, $hashedPassword]);

        // Respond with 'success' for the frontend to handle the UI update
        echo "success";
    } catch (PDOException $e) {
        // Check for a duplicate entry error (SQLSTATE 23000)
        if ($e->getCode() == 23000) {
            // Respond with 'duplicate' for the frontend to handle the error
            echo "duplicate";
        } else {
            // Respond with a generic error message
            echo "error";
        }
    }
}
?>
