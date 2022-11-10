var grid = new Array(10);
var gameDiv = document.getElementById("tetris-bg");
var scoreDiv = document.getElementById("score");
var gameEndCheck = true;
var flag = true;
score = 0;

for (var i = 0; i < 20; i++) {
    grid[i] = new Array(20);
    for (var y = 0; y < 10; y++) {
        grid[i][y] = ""
    }
}

function startGame() {
    document.getElementById("start").style.visibility = "hidden";
    spawnBlock()
}


function pickBlock() {
    const value = Math.floor(Math.random() * (5 + 1)) + 0;
    switch (value) {
        case 0:
            return "L";
        case 1:
            return "Z";
        case 2:
            return "S";
        case 3:
            return "T";
        case 4:
            return "O";
        case 5:
            return "I";
    }
}

function spawnBlock() {
    if(gameEndCheck === true){
        const gamepieces = {
            L: [[1, 1], [1, 2], [1, 3], [2, 3]],
            Z: [[1, 1], [2, 1], [2, 2], [3, 2]],
            S: [[1, 2], [2, 1], [2, 2], [3, 1]],
            T: [[1, 1], [2, 1], [2, 2], [3, 1]],
            O: [[1, 1], [1, 2], [2, 1], [2, 2]],
            I: [[1, 1], [1, 2], [1, 3], [1, 4]]
        }

        var shapeLetter = pickBlock();
        currentBlock = gamepieces[shapeLetter];
        var currentBlockHold = document.createElement("div");
        currentBlockHold.setAttribute("class", "Falling");
        console.log(currentBlock)
        console.log("Created and assigned a div to Falling");

        for (var i = 0; i < currentBlock.length; i++) {
            currentBlockHold.appendChild(createDiv(currentBlock[i][0], currentBlock[i][1], shapeLetter));
        }

        for(var i=0; i<currentBlock.length; i++){
            if(grid[currentBlock[i][1]][currentBlock[i][0]] === "set"){
                gameEndCheck = false;
                sendInfo();
            }
        }
        if(gameEndCheck){
            gameDiv.appendChild(currentBlockHold);
            drop = setInterval(moveBlock, 1000);
            scoreDiv.innerHTML = "Score =" + score;
        }
    }
    
}

function createDiv(x, y, letter) {
    spawnDiv = document.createElement("div");
    spawnDiv.setAttribute("class", "block");

    spawnDiv.style.transform = `translate(${x * 30}px, ${y * 30}px)`;

    switch (letter) {
        case "L":
            spawnDiv.style.backgroundColor = "#fffd82"; //yellow
            break;

        case "Z":
            spawnDiv.style.backgroundColor = "#fb8b24"; //orange
            break;

        case "S":
            spawnDiv.style.backgroundColor = "#f49fbc"; //pink
            break;

        case "T":
            spawnDiv.style.backgroundColor = "#990d35"; //red
            break;

        case "O":
            spawnDiv.style.backgroundColor = "#7cdedc"; //aqua
            break;

        case "I":
            spawnDiv.style.backgroundColor = "#388659"; //green
            break;
    }
    return spawnDiv;
}

function moveBlock() {
    var dropBlock = document.querySelector(".Falling");
    var children = dropBlock.childNodes;

    if (checkForCollisions()) {
        for (var i = 0; i < children.length; i++) {
            grid[currentBlock[i][1]][currentBlock[i][0]] = "set";
        }
        clearInterval(drop);
        score ++;
        dropBlock.setAttribute("class", "notFalling");
        spawnBlock();
        
    }
    else {
        for (var i = 0; i < children.length; i++) {
            grid[currentBlock[i][1]][currentBlock[i][0]] = "";
            currentBlock[i][1] += 1;
            children[i].style.transform = `translate(${currentBlock[i][0] * 30}px, ${currentBlock[i][1] * 30}px)`;
        }
        //console.table(grid);
    }
}

function checkForCollisions() {
    for (var i = 0; i < 4; i++) {
        if ((currentBlock[i][1]) * 30 === 570 || grid[currentBlock[i][1] + 1][currentBlock[i][0]] === "set") {
            
            if((grid[currentBlock[i][0]][currentBlock[i][1]]) ===  "set"){
                return true;
            }
            return true;
        }
    }
    return false;
}

document.addEventListener("keydown", controlBlocks);

function controlBlocks(e) {
    const key = e.keyCode;
    var dropBlock = document.querySelector(".Falling");
    if (dropBlock !== null) {
        var children = dropBlock.childNodes;

        switch (key) {
            case 37:
                console.log("Left");

                for (var i = 0; i < 4; i++) {

                    if (currentBlock[0][0] > 0 && grid[currentBlock[i][1] - 1][currentBlock[i][0]] !== "set") {
                        for (var i = 0; i < children.length; i++) {
                            currentBlock[i][0] -= 1;
                            children[i].style.transform = `translate(${currentBlock[i][0] * 30}px, ${currentBlock[i][1] * 30}px)`;
                        }
                    }
                }
                break;

            case 39:
                console.log("Right");

                for (var i = 0; i < 4; i++) {
                    if (((currentBlock[3][0]) < 9) && grid[currentBlock[i][1] + 1][currentBlock[i][0]] !== "set") {

                        for (var i = 0; i < children.length; i++) {
                            currentBlock[i][0] += 1;
                            children[i].style.transform = `translate(${currentBlock[i][0] * 30}px, ${currentBlock[i][1] * 30}px)`;
                        }
                    }
                }
                break;

            case 38:
                console.log("Up");

                break;

            case 40:
                console.log("Down");

                if (checkForCollisions() !== true) {
                    for (var i = 0; i < 4; i++) {
                        currentBlock[i][1] += 1;
                        children[i].style.transform = `translate(${currentBlock[i][0] * 30}px, ${currentBlock[i][1] * 30}px)`;
                    }
                }
                break;

            case 32:
                console.log("Space");

                while (checkForCollisions() !== true) {
                    for (var i = 0; i < children.length; i++) {
                        currentBlock[i][1] += 1;
                        children[i].style.transform = `translate(${currentBlock[i][0] * 30}px, ${currentBlock[i][1] * 30}px)`;
                    }
                }
                break;
        }
    }

}


function sendInfo() {
    console.log("here")
    console.log(score);
    var results = document.createElement("form");
    var finalScore = document.createElement("input");
    results.method = "POST";
    results.action = "leaderboard.php"
    finalScore.value = score;
    finalScore.name = "Score";
    results.appendChild(finalScore);
    document.body.appendChild(results);
    results.submit();

}