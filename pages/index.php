<!-- index.php -->
<?php
session_start();

// Handle nickname submission
$nickname = '';

if (isset($_POST['nickname'])) {
    // Remove leading/trailing spaces
    $input = trim($_POST['nickname']);

    // Check if it contains only letters and numbers (a-z, A-Z)
    if (preg_match('/^[a-zA-Z]+$/', $input)) {
        $nickname = htmlspecialchars($input); 
    } else {
        echo "<p style='color:red;'>Nickname can only contain letters!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .nickname-container {
            margin-bottom: 20px;
        }
        .featured-quizzes {
            display: flex;
            gap: 20px;
        }
        .quiz-card {
            width: 200px;
            height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: white;
            padding: 10px;
        }
        .quiz-card img {
            width: 150px;
            height: 100px;
            background-color: lightgray;
            margin-bottom: 10px;
        }
        .play-btn {
            margin-top: auto;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }
        .red { background-color: #ff6b6b; }
        .green { background-color: #4caf50; }
    </style>
</head>
<body>

<form method="post" class="nickname-container">
    <label for="nickname">Nickname:</label>
    <input type="text" name="nickname" id="nickname" placeholder="Enter nickname..." 
           value="<?php echo $nickname; ?>" 
           oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')">
    <button type="submit">Save</button>
</form>


<h2>Featured Quizzes</h2>
<div class="featured-quizzes">
    <div class="quiz-card red">
        <h3>Animals</h3>
        <img src="" alt="Animals Quiz Image">
        <form action="quiz.php" method="get">
            <input type="hidden" name="quiz" value="animals">
            <button class="play-btn" type="submit">Play</button>
        </form>
    </div>

    <div class="quiz-card green">
        <h3>Environment</h3>
        <img src="" alt="Environemnt Quiz Image">
        <form action="quiz.php" method="get">
            <input type="hidden" name="quiz" value="environment">
            <button class="play-btn" type="submit">Play</button>
        </form>
    </div>
</div>

</body>
</html>
