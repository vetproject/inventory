<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<aside class="sidebar m-0 p-0">
    <div class=" ctm-border-radius shadow-sm grow bg-dark" style="height: 89vh;">
        <div class="card-body py-1">
            <div class="user-card card shadow-sm bg-white text-center ctm-border-radius grow">
                <div class="user-info card-body">
                    <div class="user-avatar mb-4">
                        <a href="/profile">
                            <img src="../assets/images/user.jpg" alt="User Avatar" class="img-fluid rounded-circle" width="100px" style="height: 100px;">
                        </a>
                    </div>
                    <div class="user-details">
                        <p><strong><?php echo 'Welcome ', isset($_SESSION['user']['name']) ? strtoupper($_SESSION['user']['name']) : 'GUEST'; ?></strong></p>
                    </div>
                    <div class="user-details">
                        <p><?= date("l, d/m/Y"); ?></p>
                    </div>
                </div>
            </div>
            <div class="" id="sidebar-menu">
                <ul class="nav flex-column mt-3">
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center text-white" href="/dashboard">
                            <i class="fa fa-tachometer-alt mr-2" style="font-size: 1.5em;"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-white" href="/manage_users">
                            <i class="fa fa-users mr-2" style="font-size: 1.5em;"></i> <span>Manage Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-white" href="manage_products.php">
                            <i class="fa fa-boxes mr-2" style="font-size: 1.5em;"></i> <span>Manage Products</span>

                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-white" href="/view_reports">
                            <i class="fa fa-chart-line mr-2" style="font-size: 1.5em;"></i> <span>View Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d
                        align-items-center text-white" href="/logout">
                            <i class="fa fa-sign-out-alt mr-2" style="font-size: 1.5em;"></i> <span>Logout</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</aside>