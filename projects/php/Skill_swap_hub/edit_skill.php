<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'skill_swap_hub');
$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $skill_id = $_GET['id'];

    // Fetch existing skill data
    $result = $conn->query("SELECT * FROM skills WHERE id = $skill_id AND user_id = $user_id");
    $skill = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $skill_id = $_POST['skill_id'];
    $skill_name = $_POST['skill_name'];
    $category = $_POST['category'];
    $experience = $_POST['experience'];

    // Update the skill
    $conn->query("UPDATE skills SET skill_name='$skill_name', category='$category', experience='$experience' WHERE id=$skill_id AND user_id=$user_id");

    header("Location: skill_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Skill - Skill Swap Hub</title>
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <div class="container">
        <h1>Edit Skill</h1>

        <div class="card">
            <form action="edit_skill.php" method="POST">
                <input type="hidden" name="skill_id" value="<?php echo $skill['id']; ?>">
                
                <label for="skill_name">Skill Name</label>
                <input type="text" id="skill_name" name="skill_name" value="<?php echo $skill['skill_name']; ?>" required>

                <label for="category">Category</label>
                <input type="text" id="category" name="category" value="<?php echo $skill['category']; ?>" required>

                <label for="experience">Experience Level</label>
                <input type="text" id="experience" name="experience" value="<?php echo $skill['experience']; ?>" required>

                <button type="submit" class="button">Update Skill</button>
            </form>
        </div>
    </div>
</body>
</html>