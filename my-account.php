<?php
/*
 * WF04 View User Account / My Account (UC 02 for a fan).
 * Starts UC 03 (Update Account) and UC 04 (Delete Account).
 */
require_once __DIR__ . "/includes/init.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "delete") {
    // Final project: DELETE the USER row (after the confirmation prompt), then sign out.
    $_SESSION = [];
    session_destroy();
    redirect("login.php?msg=account_deleted");   // "Account deletion, returns to WF02"
}

$pageTitle = "My Account";
$pageRole = "user";
require_once __DIR__ . "/includes/header.php";
$user = $users[$currentUserId];
?>
<div class="fcb-panel fcb-form mx-auto p-4 p-md-5">
    <h1 class="h3 fw-bold text-center mb-4">My Account</h1>
    <?php require __DIR__ . "/includes/messages.php"; ?>

    <dl class="row mb-4">
        <dt class="col-sm-4">Full Name</dt>
        <dd class="col-sm-8"><?= e($user["full_name"]) ?></dd>
        <dt class="col-sm-4">Username</dt>
        <dd class="col-sm-8"><?= e($user["username"]) ?></dd>
        <dt class="col-sm-4">Email</dt>
        <dd class="col-sm-8"><?= e($user["email"]) ?></dd>
        <dt class="col-sm-4">Contact Information</dt>
        <dd class="col-sm-8"><?= e($user["contact"]) ?></dd>
    </dl>

    <div class="d-flex flex-wrap gap-2">
        <a class="btn btn-primary" href="update-user.php?user_id=<?= $currentUserId ?>">Update Account</a>
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Delete Account
        </button>
    </div>
    <p class="small fst-italic text-body-secondary mt-3 mb-0">Delete Account requires confirmation before deletion.</p>
</div>
<?php
$modalTitle = "Delete your account?";
$modalBody = "Delete the account";
$modalField = "user_id";
$modalAction = "my-account.php";
$modalDefaultId = $currentUserId;
$modalDefaultName = $user["username"];
require __DIR__ . "/includes/delete-modal.php";
require_once __DIR__ . "/includes/footer.php";
