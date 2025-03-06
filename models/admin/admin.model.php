<?php
require_once __DIR__ . '/../../config/db.php';

function add_user($name, $email, $password, $role, $image): bool {
    global $mysqli;
    $statement = $mysqli->prepare("INSERT INTO users (name, email, password, role, image) VALUES (?, ?, ?, ?, ?)");
    
    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $statement->bind_param('sssss', $name, $email, $hashedPassword, $role, $image);
    $result = $statement->execute();
    
    $statement->close();
    return $result;
}

function get_allUsers(): array {
    global $mysqli;
    $statement = $mysqli->prepare("SELECT * FROM users");
    
    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    
    $statement->execute();
    $result = $statement->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    
    $statement->close();
    return $users;
}

function update_user($name, $email, $role, $id): bool {
    global $mysqli;
    $statement = $mysqli->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
    
    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    
    $statement->bind_param('sssi', $name, $email, $role, $id);
    $result = $statement->execute();
    
    $statement->close();
    return $result;
}

function delete_user($id): bool {
    global $mysqli;
    $statement = $mysqli->prepare("DELETE FROM users WHERE id = ?");
    
    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    
    $statement->bind_param('i', $id);
    $result = $statement->execute();
    
    $statement->close();
    return $result;
}