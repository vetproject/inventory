<?php
session_start();
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/auth/auth.model.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_SESSION['user']['id'];

    // Update user data
    update_profile($name, $email, $id);
    // Redirect to profile page
    header('Location: /profile');
    exit;
 } else {
}

// Fetch user data for profile view
$user = get_user($_SESSION['user']['id']);
// require_once __DIR__ . '/../../views/auth/profile.view.php';
?>
