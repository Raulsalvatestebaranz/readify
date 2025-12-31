<?php
// --------------------------------------------------
// Register Page – READIFY
// Allows a new user to create an account
// --------------------------------------------------

// Page title used by the header
$page_title = "Register – READIFY";

// Include common layout and database connection
require "includes/header.php";
require "includes/nav.php";
require "connect_db.php";

// --------------------------------------------------
// Handle registration form submission
// This code only runs when the form is submitted
// --------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Check that all required fields are filled
    if (
        !empty($_POST["first_name"]) &&
        !empty($_POST["last_name"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"])
    ) {
        // Sanitize user input to prevent SQL injection
        $first = mysqli_real_escape_string($link, $_POST["first_name"]);
        $last  = mysqli_real_escape_string($link, $_POST["last_name"]);
        $email = mysqli_real_escape_string($link, $_POST["email"]);

        // Hash the password before storing it in the database
        $hash  = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Insert the new user into the users table
        $query = "
            INSERT INTO users (first_name, last_name, email, password)
            VALUES ('$first', '$last', '$email', '$hash')
        ";

        // If the user is created successfully, log them in automatically
        if (mysqli_query($link, $query)) {

            // Get the newly created user's ID
            $user_id = mysqli_insert_id($link);

            // Create session variables (auto-login)
            $_SESSION["user_id"] = $user_id;
            $_SESSION["first_name"] = $first;
            $_SESSION["login_success"] = "Welcome to READIFY, $first!";

            // Redirect to home page
            header("Location: index.php");
            exit;
        }
    }
}
?>

<!-- --------------------------------------------------
     Registration Form
     Uses Bootstrap for styling and responsiveness
--------------------------------------------------- -->

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
