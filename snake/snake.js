/* Devin Miller */

let container = document.querySelector(".gameContainer");
let canvas = document.querySelector(".game");
let grid = document.querySelector(".grid");
let tableBody = document.querySelector(".snakeInfo");
let deathTableBody = document.querySelector(".deathSnakeInfo");
let deathCounter = document.querySelector(".deathCounter");
let shrinkHint = document.querySelector(".shrinkHint");
let endlessNewGame = document.querySelector(".endlessNewGame");
let gameOverMenu = document.querySelector(".gameOverMenu");
let ctx = canvas.getContext("2d");
let gtx = grid.getContext("2d");

let size = 250;
let blockSize = 10;

let gridDisplay = "none";
grid.style.display = "none";

canvas.width = size;
canvas.height = size;
grid.height = size;
grid.width = size;


/*== GAME ==*/

/* Game.init
    - Set keybindings and colors for each snake up to four snakes.
    - If the game type is multiplayer then make multiple snakes and add to the snakesAlive count for each one.
    - In single player add one snake and one to snakesAlive count.
    - If the game mode is lives then multiply the snakesAlive count by 3 and change the header of last column in the infomation table to "Lives".
    - If the game mode is endless then add an end game button below the canvas.
    - If the game mode is shrink display the showHint and set a timeout for Game.shrinkGame.
    - If the game mode is not Tron then add coins to the game.
   
  * Game.getRandomPosition
    - Gets a random position given the current size of the canvas and the current blockSize.
  
  * Game.endGame
    - Used for endless mode. Will end the game on the press of the end game button.
    - Sets the game mode to classic so that the snake can now die, Triggers Game.gameover.
  
  * Game.shrinkGame
    - When the game is in shrink mode this is used to gradually add a larger border to a div as to hint to the player as to what area of the canvas is still playable.
    
  * Game.check
    - Checks if the snakes head is running into anything of importance.
    - If the item has been run over then delete it from the items object.
    - If the item is a coin then a new coin will be placed and the snake will grow.
    - If the snakes has run into itself or another snake then it will "die".
    
  * Game.addSnake
    - Add all spaces containing snake to items object using Game.addItem.
    
  * Game.removeSnake
    - When a snake dies it needs to be removed from items object so other snakes do not collide with dead snake.
    - If a snake has died subtract 1 from alive snakes for detecting when all snakes are dead and the game can end.
    - If the gameMode is not endless and there are 0 snakesAlive then end the game.  If the game mode was shrink normalize the shrinkHint to default state.
    
  * Game.gameOver
    - Removes shrinkHint if it is currently displayed.
    - Opens game over menu.
    
  * Game.removeItem
    - Deletes specified y coord from the specified x coord in the items object.
    
  * Game.addItem
    - Add item to items object. If the items x coord already has an object add the items y coord as a key in the x coord object.
    - Structure -> items: {x: {y: "coin", y2: "snake"}, 11: {3: "coin", 33: "snake"}}.
    
  * Game.addSnakeInfo
    - For each snake in the current game add a row of information about the snake.
    - This information includes the snakes color, length, score, and deaths.
    - For the snake color add a div with the snakes color.
    - If the game mode is lives then add a set number of "heart" divs to the last column.
    
  * Game.updateSnakeInfo
    - Get the snake row in the information table below the game.
    - Update the current snakes length, score, and death count in the row.
    - If the game mode is lives then depending on how many deaths a snake has remove a set number of "hearts" from the lives section of the snakes info row.
*/

class Game {
  constructor(coinCount = 1, gameType = "single", snakeCount = 1, gameMode = "classic", snakeSpeed = 40) {
    this.items = {};
    this.coinCount = coinCount;
    this.gameType = gameType;
    this.gameMode = gameMode;
    this.snakeCount = snakeCount;
    this.snakeSpeed = snakeSpeed;
    this.snakesAlive = 0;
    this.snakeLength = 4;
    
    if(this.gameMode == "shrink") {
      this.originalSize = size;
    } else if(this.gameMode == "tron") {
      this.snakeLength = 1;
    }
  }
      
