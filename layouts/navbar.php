<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<aside class="sidebar m-0 p-0">
    <div class=" ctm-border-radius shadow-sm grow bg-dark" style="height: 89vh;">
        <div class="card-body py-1">
            <div class="user-card card shadow-sm bg-white text-center ctm-border-radius grow">
                <div class="user-info card-body">
                    <div class="user-avatar mb-4">
                        <?php
                        if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin') {
                            echo '<a href="/profile"><img src="../assets/images/admin.png" alt="User Avatar" class="img-fluid rounded-circle" width="100px" style="height: 100px;"></a>';
                        } else {
                            echo '<a href="/profile"><img src="../assets/images/user.jpg" alt="User Avatar" class="img-fluid rounded-circle" width="100px" style="height: 100px;"></a>';
                        }
                        ?>

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
                        <a class="nav-link d-flex align-items-center text-white" href="/products">
                            <i class="fa fa-boxes mr-2" style="font-size: 1.5em;"></i> <span>Manage Products</span>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-white" href="#" data-toggle="collapse" data-target="#reportsDropdown" aria-expanded="false" aria-controls="reportsDropdown">
                            <i class="fa fa-chart-line mr-2" style="font-size: 1.5em;"></i> <span>View Reports</span>
                            <i class="fa fa-chevron-down ml-auto" style="font-size: 1em;"></i>
                        </a>
                        <div id="reportsDropdown" class="collapse pl-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link text-light small py-1" href="/import_product">Import Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light small py-1" href="/export_product">Export Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light small py-1" href="/adjustment_product">Adjustment</a>
                                </li>
                            </ul>
                        </div>
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