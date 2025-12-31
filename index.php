<?php
// --------------------------------------------------
// Home / Products Page – READIFY
// Displays the list of books available in the store
// This page is accessible after login
// --------------------------------------------------

// Page title used by the header
$page_title = "READIFY – Online Book Store";

// Include common layout files and database connection
require "includes/header.php";
require "includes/nav.php";
require "connect_db.php";

// --------------------------------------------------
// Retrieve all books from the database
// --------------------------------------------------
$query = "SELECT * FROM books";
$result = mysqli_query($link, $query);
?>

<div class="container mt-4">

    <?php
    // --------------------------------------------------
    // Display success message after login (if set)
    // --------------------------------------------------
    ?>
    <?php if (isset($_SESSION["login_success"])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION["login_success"]) ?>
        </div>
        <?php unset($_SESSION["login_success"]); ?>
    <?php endif; ?>

    <?php
    // --------------------------------------------------
    // Display success message after logout (if set)
    // --------------------------------------------------
    ?>
    <?php if (isset($_SESSION["logout_success"])): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($_SESSION["logout_success"]) ?>
        </div>
        <?php unset($_SESSION["logout_success"]); ?>
    <?php endif; ?>

    <h1 class="mb-3">Welcome to READIFY</h1>
    <p class="mb-4">Browse our collection of books below.</p>

    <!-- --------------------------------------------------
         Product Grid
         Uses Bootstrap responsive grid system
         - Mobile: 1 item per row
         - Tablet: 2 items per row
         - Desktop: 3 items per row
         - Large screens: 4 items per row
    --------------------------------------------------- -->
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4 d-flex">
                <div class="card h-100 shadow-sm w-100">

                    <!-- Book cover image -->
                    <img
                        src="<?= htmlspecialchars($row['cover_image']) ?>"
                        class="card-img-top img-fluid"
                        style="height: 350px; object-fit: cover;"
                        alt="Book cover of <?= htmlspecialchars($row['title']) ?>">

                    <!-- Card body -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                        <p class="card-text">Author: <?= htmlspecialchars($row['author']) ?></p>

                        <p class="fw-bold text-success">
                            £<?= number_format($row['price'], 2) ?>
                        </p>

                        <!-- Add to cart button stays at bottom -->
                        <a href="added.php?id=<?= $row['book_id'] ?>"
                           class="btn btn-primary mt-auto">
                            Add to Cart
                        </a>
                    </div>

                </div>
            </div>
        <?php endwhile; ?>
    </div>

</div>

<?php require "includes/footer.php"; ?>
