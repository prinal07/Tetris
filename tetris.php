<html>
    <?php session_start();?>
<link rel="stylesheet" href="static/style.css">

<?php 
$_SESSION["playing"] = true;
?>

<head>
    <title>
        Tetris Game
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>

<body>

    <ul class="menu">
        <li style="float: left" name="home"><a href="index.php">Home</a></li>
        <li style="float: right" name="tetris"><a href="tetris.php">Play Tetris</a></li>
        <li style="float: right" name="leaderboard"><a href="leaderboard.php">Leaderboard</a></li>
    </ul>

    <div class="main" id="main">

        <div class="game" id="tetris-bg">
        
            <button name="Start" id="start" class="btn" onclick = "startGame()">Start the game</button>

        </div>

        <div class = "score" id="score">
            <p><b>Score:</b></p>
        </div>

    </div>

    <script src = "tetris.js"></script>

</body>

</html>