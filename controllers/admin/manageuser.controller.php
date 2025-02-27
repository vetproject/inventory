<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    echo $name . ' ' . $email . ' ' . $role . ' ' . $id;
    exit;
} else {
    header('Location: /register');
    exit;
}
?>