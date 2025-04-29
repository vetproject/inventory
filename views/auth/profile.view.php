<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .profile-card {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .profile-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #dee2e6;
        }

        .camera-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #0d6efd;
            border-radius: 50%;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .camera-icon i {
            color: white;
            font-size: 16px;
        }

        input[type="file"] {
            display: none;
        }
    </style>
</head>

<body class="bg-dark">

    <div class="modal-dialog ">
        <div class="modal-content profile-card bg-light">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-person-fill"></i> User Profile
                </h5>
                <a href="/dashboard" class="btn-close text-decoration-none text-danger" aria-label="Close"></a>
            </div>
            <div class="modal-body d-flex align-items-middle justify-content-evenly p-4">

                <form action="controllers/admin/profile.controller.php" method="POST" enctype="multipart/form-data" id="imageForm">
                    <label for="fileInput" class="profile-wrapper mb-3">
                        <?php
                        if (!empty($_SESSION['user']['image'])) {
                            echo '<img src="data:image/jpeg;base64,' . $_SESSION['user']['image'] . '" alt="User Avatar" class="profile-img">';
                        } else {
                            echo '<img src="./uploads/iconUser.jpg" alt="Default Avatar" class="profile-img">';
                        }
                        ?>
                        <div class="camera-icon">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                    </label>
                    <input type="file" name="image" id="fileInput" onchange="document.getElementById('imageForm').submit();">
                    <input type="hidden" name="upload" value="1">
                </form>
                <div class="ms-3">
                    <h5 class="mb-1 text-primary"><?php echo $_SESSION['user']['name']; ?></h5>
                    <p class="mb-1"><?php echo $_SESSION['user']['email']; ?></p>
                    <p class="text-muted mb-0">
                        <?php
                        if ($_SESSION['user']['role'] == 'admin') {
                            echo "Administrator";
                        } elseif ($_SESSION['user']['role'] == 'user') {
                            echo "User";
                        } else {
                            echo "Unknown Role";
                        }
                        ?>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>