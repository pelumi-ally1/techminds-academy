<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
        $conn = new mysqli('localhost', 'root', '', 'skill_swap_hub');

        $user_id = $_SESSION['user_id'];
        $skill_name = $_POST['skill_name'];
        $experience = $_POST['experience'];
        $category = $_POST['category'];

        $stmt = $conn->prepare("INSERT INTO skills (user_id, skill_name, experience, category) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $skill_name, $experience, $category);

        if ($stmt->execute()) {
            header("Location: skill_list.php");
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
        $conn->close();
    } else {
        header("Location: index.html");
    }
?>