<?php
session_start();  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>

    <style>
        {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            overflow-x: hidden; 
        }

        .header-banner {
            width: 100%;
            background-color: #2c3e50;
            color: white;
            padding: 14px 30px;
            font-size: 26px;
            font-weight: bold;
        }

        .container {
            padding: 30px 70px;
        }

        .nickname-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 35px;
        }

        .nickname-container input {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .nickname-container button {
            padding: 8px 16px;
            border-radius: 8px;
            background: #2c3e50;
            color: white;
            cursor: pointer;
            transition: 0.2s;
        }

        .nickname-container button:hover {
            opacity: 0.9;
        }

        h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .featured-quizzes {
            display: flex;
            justify-content: center;
            gap: 55px;
            flex-wrap: wrap;
        }

        .quiz-card {
            width: 610px;
            height: 360px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            border-radius: 20px;
            color: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .quiz-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.25);
        }

        .quiz-card h3 {
            margin: 0;
            font-size: 18px;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            text-align: center;
        }

        .quiz-card img {
            width: 250px;
            height: 200px;
            background-color: lightgray;
            border-radius: 12px;
        }

        .quiz-desc {
            font-size: 16px;
        }

        .play-btn {
            align-self: center;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            background: white;
            color: black;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
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

    <div class="container">

        <?php
        if (isset($_POST['nickname'])) {
            $input = trim($_POST['nickname']);
            if (preg_match('/^[a-zA-Z]+$/', $input)) {
                $_SESSION['nickname'] = htmlspecialchars($input);
            } else {
                echo "<p style='color:red;'>Enter nickname before picking quiz and nickname can only contain letters!</p>";
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
                        A short quiz to test your knowledge regarding wildlife.
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
    </div>
</body>
</html>



