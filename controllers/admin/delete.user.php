<?php
require_once __DIR__ . '/../../models/admin/admin.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = intval($_POST['id']); // Ensure the ID is an integer

    if (delete_user($userId)) {
        // Redirect back to the user management page with a success message
        header('Location: /manage_users');
        exit();
    } else {
        // Redirect back with an error message
        header('Location: /manage_users');
        exit();
    }
}
?>