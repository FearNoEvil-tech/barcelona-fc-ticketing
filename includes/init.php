<?php
/*
 * init.php: shared setup that every page loads first.
 * - Sets the time zone so "today" matches Utah, not the server's UTC clock.
 * - Starts the session that remembers who is signed in (demo only).
 * - Provides helper functions and the sample data the pages display.
 *
 * In the final project, the $users and $matches arrays below will be replaced
 * by SELECT queries against the database.
 */
date_default_timezone_set("America/Denver");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Escape a value before printing it in HTML (prevents cross-site scripting). */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

/* Send the browser to another page and stop this one (Post/Redirect/Get). */
function redirect(string $url): void
{
    header("Location: " . $url);
    exit;
}

/* "2026-11-13" -> "Fri, Nov 13, 2026" */
function format_date(string $ymd): string
{
    $date = DateTimeImmutable::createFromFormat("!Y-m-d", $ymd);
    return $date ? $date->format("D, M j, Y") : $ymd;
}

/* "19:00" -> "7:00 PM" */
function format_time(string $hm): string
{
    $time = DateTimeImmutable::createFromFormat("!H:i", $hm);
    return $time ? $time->format("g:i A") : $hm;
}

/* Read a positive whole-number ID from the URL, or return null. */
function id_from_url(string $name): ?int
{
    $id = filter_input(INPUT_GET, $name, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
    return $id ?: null;
}

/* ---- Sample data (USER and MATCH tables from the ERD) ---- */
$users = [
    1 => ["username" => "sspasovski", "full_name" => "Stefan Spasovski", "email" => "stefan@gmail.com", "contact" => "248-867-9309"],
    2 => ["username" => "cosmond", "full_name" => "Cody Osmond", "email" => "cody@gmail.com", "contact" => "369-753-1478"],
    3 => ["username" => "mahmed", "full_name" => "Mandeqa Ahmed", "email" => "mandeqa@gmail.com", "contact" => "864-259-8741"],
];

$matches = [
    1 => ["opponent" => "Real Madrid", "date" => "2026-11-13", "time" => "19:00", "type" => "League"],
    2 => ["opponent" => "Sevilla", "date" => "2026-11-28", "time" => "21:00", "type" => "Cup"],
    3 => ["opponent" => "Atletico Madrid", "date" => "2026-12-12", "time" => "16:15", "type" => "League"],
];

$matchTypes = ["League", "Cup"];

/* The account shown on My Account (the signed-in fan in this prototype). */
$currentUserId = 1;
