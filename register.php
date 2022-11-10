<html>
    <?php session_start(); ?>
<link rel="stylesheet" href="static/style.css">
<head>
    <title>Register to play Tetris</title>
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
        <div class="box" style="display: block">
            <form action="index.php" method="post">
                <p class="customfont" style="color: #0D1321" style="text-align: center"><b>Register</b></p>
                <hr>

                <label for="firstName" class="customfont2"><b>First Name</b></label>
                <br>
                <input type="text" placeholder="First Name" name="firstName" required>
                <hr>

                <label for="lastName" class="customfont2"><b>Last Name</b></label>
                <br>
                <input type="text" placeholder="Last Name" name="lastName" required>
                <hr>

                <label for="username" class="customfont2"><b>Username</b></label>
                <br>
                <input type="text" placeholder="Username" name="username" required>
                <hr>

                <label for="password" class="customfont2"><b>Password</b></label>
                <br>
                <input type="password" placeholder="Password" name="password" required>
                <br>
                <input type="password" placeholder="Confirm password" name="confirmPassword"
                    required>
                <hr>

                <div>
                    <p class="customfont2">Would you like to display the scores on the leaderboard</p>
                </div>

                <input type="radio" id="yes" name="display" value="yes">
                <label class ="customfont2" for="yes">Yes</label>
                <br>

                <input type="radio" id="no" name="display" value="no">
                <label class="customfont2" for="no">No</label>
                <hr>

                <input type="submit" name="submit">
            </form>
        </div>
        <div class="error">
            <?php 
            if(isset($_GET["error"])){
                if($_GET["error"] == "InvalidUsername"){
                    echo "<p>Invalid Username!</p>";
                }
                else if($_GET["error"] == "PasswordsDontMatch"){
                    echo "<p>Passwords Don't Match!</p>";
                }
            } 
           ?>
        </div>
    </div>
</body>

</html>