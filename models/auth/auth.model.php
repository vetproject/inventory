<?php
require_once __DIR__ . '/../../config/db.php';

function register($name, $email, $hashed_password): bool {
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    
    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('sss', $name, $email, $hashed_password); // Bind the parameters
    $result = $statement->execute();
    
    $statement->close(); // Close the statement
    return $result;
}

function login($email): array {
    global $mysqli; 
    $statement = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    
    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('s', $email); 
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();
    
    $statement->close(); 
    return $user ? $user : [];
}
?>