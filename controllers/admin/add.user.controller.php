<?php
require_once __DIR__ . '/../../models/admin/admin.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $role = htmlspecialchars($_POST['role'], ENT_QUOTES, 'UTF-8');
    $image = 'https://i.pinimg.com/236x/5f/40/6a/5f406ab25e8942';

    // Encrypt the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Register the user
    $result = add_user($name, $email, $hashed_password, $role, $image);
    if ($result) {
        header('Location: /manage_users');
    } else {
        echo 'Failed to register user.';
    }
    exit;
}
