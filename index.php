<?php
$page_title = "READIFY – Online Book Store";
require "includes/header.php";
require "includes/nav.php";
require "connect_db.php";

$query = "SELECT * FROM books";
$result = mysqli_query($link, $query);
?>

<div class="container mt-4">

    <?php if (isset($_SESSION["login_success"])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION["login_success"]) ?>
        </div>
        <?php unset($_SESSION["login_success"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION["logout_success"])): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($_SESSION["logout_success"]) ?>
        </div>
        <?php unset($_SESSION["logout_success"]); ?>
    <?php endif; ?>

    <h1 class="mb-3">Welcome to READIFY</h1>
    <p class="mb-4">Browse our collection of books below.</p>

    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <img
                        src="<?= htmlspecialchars($row['cover_image']) ?>"
                        class="card-img-top"
                        style="height: 350px; object-fit: cover;"
                        alt="<?= htmlspecialchars($row['title']) ?> cover">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                        <p class="card-text">Author: <?= htmlspecialchars($row['author']) ?></p>
                        <p class="fw-bold text-success">£<?= number_format($row['price'], 2) ?></p>
                        <a href="added.php?id=<?= $row['book_id'] ?>"
                           class="btn btn-primary mt-auto">Add to Cart</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</div>

<?php require "includes/footer.php"; ?>