  init() {
    let snakeKeyCodeBindings = [
    //w a s d
    {83: "down", 68: "right", 87: "up", 65: "left"},
    // arrow keys
    {40: "down", 39: "right", 38: "up", 37: "left"},
    //j k u h
    {74: "down", 75: "right", 85: "up", 72: "left"},
    //v b f c
    {86: "down", 66: "right", 70: "up", 67: "left"}
    
    
    ];
    let colors = ["blue","red","green","purple"];
    
    if(this.gameType == "multi") {
      for(let x = 0; x < this.snakeCount; x++){
        new Snake(this, this.getRandomPosition(), this.getRandomPosition(), this.snakeLength, colors[x], snakeKeyCodeBindings[x], this.snakeSpeed).init();
        this.snakesAlive += 1;
      }
    } else {
      new Snake(this, this.getRandomPosition(), this.getRandomPosition(), this.snakeLength, "blue",undefined, this.snakeSpeed).init();
      this.snakesAlive += 1;
    }
    
    if(this.gameMode == "lives") {
      this.snakesAlive *= 3;
      deathCounter.innerText = "Lives";
    } else {
      deathCounter.innerText = "Deaths";
    }
    
    if(this.gameMode == "endless"){
      endlessNewGame.style.display = "block";
      endlessNewGame.addEventListener("click", () => { this.endGame(); });
    } else {
      endlessNewGame.style.display = "none";
    }
    
    if(this.gameMode == "shrink") {
      shrinkHint.style.display = "block";
      setTimeout(this.shrinkGame.bind(this,1),1000);
    }
    
    if(this.gameMode != "tron") {
      canvas.style.background = "white";
      gtx.strokeStyle = "white";
      if(this.gameMode == "classic") {
        this.coin = new Coin(this);
        this.coin.place();
      } else {
        this.coin = new Coin(this);
        [...Array(this.coinCount)].forEach(coin => this.coin.place());
      }
    } else {
      canvas.style.background = "black";
      gtx.strokeStyle = "black";
    }
    
    for(let c = 0; c < size / blockSize; c++){
      gtx.beginPath();
      gtx.moveTo(0, c * blockSize);
      gtx.lineTo(size,c * blockSize);
      gtx.moveTo(c * blockSize, 0);
      gtx.lineTo(c * blockSize,size);
      gtx.stroke();
    }
  }
  
  getRandomPosition() {
    return Math.floor(Math.random() * size / blockSize) * blockSize;
  }
  
  endGame() {
    this.gameMode = "classic";
    this.gameOver();
  }
  
  shrinkGame(i) {
    if(size - (blockSize * i) > blockSize * 10 && this.snakesAlive > 0) {
      size -= (blockSize * i);
      shrinkHint.style.width = `${size}px`;
      shrinkHint.style.height = `${size}px`;
      shrinkHint.style.borderRight = `solid black ${((this.originalSize - size))}px`;
      shrinkHint.style.borderBottom = `solid black ${((this.originalSize - size))}px`;
      setTimeout(this.shrinkGame.bind(this,++i),1000);
    }
  }
  
  check(x, y, snake) {
    if(this.items[x.toString()] && this.items[x.toString()][y.toString()]) {
      let typeOfItem = this.items[x.toString()][y.toString()];
      this.removeItem(x, y);
      
      if(typeOfItem == "coin") {
        this.coin.place();
        snake.grow();
      } else if (typeOfItem == "snake") {
        snake.reset();
      }
    }
  }
  
  addSnake(snake) {
    snake.space.forEach(space => {
      this.addItem(space.x, space.y, "snake");
    });
  }
  
  removeSnake(snake) {
    this.snakesAlive -= 1;
    
    snake.space.forEach(space => {
      this.removeItem(space.x, space.y);
      ctx.clearRect(space.x,space.y,blockSize,blockSize);
      ctx.beginPath();
    });
    
    if(this.snakesAlive === 0 && this.gameMode != "endless") {
      this.gameOver();
      
      if(this.gameMode == "shrink") {
        size = this.originalSize;
        shrinkHint.style.width = `${size}px`;
        shrinkHint.style.height = `${size}px`;
        shrinkHint.style.borderRight = "none";
        shrinkHint.style.borderBottom = "none";
      }
    }
  }
  
  updateDeathTable() {
    let gameTable = tableBody.cloneNode(true);
    let tableRows = gameTable.querySelectorAll('tr');
    console.log(tableRows);
    for (var i = 0; i < tableRows.length; i++) {
      tableRows[i].className = "";
    }
    
    while(deathTableBody.firstChild) {
      deathTableBody.removeChild(deathTableBody.firstChild);
    }
    for (var i = 0; i < tableRows.length; i++) {
      deathTableBody.appendChild(tableRows[i]);
    }
    
  }
  
