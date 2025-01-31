<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'skill_swap_hub');
$user_id = $_SESSION['user_id'];

$skills_result = $conn->query("SELECT * FROM skills WHERE user_id = $user_id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Skills - Skill Swap Hub</title>
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <div class="container">
        <h1>Your Skills</h1>

        <!-- Add Skill Form -->
        <div class="card">
            <h2>Add New Skill</h2>
            <form action="add_skill.php" method="POST">
                <label for="skill_name">Skill Name</label>
                <input type="text" id="skill_name" name="skill_name" required>
                
                <label for="category">Category</label>
                <input type="text" id="category" name="category" required>

                <label for="experience">Experience Level</label>
                <input type="text" id="experience" name="experience" required>

                <button type="submit" class="button">Add Skill</button>
            </form>
        </div>

        <!-- Display Skills -->
        <div class="card">
            <h2>Your Skills</h2>
            <ul>
                <?php
                if ($skills_result->num_rows > 0) {
                    while ($skill = $skills_result->fetch_assoc()) {
                        echo "<li>
                                <strong>{$skill['skill_name']}</strong> ({$skill['experience']} - {$skill['category']})
                                <a href='edit_skill.php?id={$skill['id']}' class='edit-btn'>Edit</a>
                                <a href='delete_skill.php?id={$skill['id']}' class='delete-btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                              </li>";
                    }
                } else {
                    echo "<p>You haven't added any skills yet.</p>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>