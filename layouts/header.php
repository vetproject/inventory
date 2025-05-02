<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
require_once './config/db.php';
require_once './models/products/product.model.php';

$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
$lessQuantity = getLessQuantity($userId);
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark p-3" style="height: 11vh;">
        <a class="navbar-brand text-light" href="/dashboard">Inventory Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle position-relative" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Notifications
                        <?php if (!empty($lessQuantity)): ?>
                            <span class="badge badge-danger position-absolute" style="top: 0; right: 0; transform: translate(50%, -50%);">
                                <?php echo count($lessQuantity); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown">
                        <?php if (!empty($lessQuantity)): ?>
                            <?php foreach ($lessQuantity as $item): ?>
                                <a class="dropdown-item" href="#">
                                    <?php echo htmlspecialchars($item['name']); ?> is low in stock
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <a class="dropdown-item" href="#">No notifications</a>
                        <?php endif; ?>

                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="/profile">My Profile</a>
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>