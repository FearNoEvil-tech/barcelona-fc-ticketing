<?php
/*
 * WF03 Create User Account (UC 01).
 * Fans open it from Register Here on Login; administrators from Create User on
 * Manage Users (create-user.php?from=admin).
 */
require_once __DIR__ . "/includes/init.php";
$fromAdmin = ($_GET["from"] ?? "") === "admin";
$returnTo = $fromAdmin ? "manage-users.php" : "login.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Final project: validate the fields, check the username and email are not
    // already in use, password_hash() the password, and INSERT the USER row.
    redirect($returnTo . "?msg=" . ($fromAdmin ? "user_created" : "account_created"));
}

$pageTitle = "Create User Account";
$pageRole = $fromAdmin ? "admin" : null;
$navActive = $fromAdmin ? "manage-users.php" : "login.php";
require_once __DIR__ . "/includes/header.php";
?>
<div class="fcb-panel fcb-form mx-auto p-4 p-md-5">
    <h1 class="h3 fw-bold text-center mb-4">Create User Account</h1>

    <form method="post" action="create-user.php<?= $fromAdmin ? "?from=admin" : "" ?>">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name<span class="required-mark">*</span></label>
            <input type="text" class="form-control" id="full_name" name="full_name" maxlength="100"
                autocomplete="name" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username<span class="required-mark">*</span></label>
            <input type="text" class="form-control" id="username" name="username" minlength="3" maxlength="30"
                pattern="[A-Za-z0-9_]+" autocomplete="username" aria-describedby="usernameHelp" required>
            <div id="usernameHelp" class="form-text">3 to 30 letters, numbers, or underscores.</div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email<span class="required-mark">*</span></label>
            <input type="email" class="form-control" id="email" name="email" maxlength="254" autocomplete="email"
                required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password<span class="required-mark">*</span></label>
            <input type="password" class="form-control" id="password" name="password" minlength="8"
                autocomplete="new-password" aria-describedby="passwordHelp" required>
            <div id="passwordHelp" class="form-text">At least 8 characters.</div>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact Information</label>
            <input type="tel" class="form-control" id="contact" name="contact" maxlength="30" autocomplete="tel"
                placeholder="Phone number">
        </div>
        <p class="small text-body-secondary"><span class="required-mark">*</span> Required Fields</p>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Create Account</button>
            <a class="btn btn-outline-secondary" href="<?= e($returnTo) ?>">Cancel</a>
        </div>
    </form>

    <?php if (!$fromAdmin): ?>
        <p class="text-center mt-4 mb-0">Already have an account? <a href="login.php">Login Here</a></p>
    <?php endif; ?>
</div>
<?php require_once __DIR__ . "/includes/footer.php"; ?>