  gameOver() {
    this.updateDeathTable();
    
    shrinkHint.style.display = "none";
    gameOverMenu.style.display = "flex";
    setTimeout(() => { gameOverMenu.style.transform = "translate3d(0px,0px,0px)"; },200);
  }
  
  removeItem(x,y) {
    if(this.items[x.toString()] && this.items[x.toString()][y.toString()]) {
      delete this.items[x.toString()][y.toString()];
    }
  }
  
  addItem(x, y, type) {
    this.items[x.toString()] = this.items[x.toString()] || {};
    this.items[x.toString()][y.toString()] = type;
  }
  
  addSnakeInfo(snake) {
    let tr = document.createElement("tr");
    let td = document.createElement("td");
    let info = [snake.color, snake.length, snake.score, snake.deaths];
    
    tr.className = snake.color + "Snake";
    
    info.map((item,i) => {
      let t = td.cloneNode(false);
      if(item == snake.color) {
        let colorDiv = document.createElement("div");
        
        colorDiv.style.width = "100%";
        colorDiv.style.height = "20px";
        colorDiv.style.background = item;
        
        t.appendChild(colorDiv);
      } else if (i == info.length - 1 && this.gameMode == "lives") {
        let heart = document.createElement("div");
        heart.className = "heart";
        
        t.className = "livesContainer";
        
        for(let m = 0; m < 3; m++){
          t.appendChild(heart.cloneNode(true));
        }
      } else {
        t.appendChild(document.createTextNode(item));
      }
      
      tr.appendChild(t);
    });
    
    tableBody.appendChild(tr);
  }
  
  updateSnakeInfo(snake) {
    let tableRow = document.querySelector(`.${snake.color}Snake`);
    let info = [snake.length, snake.score, snake.deaths];
    
    info.map((item,i) => {
      if(i == info.length - 1 && this.gameMode == "lives") {
        let lives = tableRow.querySelector(".livesContainer");
        if(lives.childNodes.length != (3 - snake.deaths)) {
          lives.removeChild(lives.lastChild);
        }
      } else {
        tableRow.childNodes[i+1].innerText = item;
      }
    });
    
    if(this.snakesAlive === 0 && this.gameMode != "endless") {
      this.updateDeathTable();
    }
  }
}

/*== COIN ==*/

/* Coin.place
    - Using a random x and y position add a coin to the game items object as well as place it visually on the canvas.
*/

class Coin {
  constructor(gameobj) {
    this.gameobj = gameobj;
    this.color = "#ff7f00";
    this.x;
    this.y;
  }
  
  place() {
    this.x = this.gameobj.getRandomPosition();
    this.y = this.gameobj.getRandomPosition();
    if(this.gameobj.items[this.x.toString()] && this.gameobj.items[this.x.toString()][this.y.toString()]){
      this.place();
    }
    this.gameobj.addItem(this.x, this.y, "coin");
    ctx.fillStyle = this.color;
    ctx.fillRect(this.x, this.y, blockSize, blockSize);
  }
}

/*== SNAKE ==*/

