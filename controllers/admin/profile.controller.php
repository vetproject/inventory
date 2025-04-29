<?php
session_start();
// Include the database configuration
include __DIR__ . '/../../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    die("User not logged in.");
}

$userId = $_SESSION['user']['id'];

// Ensure database connection is established
if (!isset($mysqli)) {
    die("Database connection not established.");
}

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageType = mime_content_type($imageTmp);

    // Validate file type and size (e.g., max 2MB, only images)
    if (!in_array($imageType, ['image/jpeg', 'image/png', 'image/gif'])) {
        die("Invalid file type. Only JPEG, PNG, and GIF are allowed.");
    }
    if ($imageSize > 2 * 1024 * 1024) {
        die("File size exceeds 2MB.");
    }

    if (!empty($imageTmp)) {
        $imgData = file_get_contents($imageTmp);
        $base64 = base64_encode($imgData);

        // Update image in database
        $stmt = $mysqli->prepare("UPDATE users SET image = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("si", $base64, $userId);
            $stmt->execute();
            $stmt->close();

            // Update session with new image
            $_SESSION['user']['image'] = $base64;

            header("Location: /profile"); // Reload page
            exit;
        } else {
            die("Failed to prepare statement: " . $mysqli->error);
        }
    } else {
        die("No file uploaded.");
    }
} else {
    die("Invalid request.");
}
