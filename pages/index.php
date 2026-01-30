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
            margin-top: 35px;
            margin-bottom: 30px;
        }

        .header-banner {
            width: 100%;
            background-color: #2c3e50;
            color: white;
            padding: 10px 20px;
            text-align: left;
            font-size: 26px;
            font-weight: bold;
            margin: -20px -20px 20px -20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .featured-quizzes {
            display: flex;
            gap: 50px;
            justify-content: center;
        }

        .quiz-card {
            width: 650px;
            height: 400px;

            display: flex;
            flex-direction: column;

            border-radius: 20px;
            color: white;
            padding: 25px;

            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .quiz-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.25);
        }


        .quiz-card h3 {
            margin: 0 0 10px 0;
        }

        .quiz-card img {
            width: 250px;
            height: 200px;
            background-color: lightgray;
            margin-bottom: 50px;
            align-self: center;
        }

        .quiz-desc {
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
        }

        .play-btn {
            margin-top: auto;
            padding: 12px 28px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            text-decoration: none;
            background: white;
            color: black;
            font-weight: bold;
            align-self: center;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .play-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
        }

        .play-btn:active {
            transform: scale(0.96);
        }


        .red {
            background-color: #ff6b6b;
        }

        .green {
            background-color: #4caf50;
        }
    </style>
</head>

<body>
    <div class="header-banner">
        ⌯✈︎ The World Around Us
    </div>

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

    <form method="post" class="nickname-container">
        <label for="nickname">Nickname:</label>
        <input type="text" name="nickname" id="nickname" placeholder="Enter nickname..."
            value="<?php echo $nickname; ?>" oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')">
        <button type="submit">Save</button>
    </form>

    <h2>Featured Quizzes</h2>
    <div class="featured-quizzes">
        <div class="quiz-card red">
            <h3>𐂂 Animals ଳ ‧₊˚</h3>
            <img src="" alt="Animals Quiz Image">
            <p class="quiz-desc">
                Test your knowledge about wildlife, habitats, and amazing animal facts.
            </p>
            <a href="animal_quiz.php" class="play-btn">Play</a>
        </div>

        <div class="quiz-card green">
            <h3>ᨒ Environment ☘︎ ݁˖</h3>
            <img src="" alt="Environment Quiz Image">
            <p class="quiz-desc">
                Learn about nature, conservation, and how we protect our planet.
            </p>
            <a href="environment_quiz.php" class="play-btn">Play</a>
        </div>

</body>

</html>