/* Snake.initKeyBindings
    - If snake hasn't been given keybindings set them to the defaults.
    - On keydown, if the key exists in the keybindings and if the direction is not the opposite of the one the snake is currently traveling, then set the new direction of the snake to the key that was pressed.
    - So that movement is more responsive to user, trigger Snake.move on all valid direction changes by key
    .
  * Snake.init
    - Gets the default length so that when snake dies it will always return to a set length.
    - Resets space to an empty array so that the snake isn't in two places on respawn.
    - Fills the direction array with the chosen direction by Snake.determineStartDirection.
    - For the length of the snake add the blocks of snake at appropriate coordinates with the appropriate directions.
    - Start movement interval and update snakes position in the game with Game.updateSnakeInfo.
    
  * Snake.determineStartDirection
    - Determines if the snake should spawn going up or down to avoid nearly instant out of bounds collisions. Depends on the y coordinates that it will be on.
    
  * Snake.grow
    - If the snake has run over a coin (food) then the space before itself will become part of it.
    - The direction of the new last block of the snake will be the same as the previous last block.
    - A set number of points will be added to the score.
    
  * Snake.getSpaceBefore
    - For getting the space before the snakes last block (part).
    - The space before the last block of the snake will depend on the direction of it.
    
  * Snake.removeSpaceBefore
    - Removes the space before the snake so that it looks like it is moving instead on growing continuously.
    - Also removes space from game so that players don't run into it.
    
  * Snake.checkOutOfBounds
    - Checks if the head of the snake is outside the bounds of the canvas.
    - If the snakes head is outside the canvas then the Snake.reset will be run and the snake will "die".
    
  * Snake.move
    - Runs Game.check to check if it is running into anything (like a coin, another snake, or itself).
    - Adds itself with Game.addSnake so that it can be run into by other players.
    - Checks if snake it has gone outside canvas.
    - If the game mode is not tron then remove the space before so that the snake is not a continuous line from its creation.
    - For the snakes current length add each block (part) of the snake. Depending on the direction given to each block it is set to it's next position which can be to the left,right,up,or down from its previous position.
    - The part of the snake is then given the next direction. So the head of the snake will always move in the direction that user wills almost immediately while over time all other parts of the snake will follow.
    - The direction array is given a new direction and the oldest direction is removed from the array.
    
  * Snake.draw and Snake.clear
    - Draw a block on the canvas.
    - Clear a block from the canvas.
    
  * Snake.reset
    - Adds a death to the snake.
    - Clears this.interval which is most likely Snake.move.
    - Removes snake from the canvas so other snakes can't run into the dead snake. Also removes the space before the snake since the Snake.move method usually does this but is not running anymore.
    - Depending on game mode the game will be over after one death, if the game is in endless or there are more lives then the snake will be moved to a new starting position and respawned.
*/

class Snake {
  constructor(gameobj = this, x = 0, y = 0, length = 10, color = "blue", keybindings = "default", snakespeed = 40) {
    // Store set defaults for when snake is reset and reinitialized.
    this.defaults = {length: length};
    this.gameobj = gameobj;
    this.color = color;
    this.length = length;
    this.snakeSpeed = snakespeed;
    this.interval;
    this.keybindings = keybindings;
    this.initKeyBindings();
    this.deaths = 0;
    this.score = 0;
    this.x = x;
    this.y = y;
    this.oppositeDirections = {"down": "up", "up": "down", "left": "right", "right": "left"};
    
    this.gameobj.addSnakeInfo(this);
  }
  
  initKeyBindings() {
    if(this.keybindings == "default") {
      this.keybindings = {83: "down", 68: "right", 87: "up", 65: "left", 40: "down", 39: "right", 38: "up", 37: "left"};
    }
    
    document.addEventListener("keydown", e => {
      if(this.keybindings[e.which] !== undefined) {
        if(this.direction != this.oppositeDirections[this.keybindings[e.which]] && this.direction != this.keybindings[e.which]) {
          this.direction = this.keybindings[e.which];
          
          if(!(this.gameobj.gameMode == "classic" && this.deaths !== 0)) {
            this.move();
          }
        }
      }
    });
  }
  
  init() {
    let length = this.defaults.length;
    this.space = [];
    this.length = length;
    this.directions = Array(length).fill(this.determineStartDirection(this.y));
    this.direction = this.determineStartDirection(this.y);
    
    for(let i = 0; i < this.length; i++) {
      if(this.direction == "up") {
        this.space.push({x: this.x,y: this.y - (blockSize * i),direction: this.direction});
      } else {
        this.space.push({x: this.x,y: this.y + (blockSize * i),direction: this.direction});
      }
    }
    this.gameobj.updateSnakeInfo(this);
    this.reseting = false;
    this.interval = setTimeout(this.move.bind(this),this.snakeSpeed);
  }
  
  determineStartDirection(y) {
    if(y > Math.floor(size / 2)) {
      return "up";
    } else {
      return "down";
    }
  }
  
  grow() {
    this.length += 1;
    this.score += 2;
    
    this.gameobj.updateSnakeInfo(this);
    let spaceBefore = this.getSpaceBefore(this.space[0].x,this.space[0].y, this.space[0].direction);
    
    this.space.unshift({x: spaceBefore[0],y: spaceBefore[1],direction: this.space[0].direction});
    this.directions.unshift(this.space[0].direction);
  }
  
