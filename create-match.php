<?php
/* WF06 Create Match (UC 05), administrator only. */
require_once __DIR__ . "/includes/init.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Final project: check every field, that the date is not in the past, that the
    // type is League or Cup, and that no match is at the same date and time; then INSERT.
    redirect("manage-matches.php?msg=match_created");
}

$pageTitle = "Create Match";
$pageRole = "admin";
$navActive = "manage-matches.php";
require_once __DIR__ . "/includes/header.php";
$match = ["opponent" => "", "date" => "", "time" => "", "type" => ""];
$submitLabel = "Create Match";
?>
<div class="fcb-panel fcb-form mx-auto p-4 p-md-5">
    <h1 class="h3 fw-bold text-center mb-4">Create Match</h1>
    <form method="post" action="create-match.php">
        <?php require __DIR__ . "/includes/match-form.php"; ?>
    </form>
</div>
<?php require_once __DIR__ . "/includes/footer.php"; ?>
