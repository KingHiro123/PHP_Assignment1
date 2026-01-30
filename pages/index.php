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
            margin: 0;
            background: #f5f6fa;
        }

        .header-banner {
            width: 100%;
            background-color: #2c3e50;
            color: white;
            padding: 10px 5px;
            font-size: 26px;
            font-weight: bold;
            margin: 0 0 25px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .nickname-container {
            margin: 25px 0 35px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nickname-container input {
            padding: 6px 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .nickname-container button {
            padding: 6px 14px;
            border-radius: 8px;
            border: none;
            background: #2c3e50;
            color: white;
            cursor: pointer;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .featured-quizzes {
            display: flex;
            gap: 50px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .quiz-card {
            width: 650px;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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
            margin: 0;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            text-align: center;
        }

        .quiz-card img {
            width: 250px;
            height: 200px;
            background-color: lightgray;
            border-radius: 10px;
        }

        .quiz-desc {
            font-size: 15px;
        }

        .play-btn {
            align-self: center;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            background: white;
            color: black;
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

    if (isset($_POST['nickname'])) {
        $input = trim($_POST['nickname']);

        if (preg_match('/^[a-zA-Z]+$/', $input)) {
            $_SESSION['nickname'] = htmlspecialchars($input);
        } else {
            echo "<p style='color:red;'>Nickname can only contain letters!</p>";
        }
    }

    $nickname = $_SESSION['nickname'] ?? '';
    ?>

    <form method="post" class="nickname-container">
        <label>Nickname:</label>
        <input type="text"
               name="nickname"
               placeholder="Enter nickname..."
               value="<?php echo $nickname; ?>"
               oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')">

        <button type="submit">Save</button>
    </form>

    <h2>Featured Quizzes</h2>

    <div class="featured-quizzes">

        <div class="quiz-card red">
            <h3>𐂂 Animals</h3>
            <div class="card-content">
                <img src="" alt="">
                <p class="quiz-desc">
                    Test your knowledge about wildlife, habitats, and amazing animal facts.
                </p>
            </div>
            <a href="animal_quiz.php" class="play-btn">Play</a>
        </div>

        <div class="quiz-card green">
            <h3>ᨒ Environment ☘︎ ݁˖</h3>
            <div class="card-content">
                <img src="" alt="">
                <p class="quiz-desc">
                    Learn about nature, conservation, and how we protect our planet.
                </p>
            </div>
            <a href="environment_quiz.php" class="play-btn">Play</a>
        </div>

    </div>

</body>
</html>
