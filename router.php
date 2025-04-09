<?php
session_start();
// Define routes
$routes = [
    // route for home view
    '/' => 'views/home.view.php',

    // route for authentication views
    '/register' => 'views/auth/register.view.php',
    '/login' => 'views/auth/login.view.php',
    '/logout' => 'views/auth/logout.view.php',
    '/profile' => 'views/auth/profile.view.php',

    // dashboard view
    '/dashboard' => 'views/dashboard.view.php',

    // admin views
    '/admin' => 'views/admin/dashbaord.admin.view.php',
    '/manage_users' => 'views/admin/manageruser.view.php',
    '/view_reports' => 'views/admin/reports.view.php',

    // navbar layout
    '/navbar' => 'layouts/navbar.php',
    '/header' => 'layouts/header.php',

    // product views
    '/products' => 'views/products/product.view.php',
    '/import_product' => 'views/products/import.product.view.php',
    '/export_product' => 'views/products/export.product.view.php',
    '/adjustment_product' => 'views/products/adjustment.product.view.php',
    
];

// Get the current path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request to the appropriate controller
if (array_key_exists($path, $routes)) {
    $controller = $routes[$path];
    include $controller;
} else {
    // Handle 404 Not Found
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
}
?>