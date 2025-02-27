<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container mt-5" style="width: 500px;">
    <div class="card text-center">
        <div class="card-header bg-primary text-white">
            User Profile
        </div>
        <div class="card-body">
            <img src="../../assets/images/user.jpg" class="rounded-circle mb-3" style="width: 100px; height: 100px;" alt="User Image">
            <h5 class="card-title"><strong><?= $_SESSION['user']['name'] ?></strong></h5>
            <p class="card-text"><?= $_SESSION['user']['email'] ?></p>
            <p class="card-text"><strong>Zoho User ID:</strong><?= $_SESSION['user']['id'] ?></p>
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
                            <form action="/update_profile" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['user']['name'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="zoho_id">Zoho User ID</label>
                                    <input type="text" class="form-control" id="zoho_id" name="zoho_id" value="<?= $_SESSION['user']['id'] ?>" required>
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
