<?php
require_once __DIR__ . '/../../config/db.php';

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