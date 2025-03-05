<?php
require_once __DIR__ . '/../../config/db.php';
function register($name, $email, $hashed_password, $role,$image): bool {
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("INSERT INTO users (name, email, password, role,image) VALUES (?, ?, ?, ?,?)");
    
    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('sssss', $name, $email, $hashed_password, $role, $image); // Bind the parameters
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

function update_profile($name, $email, $id): bool {
    global $mysqli;
    $statement = $mysqli->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    
    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    
    $statement->bind_param('ssi', $name, $email, $id);
    $result = $statement->execute();
    
    $statement->close();
    return $result;
}

function get_user($id): array {
    global $mysqli;
    $statement = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
    
    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();
    
    $statement->close();
    return $user ? $user : [];
}
?>