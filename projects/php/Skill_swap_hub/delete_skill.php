<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'skill_swap_hub');

if (isset($_GET['id'])) {
    $skill_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Ensure the user owns the skill before deleting
    $conn->query("DELETE FROM skills WHERE id = $skill_id AND user_id = $user_id");
}

header("Location: skill_list.php");
exit();
?>