const canvas = document.getElementById("game-canvas");
const context = canvas.getContext("2d");

const gridWidth = 32;
const gridHeight = 24;

var unitSize;

window.onresize = function(event) {
/*	var containerRect = document.getElementById("game-container").getBoundingClientRect();
	var unitHeight = Math.floor((window.innerHeight - containerRect.top) * 0.95 / gridHeight);
	var unitWidth = Math.floor((containerRect.right - containerRect.left) * 0.95 / gridWidth);*/

	var unitHeight = 12.5;
	var unitWidth = 12.5

	unitSize = unitHeight < unitWidth ? unitHeight : unitWidth;

	canvas.width = gridWidth * unitSize;
	canvas.height = gridHeight * unitSize;
};

window.onresize();

var snake;
var dir;
var requestDir;
var score;
var fruit = {
	x: 0,
	y: 0
};

function initGame() {
	snake = [];
	snake[0] = {
		x: gridWidth/2,
		y: gridHeight/2
	}

	dir = 1;
	requestDir = 1;
	score = 0;

	placeFruit();
}


document.addEventListener('keydown', keyPressed)

function keyPressed(event) {
	if(event.key == 'w' || event.key == 'W')
		requestDir = 0;
	else if(event.key == 'd'  || event.key == 'D') 
		requestDir = 1;
	else if(event.key == 's' || event.key == 'S')
		requestDir = 2;
	else if(event.key == 'a' || event.key == 'A')
		requestDir = 3;
}

function update() {
	
	if(requestDir % 2 != dir % 2) {
		dir = requestDir;
	}

	var head = move();
	
	if(head.x == fruit.x && head.y == fruit.y){
		placeFruit();
		score++
	}else{
		if(snake.length > 3){
			snake.pop();
		}
	}

	for(let i = 0; i < snake.length; i++) {
		if(head.x == snake[i].x && head.y == snake[i].y){
			initGame();
			return;
		}
	}
	snake.unshift(head);

	draw();
}

function move() {
	var x = snake[0].x;
	var y = snake[0].y;

	if(dir == 0) y--;
	else if(dir == 1) x++;
	else if(dir == 2) y++;
	else if(dir == 3) x--;
	
	if(x < 0) {
		initGame();
		return;
	}
	else if(x == gridWidth){
		initGame();
		return;
	}
	
	if(y < 0) {
		initGame();
		return;
	}
	else if(y == gridHeight){
		initGame();
		return;
	}

	return {x: x, y: y};
}

function placeFruit() {
	var isOnSnake = true;
	while(isOnSnake) {
		fruit.x = Math.floor(Math.random() * gridWidth);
		fruit.y = Math.floor(Math.random() * gridHeight);

		isOnSnake = false;
		for(let i = 0; i < snake.length; i++) {
			if(fruit.x == snake[i].x && fruit.y == snake[i].y)
				isOnSnake = true;
		}
	}


}



var backgroundColor = "#1D3E53";
var fruitColor = "#77abb7";
var snekColor = "#fffff0";

if (theme == !theme){
backgroundColor = "#414141";
fruitColor = "#CA3E47";
}

function draw() {
	let root = $(":root");

    // dark background
    context.fillStyle = root.css("--ten");
//    canvas.style.border = '1px solid #fffff0';
    context.fillRect(0, 0, canvas.width, canvas.height);

    // fruit
    context.fillStyle = root.css("--nine");
    context.fillRect(fruit.x * unitSize, fruit.y * unitSize, unitSize, unitSize);

    // snek
    context.fillStyle =  "#fffff0";
    for(let i = 0; i < snake.length; i++) {
        context.fillRect(snake[i].x * unitSize, snake[i].y * unitSize, unitSize, unitSize);
    }

	// score
	context.font = `bold ${unitSize}px monospace`;
	context.fillStyle = "rgb(230, 230, 230)";
	context.fillText(`Score: ${score}`, unitSize * 0.5, unitSize * 1);
}

var isStarted = false;	
$(document).keyup(function(event) {
	if (event.which === 27) {
		if(!isStarted){	
			initGame();
			if(!isStarted){
				var game = setInterval(update, 100);
				isStarted = true;
			}
		}
	}

});