  getSpaceBefore(x, y, direction) {
    if(direction == "up") {
      return [x, y + blockSize];
    } else if (direction == "right") {
      return [x - blockSize, y];
    } else if (direction == "down") {
      return [x, y - blockSize];
    }
    
    return [x + blockSize, y];
  }
  
  removeSpaceBefore(x, y, direction) {
    let spaceBefore = this.getSpaceBefore(x,y,direction);
    this.gameobj.removeItem(spaceBefore[0],spaceBefore[1]);
    this.clear(spaceBefore[0],spaceBefore[1]);
  }
  
  checkOutOfBounds() {
    let snakeHead = {x: this.space[this.space.length - 1].x, y: this.space[this.space.length - 1].y};
    if(snakeHead.x > size || snakeHead.x < 0 || snakeHead.y > size || snakeHead.y < 0) {
      this.reset();
    }
  }
      
  move() {
    if(!this.reseting) {
    this.gameobj.check(this.space[this.space.length - 1].x,
                       this.space[this.space.length - 1].y, this);
    this.gameobj.addSnake(this);
    
    if(this.gameobj.gameMode != "tron") {
      this.removeSpaceBefore(this.space[0].x,this.space[0].y,this.space[0].direction);
    }
    
    this.checkOutOfBounds();
    
    ctx.fillStyle = this.color;
    let length = this.space.length;
    for(let i = 0; i < length; i++){
      let direction = this.directions[i];
      let snakePart = this.space[i];
      
      this.draw(snakePart.x, snakePart.y);
      
      // Get next position for each snake part.
      if(direction == "up") {
        snakePart.y = snakePart.y - blockSize;
      } else if (direction == "right") {
        snakePart.x = snakePart.x + blockSize;
      } else if (direction == "down") {
        snakePart.y = snakePart.y + blockSize;
      } else if (direction == "left") {
        snakePart.x = snakePart.x - blockSize;
      }
      
      snakePart.direction = this.directions[i];
    }

    this.directions.push(this.direction);
    this.directions.shift();
    clearTimeout(this.interval);
    this.interval = setTimeout(this.move.bind(this),this.snakeSpeed);
    }
  }
  
  draw(x, y) {
    ctx.fillRect(x, y, blockSize, blockSize);
  }
  
  clear(x, y) {
    ctx.clearRect(x,y,blockSize,blockSize);
    ctx.beginPath();
  }
      
  reset() {
    this.deaths += 1;
    this.score -= 2;
    this.reseting = true;
    clearTimeout(this.interval);
    
    this.removeSpaceBefore(this.space[0].x,this.space[0].y,this.space[0].direction);
    this.gameobj.removeSnake(this);
    
    if(this.gameobj.gameMode == "classic" || this.gameobj.gameMode == "shrink" || this.gameobj.gameMode == "tron" || (this.gameobj.gameMode == "lives" && this.deaths == 3)) {
      this.gameobj.updateSnakeInfo(this);
      this.space = [];
    } else {
      this.x = this.gameobj.getRandomPosition();
      this.y = this.gameobj.getRandomPosition();
      this.init();
    }
  }
}

/*===============
Main Menu
========*/

/* setMenuEventListeners
    - Clicking the multi button or single button will toggle the selected styling of a button off of unselected button and onto selected button.
    - On click, the multiplayer button and single player button will set the gameType.
    - By clicking the multiplayer button a drop down will appear for choosing how many players.
    - gameSize and coinCount input text fields run the function checkIfValid on keyup.
    
  * makeGame
    - Closes the main menu if it has valid information. If it does not have valid numbers in input text fields the menu will be reopened and no game will be made.
    - Gets the values of the selects and input text fields from the menu to create a game accurate to users specifications.
    - If the user enters a strange size it will always be ceiled with the current blockSize in mind so that everything fits nicely in canvas.
    - Sets the width and height of the canvas as well as the container that holds the canvas.
    
  * checkIfValid
    - Checks if there is an event to avoid arrow keys causing errors.
    - Will check if the input value using checkIfValid contains a valid number.
    - If the number is not valid and returns NaN the input will be given a red background hint.
*/

let menuGameType = "single";
let menu = document.querySelector(".menu");
let singleButton = document.querySelector(".gameSingle");
let multiButton = document.querySelector(".gameMulti");
let playButton = document.querySelector(".playButton");
let menuGamePlayers = document.querySelectorAll(".gamePlayers");
let gameSize = document.querySelector(".gameSize");
let coinCount = document.querySelector(".gameCoins");
let keybindingHints = document.querySelector(".keybindingHints");

