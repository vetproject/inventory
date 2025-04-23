<?php
session_start();
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/auth/auth.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    // echo "Email: $email, Password: $password";

    $user = login($email); // Retrieve user from the database

    if ($user && password_verify($password, $user['password'])) {
        // Store user info in session
        $_SESSION['user'] = [ 
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'password' => $user['password'],
            'image' => $user['image']
        ];
        header('Location: /dashboard');
        exit;
    } else {
        // Handle login error
        echo "Login failed.";
    }
}
?>