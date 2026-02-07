<?php
session_start();

// Prevent user input from breaking the page (prevents HTML/JS injection)
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

// sorting system
$sort = $_GET['sort'] ?? 'name';
if ($sort !== 'name' && $sort !== 'score') $sort = 'name';

// reading leaderboard
$board = []; // nickname => score

$path = "../files/leaderboard.txt";

if (file_exists($path)) {
    $handle = fopen($path, "r");

    if ($handle) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            // $data[0] = name, $data[1] = score (may have spaces)
            $name = trim($data[0] ?? "");
            $score = (int) trim($data[1] ?? "0");

            if ($name === "") continue;

            // cumulative safe
            $board[$name] = ($board[$name] ?? 0) + $score;
        }
        fclose($handle);
    }
}

// convert to list for sorting
$list = [];
foreach ($board as $name => $score) {
    $list[] = ['name' => $name, 'score' => $score];
}

// SORT
if ($sort === 'score') {
    usort($list, function ($a, $b) {
        // highest score first; tie-break by name
        $cmp = $b['score'] <=> $a['score'];
        return $cmp !== 0 ? $cmp : strcasecmp($a['name'], $b['name']);
    });
} else {
    usort($list, function ($a, $b) {
        return strcasecmp($a['name'], $b['name']);
    });
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>

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
            margin-top: 25px;
            margin-bottom: 25px;
        }

        table {
            font-size: 18px;       /* bigger table text */
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 20px;    /* more space in cells */
        }

        th {
            font-size: 19px;
        }

        h2{
            text-align: center;
            font-size: 32px;       /* bigger title */
            margin-bottom: 25px;
        }

        a {
            text-decoration: none;
            color: #2980b9;
            padding: 6px 14px;
            border-radius: 8px;
            background: #2c3e50;
            color: white;
            cursor: pointer;
            transition: 0.2s;
            border: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .links {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divider {
            display: inline-block;
            margin: 0 14px;      /* this controls how wide it spreads */
            font-weight: bold;
            font-size: 20px;     /* slightly bigger divider */
        }

        p{
            font-size: 16px;
            text-align: center;
            margin: 14px 0;        /* more vertical spacing */
        }
        
        .order{
            font-size: 24px;
        }

        
    </style>
</head>

<body>
    <div class="header-banner">
        ⌯✈︎ The World Around Us
    </div>
 <h2>Leaderboard</h2>
    
 
    <!-- <p class="order">
        Order by:
        <div class="links">
            <a href="leaderboard.php?sort=name">Nickname</a> 
            <span class="divider">|</span>
            <a href="leaderboard.php?sort=score">Score</a>
        </div>
    </p> -->
    <p class="order">Order by:</p>
    <div class="links">
        <a href="leaderboard.php?sort=name">Nickname</a> 
        <span class="divider">|</span>
        <a href="leaderboard.php?sort=score">Score</a>
    </div>




    <div class="table-container">
         <?php if (empty($list)): ?>
        <p>No scores yet.</p>
    <?php else: ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <tr>
                <th>Nickname</th>
                <th>Score</th>
            </tr>
            <?php foreach ($list as $row): ?>
                <tr>
                    <td><?= h($row["name"]) ?></td>
                    <td><?= (int)$row["score"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>

    <hr>

    <?php if (isset($_SESSION["nickname"])): ?>
        <p>
            Current player: <strong><?= ($_SESSION["nickname"]) ?></strong><br><br>
            Overall points (this game): <strong><?= (int)($_SESSION["game_points"] ?? 0) ?></strong>
        </p>
        <p><a href="result.php">Back to result page</a></p>
    <?php else: ?>
        <p>
            <a href="index.php">Start a game</a>
        </p>
    <?php endif; ?>

    

</body>
</html>