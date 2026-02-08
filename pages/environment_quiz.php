<?php
session_start();

$_SESSION["back_clicked"] = false;
$_SESSION["first_load"] = false;

if (!isset($_SESSION["retrieve"])) {
    $_SESSION["retrieve"] = false;
}

if (!isset($_SESSION['player_name'])) {
    $_SESSION['player_name'] = $_POST['name'] ?? "";
}

$_SESSION['quiz_type'] = "environment_quiz";

// initializers counters if they don't exist
if (!isset($_SESSION['correct_ans'])) {
    $_SESSION['correct_ans'] = 0;
}
if (!isset($_SESSION['incorrect_ans'])) {
    $_SESSION['incorrect_ans'] = 0;
}

// check if player exists
$playerFile = "details.txt";
$playerFound = false;

if ($_SESSION["retrieve"] == false) {

    $player = fopen($playerFile, "r");

    if ($player) {
        while (($data = fgetcsv($player, 1000, ",")) !== false) {
            if ($_SESSION["player_name"] == $data[0]) {
                $playerFound = true;
                break;
            }
        }
        fclose($player);
    }

    $_SESSION["retrieve"] = true;
}

// load qns
$picPattern = "/Image:\s+(\w+\S+[\.]\w+)/i";
$descriptionPattern = "/^Description:\s+(.+)/i";
$questionPattern = "/^Question:\s+(.+)/i";
$answerPattern = "/^Answer:\s+(.+)/i";

$enviFile = fopen("envi_qna.txt", "r");

$imgName = [];
$description = [];
$question = [];
$answer = [];

$id = 0;

while (!feof($enviFile)) {
    $dataLine = fgets($enviFile);

    if (preg_match($picPattern, $dataLine, $matches)) {
        $imgName[$id] = $matches[1];
    } else if (preg_match($descriptionPattern, $dataLine, $matches)) {
        $description[$id] = $matches[1];
    } else if (preg_match($questionPattern, $dataLine, $matches)) {
        $question[$id] = $matches[1];
    } else if (preg_match($answerPattern, $dataLine, $matches)) {
        $answer[$id] = $matches[1];
        $id++;
    }
}

fclose($enviFile);

// randomise 4 qns
$combined = [];

for ($i = 0; $i < count($question); $i++) {
    $combined[] = [
        "img" => $imgName[$i] ?? "",
        "desc" => $description[$i] ?? "",
        "q" => $question[$i] ?? "",
        "a" => $answer[$i] ?? ""
    ];
}

shuffle($combined);
$combined = array_slice($combined, 0, 4);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environment Quiz</title>

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

        .container {
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .quiz-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
        }

        .question {
            display: none;
            margin-top: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 12px;
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
        <div class="quiz-box">

            <h2>Environment Quiz</h2>

            <form method="POST" action="result.php">
                <?php foreach ($combined as $i => $q) { ?>
                    <div class="question">
                        <p><strong><?php echo htmlspecialchars($q['desc']); ?></strong></p>
                        <p><?php echo htmlspecialchars($q['q']); ?></p>

                        <input type="text" name="answers[]" placeholder="Type your answer...">

                        <?php if ($i < count($combined) - 1) { ?>
                            <button type="button" onclick="nextQuestion()">Next</button>
                        <?php } else { ?>
                            <button type="submit">Finish</button>
                        <?php } ?>
                    </div>

                    <input type="hidden" name="correct_answers[]" value="<?php echo htmlspecialchars($q['a']); ?>">
                <?php } ?>
            </form>

        </div>
    </div>

    <!-- Old code (the one that you implemented) -->
    <!-- <script>
        let currentQuestion = 0;

        function showQuestion(index) {
            let qList = document.getElementsByClassName('question');
            for (let i = 0; i < qList.length; i++) {
                qList[i].style.display = 'none';
            }
            if (index < qList.length) {
                qList[index].style.display = 'block';
            }
        }

        function nextQuestion() {
            currentQuestion++;
            showQuestion(currentQuestion);
        }

        window.onload = function () {
            showQuestion(0);
        };
    </script> -->


    <!-- New Code (one that i implemented) -->
    <script>
        let currentQuestion = 0;

        function showQuestion(index) {
            let qList = document.getElementsByClassName('question');
            for (let i = 0; i < qList.length; i++) {
                qList[i].style.display = 'none';
            }
            if (index < qList.length) {
                qList[index].style.display = 'block';
            }
        }

        function nextQuestion() {
            let qList = document.getElementsByClassName('question');
            if (currentQuestion < qList.length - 1) {
                currentQuestion++;
                showQuestion(currentQuestion);
            }
        }

        window.onload = function () {
            showQuestion(0);
        };

        // something that i added for the enter key issue
        // Prevent Enter from submitting form
        document.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();

                // you can keep this if you want to, i will comment it out for now 
                // // only go next if not last question 
                // let qList = document.getElementsByClassName('question');
                // if (currentQuestion < qList.length - 1) {
                //     nextQuestion();
                // }
            }
        });
    </script>
</body>

</html>