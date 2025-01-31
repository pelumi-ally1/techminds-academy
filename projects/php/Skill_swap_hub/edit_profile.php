<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'skill_swap_hub');
$user_id = $_SESSION['user_id'];

// Fetch user details
$user_result = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $user_result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $location = $_POST['location'];

    // Profile Picture Upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES["profile_picture"]["name"]);
        $target_file = $target_dir . time() . "_" . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file type
        if (in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
            // Update profile picture path in database
            $conn->query("UPDATE users SET profile_picture='$target_file' WHERE id=$user_id");
        }
    }

    // Update user details
    $conn->query("UPDATE users SET name='$name', bio='$bio', location='$location' WHERE id=$user_id");
    
    // Redirect back to dashboard
    header("Location: dashboard.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

            <label>Bio:</label>
            <textarea name="bio"><?php echo $user['bio']; ?></textarea>

            <label>Location:</label>
            <input type="text" name="location" value="<?php echo $user['location']; ?>">

            <label>Profile Picture:</label>
            <input type="file" name="profile_picture" accept="image/*">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>