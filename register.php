<?php
$page_title = "Register – READIFY";
require "includes/header.php";
require "includes/nav.php";
require "connect_db.php";

/* Handle registration */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        !empty($_POST["first_name"]) &&
        !empty($_POST["last_name"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"])
    ) {
        $first = mysqli_real_escape_string($link, $_POST["first_name"]);
        $last  = mysqli_real_escape_string($link, $_POST["last_name"]);
        $email = mysqli_real_escape_string($link, $_POST["email"]);
        $hash  = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $query = "
            INSERT INTO users (first_name, last_name, email, password)
            VALUES ('$first', '$last', '$email', '$hash')
        ";

        if (mysqli_query($link, $query)) {
            header("Location: login.php");
            exit;
        }
    }
}
?>

<div class="container mt-4" style="max-width: 600px;">

    <h2 class="mb-4 text-center">Create an Account</h2>

    <form method="post">

        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">
            Register
        </button>

    </form>

    <div class="text-center mt-3">
        <small>
            Already have an account?
            <a href="login.php">Login here</a>
        </small>
    </div>

</div>

<?php require "includes/footer.php"; ?>
