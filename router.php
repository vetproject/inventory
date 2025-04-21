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
    '/admin' => 'views/admin/dashboard.admin.view.php',
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
$path = rtrim($path, '/'); // Trim trailing slash for consistency

// Publicly accessible routes
$publicRoutes = ['/login', '/register', '/logout']; // Added '/logout' to public routes

// Check if the user is logged in
if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
    // User is logged in, proceed with routing
    if (array_key_exists($path, $routes)) {
        $controller = $routes[$path];
        if (file_exists($controller)) {
            include $controller;
        } else {
            // Handle missing file
            header("HTTP/1.0 500 Internal Server Error");
            echo "500 Internal Server Error: Controller file not found.";
        }
    } else {
        // Handle 404 Not Found
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
} else {
    // User is not logged in
    if (in_array($path, $publicRoutes)) {
        // Allow access to public routes
        if (array_key_exists($path, $routes)) {
            $controller = $routes[$path];
            if (file_exists($controller)) {
                include $controller;
            } else {
                // Handle missing file
                header("HTTP/1.0 500 Internal Server Error");
                echo "500 Internal Server Error: Controller file not found.";
            }
        } else {
            // Handle 404 Not Found
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
        }
    } else {
        // Redirect to login page for restricted routes
        header('Location: /login');
        exit;
    }
}