function setMenuEventListeners() {
  multiButton.addEventListener("click", () => {
    if(multiButton.className == "gameMulti") {
      multiButton.className += " selectedButton";
      singleButton.className = "gameSingle";
      menuGameType = "multi";
      keybindingHints.style.display = "block";
      menuGamePlayers.forEach(gamePlayers => { gamePlayers.style.display = "block"; });
    }
  });
  
  singleButton.addEventListener("click", () => {
    if(singleButton.className == "gameSingle") {
      singleButton.className += " selectedButton";
      multiButton.className = "gameMulti";
      menuGameType = "single";
      keybindingHints.style.display = "none";
      menuGamePlayers.forEach(gamePlayers => { gamePlayers.style.display = "none"; });
    }
  });

  gameSize.addEventListener("keyup", checkIfValid);
  coinCount.addEventListener("keyup", checkIfValid);
  
  playButton.addEventListener("click", makeGame);
}
setMenuEventListeners();

function makeGame() {
  let gameSizeValue = +(gameSize.value);
  let gameModeSelect = document.querySelector(".gameMode");
  let gameMode = gameModeSelect.options[gameModeSelect.selectedIndex].value;
  let playerSelect = document.querySelectorAll(".gamePlayers")[1];
  let players = +(playerSelect.options[playerSelect.selectedIndex].value);
  let gameBlockSelect = document.querySelector(".blockSize");
  let gameBlockSize = +(gameBlockSelect.options[gameBlockSelect.selectedIndex].value);
  let gameSnakeSpeedSelect = document.querySelector(".snakeSpeed");
  let gameSnakeSpeed = +(gameSnakeSpeedSelect.options[gameSnakeSpeedSelect.selectedIndex].value);
  let coinCountValue = +(coinCount.value);
  blockSize = gameBlockSize;
  size = Math.ceil(gameSizeValue / blockSize) * blockSize;
  
  canvas.width = size;
  canvas.height = size;
  grid.width = size;
  grid.height = size;
  container.style.width = `${size}px`;
  container.style.height = `${size}px`;
  
  menu.style.transform = "translate3d(-100%,0px,0px)";
  setTimeout(() => {
    menu.style.display = "none";
  },500);
  
  if(!isNaN(coinCountValue) && !isNaN(size)){
    let game = new Game(coinCountValue, menuGameType, players, gameMode, gameSnakeSpeed);
    game.init();
  } else {
    openGameMenu();
    setTimeout(() => {
      menu.style.display = "flex";
    }, 600);
  }
}

function checkIfValid(e) {
  if(e){
    if(isNaN(+(e.target.value))){
       e.target.style.background = "#F15152";
    } else {
      e.target.style.background = "white";
    }
  }
}

/*===========
Game Over Menu
========*/

/* openGameMenu
    - Closes game over menu if it is open.
    - Will set the menu align items style to flex start if the window becomes too small so the user can still see menu.
    - Opens the main menu using translate3d. setTimeouts are used to coordinate using a stylish open and close animation paired with functional display settings (to none, flex, or block).
    - Resets table information so new statistics can be placed.
    
  * playAgain
    - Will start a new game with exactly the same specifications as the game the player just played.
    - Clears the information table so that new statistics can be inserted.
    - Closes game over menu if it is open.
*/

function openGameMenu() {
  gameOverMenu.style.transform = "translate3d(100%,0px,0px)";
  setTimeout(() => {
    gameOverMenu.style.display = "none";
  },500);
  
  menu.style.display = "flex";
  
  setTimeout(() => {
    menu.style.transform = "translate3d(0px,0px,0px)";
  },200);
  tableBody.innerHTML = "";
}

function playAgain() {
  gameOverMenu.style.transform = "translate3d(100%,0px,0px)";
  setTimeout(() => {
    gameOverMenu.style.display = "none";
  },500);
  
  tableBody.innerHTML = "";
  
  makeGame();
}

function toggleGrid() {
  if(gridDisplay == "block") {
    grid.style.display = "none";
    gridDisplay = "none";
  } else {
    grid.style.display = "block";
    gridDisplay = "block";
  }
}