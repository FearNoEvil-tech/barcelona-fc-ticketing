<?php
/*
 * WF07A Manage Matches (UC 06 for an administrator).
 * Starts UC 05 (Create Match), UC 07 (Edit), and UC 08 (Delete).
 */
require_once __DIR__ . "/includes/init.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "delete") {
    // Final project: DELETE the MATCH row whose MatchID is $_POST["match_id"].
    redirect("manage-matches.php?msg=match_deleted");   // "Return to WF07A with updated list"
}

$pageTitle = "Manage Matches";
$pageRole = "admin";
require_once __DIR__ . "/includes/header.php";
?>
<div class="fcb-panel p-4 p-md-5">
    <h1 class="h3 fw-bold text-center mb-4">Manage Matches</h1>
    <?php require __DIR__ . "/includes/messages.php"; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 fw-bold mb-0">Upcoming FC Barcelona Matches</h2>
        <a class="btn btn-primary" href="create-match.php">Create Match</a>
    </div>
    <?php
    $showActions = true;
    require __DIR__ . "/includes/match-table.php";
    ?>
    <p class="small fst-italic text-body-secondary mb-0">Delete requires confirmation before removing a match.</p>
</div>
<?php
$modalTitle = "Delete match?";
$modalBody = "Delete the match";
$modalField = "match_id";
$modalAction = "manage-matches.php";
require __DIR__ . "/includes/delete-modal.php";
require_once __DIR__ . "/includes/footer.php";
