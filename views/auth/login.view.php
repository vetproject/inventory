<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            /* background-color: #f8f9fa; */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 90%;
            max-width: 800px;
            /* background-color: #ffffff; */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .left-side {
            background-color: #ff4757;
            color: white;
            padding: 2rem;
            border-radius: 15px 0 0 15px;
            text-align: center;
            flex: 1;
            margin: 1rem 0 1rem 0;
        }

        .login-container {
            padding: 2rem;
            border-radius: 0 15px 15px 0;
            flex: 1;
        }

        .login-container h1 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: #343a40;
        }

        .btn-primary {
            background-color: #ff4757;
            border-color: #ff4757;
        }

        .btn-primary:hover {
            background-color: #e84118;
            border-color: #e84118;
        }

        .input-group-text {
            background: #ffffff;
            border: none;
        }

        .toggle-password {
            cursor: pointer;
            color: #ff4757;
        }

        .signup-link {
            text-align: center;
            margin-top: 1rem;
            color: #ff4757;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-side">
            <img src="uploads/iconUser.jpg" alt="Logo" class="img-fluid mb-3 rounded-circle" style="width: 100px;">
            <h1>Welcome to Our Inventory</h1>
            <!-- <p>Invintory</p> -->
        </div>
        <div class="login-container">
            <h1 class="text-center">Member Login</h1>
            <form action="controllers/auth/login.controller.php" method="POST">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <span class="toggle-password" id="togglePassword" title="Show password">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                </div>
                <div class="signup-link">
                    <p>Forgot Username/Password?</p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>