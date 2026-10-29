<?php
/* WF08 Update Match (UC 07), administrator only: existing match information is prepopulated. */
require_once __DIR__ . "/includes/init.php";
$matchId = id_from_url("match_id");
$match = $matchId !== null ? ($matches[$matchId] ?? null) : null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && $match !== null) {
    // Final project: apply the same checks as Create Match, then UPDATE the MATCH row.
    redirect("manage-matches.php?msg=match_updated");
}

$pageTitle = "Update Match";
$pageRole = "admin";
$navActive = "manage-matches.php";
require_once __DIR__ . "/includes/header.php";
$submitLabel = "Update Match";
?>
<div class="fcb-panel fcb-form mx-auto p-4 p-md-5">
    <h1 class="h3 fw-bold text-center mb-4">Update Match</h1>
    <?php if ($match === null): ?>
        <div class="alert alert-warning" role="alert">Match not found. Choose a match from the list.</div>
        <a class="btn btn-outline-secondary" href="manage-matches.php">Back to Manage Matches</a>
    <?php else: ?>
        <form method="post" action="update-match.php?match_id=<?= $matchId ?>">
            <?php require __DIR__ . "/includes/match-form.php"; ?>
        </form>
    <?php endif; ?>
</div>
<?php require_once __DIR__ . "/includes/footer.php"; ?>
