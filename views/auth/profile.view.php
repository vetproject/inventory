<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container mt-5" style="width: 500px;">
        <?php
        require_once __DIR__ . '../../../models/auth/auth.model.php';
        if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
            $user = get_user($_SESSION['user']['id']);
        } else {
            // Handle the case where the user is not logged in or session is not set
            $user = null;
        }
        ?>
        <div class="card text-center">
            <div class="card-header bg-primary text-white">
                User Profile
            </div>
            <div class="card-body">
                <img id="profileImage" src="<?= isset($user['image']) && !empty($user['image']) ? $user['image'] : 'https://i.pinimg.com/236x/5f/40/6a/5f406ab25e8942cbe0da6485afd26b71.jpg' ?>" class="rounded-circle mb-3" style="width: 100px; height: 100px;" alt="User Image">
                <h5 class="card-title"><strong><?= $user ? $user['name'] : 'Guest' ?></strong></h5>
                <p class="card-text"><?= $user ? $user['email'] : 'No email available' ?></p>
                <p class="card-text"><strong>Zoho User ID:</strong> <?= $user ? $user['id'] : 'N/A' ?></p>
                <p class="card-text"><strong>Super admin:</strong> bpearson@zylker.com</p>
            </div>
            <div class="card-footer text-muted">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit</button>
                <!-- Edit Profile Modal -->
                <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="controllers/auth/profile.controller.php" method="post">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="/logout" method="post" style="display: inline;">
                    <button type="submit" class="btn btn-danger">Sign out</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>