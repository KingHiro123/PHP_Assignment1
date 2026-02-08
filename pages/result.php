<?php
session_start();

$userAnswers = $_POST['answers'] ?? [];
$correctAnswers = $_POST['correct_answers'] ?? [];

$correct = 0;
$wrong = 0;

for ($i = 0; $i < count($correctAnswers); $i++) {
    $user = strtolower(trim($userAnswers[$i] ?? ""));
    $correctAns = strtolower(trim($correctAnswers[$i] ?? ""));
    if ($user === $correctAns) {
        $correct++;
    } else {
        $wrong++;
    }
}

if (!isset($_SESSION['correct_ans']))
    $_SESSION['correct_ans'] = 0;
if (!isset($_SESSION['incorrect_ans']))
    $_SESSION['incorrect_ans'] = 0;

$_SESSION['correct_ans'] += $correct;
$_SESSION['incorrect_ans'] += $wrong;

if (!isset($_SESSION['game_points'])) {
    $_SESSION['game_points'] = 0;
}
$quizPoints = ($correct * 2) - ($wrong * 1);

// Add this round's points to overall game score
$_SESSION['game_points'] += $quizPoints;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quiz Results</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .header-banner {
            width: 100%;
            background: #2c3e50;
            color: white;
            padding: 14px 30px;
            font-size: 26px;
            font-weight: bold;
        }

        .container {
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .results-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
            text-align: center;
        }

        button {
            margin: 12px 6px 0 6px;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            background: #2c3e50;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #1a252f;
        }
    </style>
</head>

<body>

    <div class="header-banner">
        ⌯✈︎ The World Around Us
    </div>

    <div class="container">
        <div class="results-box">
            <h2>Results:</h2>
            <p>Correct this round: <?php echo $correct; ?></p>
            <p>Incorrect this round: <?php echo $wrong; ?></p>
            <!-- <p>Total Correct: <?php // echo $_SESSION['correct_ans']; ?></p>
            <p>Total Incorrect: <?php // echo $_SESSION['incorrect_ans']; ?></p> -->
            <!-- Need to only show point of current game -->
            <p> Points this round: <?php echo $quizPoints; ?></p>
            <p>Overall Points (this game): <?php echo $_SESSION['game_points']; ?></p>


            <form action="animal_quiz.php" method="get" style="display:inline;">
                <button type="submit">Play Animal Quiz</button>
            </form>

            <form action="environment_quiz.php" method="get" style="display:inline;">
                <button type="submit">Play Environment Quiz</button>
            </form>

            <form action="leaderboard.php" method="get" style="display:inline;">
                <button type="submit">View Leaderboard</button>
            </form>

            <form action="exit.php" method="get" style="display:inline;">
                <button type="submit">Exit Quiz</button>
            </form>

        </div>
    </div>

</body>

</html>