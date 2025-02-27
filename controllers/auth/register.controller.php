<?php
session_start(); // Start the session
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/auth/auth.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    // Encrypt the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Register the user
    $result = register($name, $email, $hashed_password);

    if ($result) {
        // Store user info in session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password']
        ];
        header('Location: /');
        exit;
    } else {
        // Handle registration error
        echo "Registration failed.";
    }
}
?>