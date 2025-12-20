<?php
require "includes/nav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login – READIFY</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h3 class="text-center mb-4">Login</h3>

                    <?php
                    // Display errors if present
                    if (isset($errors) && !empty($errors)) {
                        echo '<div class="alert alert-danger">';
                        foreach ($errors as $msg) {
                            echo $msg . '<br>';
                        }
                        echo '</div>';
                    }
                    ?>

                    <form action="login_action.php" method="post">

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>

                    </form>

                    <p class="text-center mt-3">
                        Don’t have an account?
                        <a href="register.php">Register</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
