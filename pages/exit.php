<?php
session_start();

//If nickname does not exist, do not proceed
if (!isset($_SESSION["nickname"])){
    // Optionally redirect to main page
    header("Location: index.php");
    exit();
}
// File path
$path = "../files/leaderboard.txt";

// Get session data
$nickname = trim($_SESSION["nickname"] ?? "");
$gamePoints = (int)($_SESSION["game_points"] ?? 0);

// Read current leaderboard into associative array
$board = []; // name => score

if (file_exists($path)) {
    $handle = fopen($path, "r");
    if ($handle) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $name = trim($data[0] ?? "");
            $score = (int) trim($data[1] ?? "0");
            if ($name === "") continue;

            // If duplicates exist, combine them
            $board[$name] = ($board[$name] ?? 0) + $score;
        }
        fclose($handle);
    }
}

// Update / Insert
$board[$nickname] = ($board[$nickname] ?? 0) + $gamePoints;

// Write back to file (overwrite)
$handle = fopen($path, "w");
if ($handle) {
    // Optional: save in nice order
    ksort($board, SORT_NATURAL | SORT_FLAG_CASE);

    foreach ($board as $name => $score) {
        // fputcsv adds quotes sometimes; we want "Name, 12" simple
        fwrite($handle, $name . ", " . (int)$score . PHP_EOL);
    }
    fclose($handle);
}

// Store total score (all games) for display on exit page
$totalAllGames = $board[$nickname];

// Clear session (new game starts clean)
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exit</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .header-banner {
            width: 100%;
            background-color: #2c3e50;
            color: white;
            padding: 14px 30px;
            font-size: 26px;
            font-weight: bold;
        }
               .table-container{
            text-align:center;
            display: flex;
            justify-content: center;
        }

        h2{
            text-align: center;
        }
        a {
            text-decoration: none;
            color: #2980b9;
            padding: 8px 16px;
            border-radius: 8px;
            background: #2c3e50;
            color: white;
            cursor: pointer;
            transition: 0.2s;
            border: none;
            margin: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        p{
            font-size: 16px;
            text-align: center;
        }

        .links {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="header-banner">
        ⌯✈︎ The World Around Us
    </div>
 <h2>Game Completed.</h2>
 <h2>Thank you for playing!</h2>
    <p>Nickname: <strong><?= htmlspecialchars($nickname) ?></strong></p>
    <p>Overall score (all games): <strong><?= (int)$totalAllGames ?></strong></p>

    <div class="links">
        <p><a href="index.php">Start a new game</a></p>
    </div>
</body>
</html>