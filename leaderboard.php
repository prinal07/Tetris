<html>
    <?php session_start(); ?>
<link rel="stylesheet" href="static/style.css">
<head>
    <title>Leaderboard</title>
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
    <div class="main">
        <div class="leaderboard" style="display: block">
            <?php 
            $playing = $_SESSION["playing"];
                if(($_SESSION["playing"]) == true){
                    $_SESSION["playing"] = false;
                    $username = $_SESSION["username"];
                    $score = $_POST["Score"];
                    $conn = mysqli_connect("localhost", "user", "password", "tetris");
                    $sql_statement = "SELECT Display FROM Users WHERE Username = '".$username."';";
                    $query =mysqli_query($conn, $sql_statement);
                    $display = $query->fetch_assoc();
                
                    if($display["Display"] == 1){

                        $inputScore = "INSERT INTO Scores (Username, Score) VALUES ('" . $username. "', '". $score. "');";
                        mysqli_query($conn, $inputScore);
                    }
                }
                $table = "SELECT Username, Score FROM Scores ORDER BY Score DESC";
                $ans = $conn->query($table);
                $query2 = mysqli_query($conn, $ans);
                if($ans->num_rows > 0){
                    echo "<table><tr><th>Username</th><th>Score</th></tr>";
                    while($row = $ans->fetch_assoc()){
                        echo"<tr><td>" . $row["Username"] . "</td><td>" . $row["Score"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "no results found!";
                }
                
            ?>
        </div>
    </div>
</body>

</html>