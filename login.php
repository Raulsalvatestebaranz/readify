<?php
$page_title = "Login – READIFY";
require "includes/header.php";
require "includes/nav.php";
?>

<div class="container mt-4" style="max-width: 500px;">

    <h2 class="mb-4 text-center">Login</h2>

    <?php if (isset($_SESSION["login_error"])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION["login_error"]) ?>
        </div>
        <?php unset($_SESSION["login_error"]); ?>
    <?php endif; ?>

    <form method="post" action="login_action.php">

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Login
        </button>

    </form>

    <div class="text-center mt-3">
        <small>
            Don’t have an account?
            <a href="register.php">Register here</a>
        </small>
    </div>

</div>

<?php require "includes/footer.php"; ?>
