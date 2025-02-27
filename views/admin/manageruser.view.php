<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<?php
require_once 'layouts/header.php';
?>
<div class="container-fluid">

    <div class="row">
        <aside class="d-none d-md-block bg-light sidebar bg-warning" style="width:25%;">
            <?php
            require_once 'layouts/navbar.php';
            ?>
        </aside>

        <div class="bg-teal" style="width: 75%;">
            <?php
            if ($_SERVER['REQUEST_URI'] == '/manage_users') {
                // Add your admin-specific content here
                // Function to fetch the user data
                function getUserData()
                {
                    // Example data, replace with actual data fetching logic
                    return [
                        ['id' => 1, 'username' => 'user1', 'email' => 'user1@example.com', 'role' => 'admin'],
                        ['id' => 2, 'username' => 'user2', 'email' => 'user2@example.com', 'role' => 'user'],
                        ['id' => 3, 'username' => 'user3', 'email' => 'user3@example.com', 'role' => 'user']
                    ];
                }

                // Fetch the user data
                $userData = getUserData();

                if ($userData) {
                    echo '<table class="table table-bordered">';
                    echo '<thead>';
                    echo '<tr class="text-center">';
                    echo '<th>Username</th>';
                    echo '<th>Email</th>';
                    echo '<th>Role</th>';
                    echo '<th>Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($userData as $user) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($user['username']) . '</td>';
                        echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($user['role']) . '</td>';
                        echo '<td class="text-center">';
                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editUserModal" data-id="' . htmlspecialchars($user['id']) . '" data-username="' . htmlspecialchars($user['username']) . '" data-email="' . htmlspecialchars($user['email']) . '" data-role="' . htmlspecialchars($user['role']) . '">Edit</button>';
                        echo ' | ';
                        echo '<button type="button" class="btn btn-danger" onclick="window.location.href=\'/delete_user/' . htmlspecialchars($user['id']) . '\'">Delete</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No user data available.</p>';
                }
            } else {
                // Add your default content here
                echo '<h1>Welcome to the User Management System</h1>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="controllers/admin/manageuser.controller.php">
                    <input type="hidden" name="id" id="editUserId">
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" name="username" id="editUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" name="email" id="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="editRole">Role</label>
                        <select class="form-control" name="role" id="editRole" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#editUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var username = button.data('username');
        var email = button.data('email');
        var role = button.data('role');

        var modal = $(this);
        modal.find('#editUserId').val(id);
        modal.find('#editUsername').val(username);
        modal.find('#editEmail').val(email);
        modal.find('#editRole').val(role);
    });
</script>
