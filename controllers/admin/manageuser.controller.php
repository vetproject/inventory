<?php    
require_once __DIR__ . '/../../models/admin/admin.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    echo $name . ' ' . $email . ' ' . $role . ' ' . $id;
    $result = update_user($name, $email, $role, $id);
    if ($result) {
        header('Location: /manage_users');
    } else {
        echo 'Failed to update user.';
    }
    exit;
} else {
    header('Location: /register');
    exit;
}
?>