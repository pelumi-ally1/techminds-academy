<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'skill_swap_hub');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$user_result = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $user_result->fetch_assoc();

// Fetch user skills
$skills_result = $conn->query("SELECT * FROM skills WHERE user_id = $user_id");

// Check if the user has a profile picture
$profile_picture = !empty($user['profile_picture']) ? $user['profile_picture'] : 'uploads/default_avatar.jpg';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Skill Swap Hub</title>
    <link rel="stylesheet" href="dash.css">
</head>
<body onload="showLoader()">
    <div id="loader" class="loader">
        <div class="spinner"></div>
        <p>Loading...</p>
    </div>
    <div class="profile-section">
        <img src="<?php echo $profile_picture; ?>" alt="Profile Picture">
        <p><strong><?php echo $user['name']; ?></strong></p>
    </div>

    <div class="container">
        <h1>Welcome, <?php echo $user['name']; ?>!</h1>

        <!-- User Information Section -->
        <div class="card user-info">
            <h2>Your Profile</h2>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Bio:</strong> <?php echo !empty($user['bio']) ? $user['bio'] : 'No bio provided'; ?></p>
            <p><strong>Location:</strong> <?php echo !empty($user['location']) ? $user['location'] : 'Not specified'; ?></p>
            <button class="button" onclick="window.location.href='edit_profile.php'">Edit Profile</button>
        </div>

        <!-- Skill Listing Section -->
        <div class="card skills">
            <h2>Your Skills</h2>
            <ul>
                <?php
                if ($skills_result->num_rows > 0) {
                    while ($skill = $skills_result->fetch_assoc()) {
                        echo "<li>{$skill['skill_name']} <span>({$skill['experience']} - {$skill['category']})</span></li>";
                    }
                } else {
                    echo "<p>You haven't added any skills yet.</p>";
                }
                ?>
            </ul>
            <button class="button" onclick="window.location.href='skill_list.php'">Add New Skill</button>
        </div>

        <!-- Skill Matching Section -->
        <div class="card matches">
            <h2>Skill Matches</h2>
            <?php
            // Match users based on skill categories (excluding the logged-in user)
            $matches_result = $conn->query("SELECT * FROM skills WHERE category IN 
                (SELECT category FROM skills WHERE user_id = $user_id) 
                AND user_id != $user_id 
                GROUP BY user_id");

            if ($matches_result->num_rows > 0) {
                while ($match = $matches_result->fetch_assoc()) {
                    // Fetch matched user details
                    $matched_user_result = $conn->query("SELECT * FROM users WHERE id = {$match['user_id']}");
                    $matched_user = $matched_user_result->fetch_assoc();

                    // Get matched user's profile picture
                    $matched_profile_picture = !empty($matched_user['profile_picture']) ? $matched_user['profile_picture'] : 'uploads/default_avatar.jpg';

                    echo "<div class='match-item'>
                            <img src='$matched_profile_picture' alt='Matched User' style='width:50px; height:50px; border-radius:50%; margin-right:10px;'>
                            <p><strong>{$matched_user['name']}</strong> - {$match['skill_name']} ({$match['experience']} - {$match['category']})</p>
                            <p><strong>Location:</strong> {$matched_user['location']}</p>
                            <button class='button' onclick=\"window.location.href='send_trade.php?provider_id={$matched_user['id']}'\">Send Trade Request</button>
                          </div>";
                }
            } else {
                echo "<p>No matches found yet.</p>";
            }
            ?>
        </div>

        <!-- Trade Requests Section -->
        <div class="card trades">
            <h2>Your Trade Requests</h2>
            <?php
            $trades_result = $conn->query("SELECT * FROM trades WHERE requester_id = $user_id OR provider_id = $user_id");
            if ($trades_result->num_rows > 0) {
                while ($trade = $trades_result->fetch_assoc()) {
                    $trade_partner_id = ($trade['requester_id'] == $user_id) ? $trade['provider_id'] : $trade['requester_id'];

                    // Fetch trade partner's details
                    $trade_partner_result = $conn->query("SELECT * FROM users WHERE id = $trade_partner_id");
                    $trade_partner = $trade_partner_result->fetch_assoc();

                    $status = ucfirst($trade['status']);
                    echo "<div class='trade-item'>
                            <p>Trade with <strong>{$trade_partner['name']}</strong> (Status: $status)</p>
                          </div>";
                }
            } else {
                echo "<p>You have no trade requests.</p>";
            }
            ?>
        </div>
    </div>
   <script>
    function showLoader() {
        // Add a delay of 3 seconds (3000 milliseconds) before hiding the loader
        setTimeout(function() {
            document.getElementById("loader").classList.add("hidden");
        }, 3000);  // 3000ms = 3 seconds
    }
</script>
</body>
</html>

<?php
$conn->close();
?>