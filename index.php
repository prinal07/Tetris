<?php 
    session_start();
    $conn = mysqli_connect("localhost", "user", "password", "tetris");

    if(!$conn){
        die("connection failed: " . mysqli_connect_error());
    }

    $result;
    $firstname = $_POST["firstName"];
    $lastname = $_POST["lastName"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $Display = $_POST["display"];

    if($_POST['submit']){
        if($Display == 'no'){
            $Display = 0;
        } else {
            $Display = 1;
        }
        if(empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($confirmPassword)){
            $result = false; 
        }
        else{
            $result = true;
        }

        if($password !== $confirmPassword){
            $result = false;
            header("Location: register.php?error=PasswordsDontMatch");
        }

        if (preg_match("/^[A-Za-z0-9]*$/", $username)){
            $result = true;
        }
        else{
            $result = false;
            header("Location: register.php?error=InvalidUsername");
        }
        $sql_statement = "SELECT * FROM Users WHERE Username = '.$username'";
        mysqli_query($conn, $sql_statement);
        if($row !== mysqli_fetch_assoc($sql_statement)){
            $result = false;
            //check if user exists 
        }

        if($result == true){
            $hashpass = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO Users (Username, FirstName, LastName, Password, Display) VALUES ('$username', '$firstname', '$lastname', '$hashpass', '$Display');";
            if ($conn->query($sql) === TRUE) {
               $_SESSION["username"] = $username;
            } else {
            }
        }
    }
    if(isset($_POST["logout"])) {
        session_unset(); 
        session_destroy();
        header("Location: index.php");
    }
    if ('POST' === $_SERVER['REQUEST_METHOD']){
        if(isset($_POST["loginbtn"])){
            $sql_statement = "SELECT * FROM Users WHERE Username = '".$username."';";
            if($res = mysqli_query($conn, $sql_statement)){
                $row = mysqli_fetch_assoc($res);
                $pwdTocheck = $row["Password"];
                if (password_verify($password, $pwdTocheck)){
                    session_start();
                    $_SESSION["username"] = $row["Username"];
                    header("Location: index.php");
                    exit();
                }             
            }
        }
    }
         
?>
<html>
<link rel="stylesheet" href="static/style.css">

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
    <div class="main">
        <div class="box" style="display: block;">
            <?php if(isset($_SESSION["username"])) :?>
                <form action="index.php" method="post">
                    <p class="customfont" style="color: #0D1321" style="text-align: center"><b>Welcome to Tetris</b></p>
                    <p class="customfont2" style="color: blue" style="text-align: center"><a href="tetris.php">Click here to play</a></p>
                    <hr>
                    <button name="logout">
                        Logout
                    </button> 
                    
                </form>
           
            <?php else : ?>
                <form action="index.php" method="post">
                    <p class="customfont" style="color: #0D1321" style="text-align: center"><b>Login</b></p>
                    <label for="username" class="customfont2"><b>Username</b></label>
                    <br>
                    <input type="text" placeholder="username" name="username" required>
                    <hr>

                    <label for="password" class="customfont2"><b>Password</b></label>
                    <br>
                    <input type="password" placeholder="Password" name="password" required>
                    <hr>
                    <button type="submit" name="loginbtn"> Login </button>
                        
                

                    <br>
                    <p class="customfont2" style="color: #0D1321" style="text-align: center"><b>Don't have a user
                            account?</b></p>
                    <p class="customfont2" style="color: blue" style="color: #blue"><a href="register.php">Register Now</a>
                    </p>
                </form>
            <?php endif; ?>
        </div>
    </div>




</body>

</html>