/**************
PAGE JS
**************/

var red = 255;
var green = 255;
var blue = 255;

function popup(){
    document.getElementById("myPopup").style.display = "block";
}

function closePopup(){
    document.getElementById("myPopup").style.display = "none";
}

function popup2(){
    document.getElementById("customizePopup2").style.display = "block";
    
    var input = document.querySelectorAll("input");
    for (var i = 0; i < input.length; i++) {
        
        input[i].addEventListener("input", function colorPicker(){
            red = document.getElementById("red").value;
            green = document.getElementById("green").value;
            blue = document.getElementById("blue").value;

            var display = document.getElementById("customBall");
            display.style.background = "rgb(" + red + "," + green + "," + blue + ")";
        });
    }
}

function closePopup2(){
document.getElementById("customizePopup2").style.display = "none";
}

/**************
GAME JS
**************/


var player;
var enemy;

var enemies;
var numberOfEnemies;
var walls;

var topWall;
var rightWall;
var bottomWall;
var leftWall;

var gameOver = false;
var win = false;


var level;

var buttons;
var buttons2;

var msg;

var eat = new Audio("Sounds/eat.mp3");
var crash = new Audio("Sounds/crash.mp3")
var victory = new Audio("Sounds/win.mp3");


function setup() {
    colorMode(RGB, 255, 255, 255, 1);

    var myCanvas = createCanvas(700, 700); //automatically creates a canvas in p5
    myCanvas.parent("sketchDiv"); //adds parent div to canvas


    walls = new Group(); //groups are kinda like arrays but p5 version, but you can give them behaviours and not just loop through them

    function createWall(name,x,y,width,height){
        name = createSprite(x, y, width, height);
        name.shapeColor = color(0,0,255);
        name.immovable = true; //immovable means that if something bounces against it, it doesn't move. Only the other element that bounces moves.
        walls.add(name); //adds a sprite to a group
    }
    createWall("topWall", 0, 0, width*2, 10);
    createWall("rightWall", width, height, 10, height*2);
    createWall("bottomWall", 0, height, width*2, 10);
    createWall("leftWall", 0, 0, 10, height*2);

    player = createSprite(0,0,40,40);
}


function draw() {

    if (level == 1){
        drawHolder(0.01, 200); //attraction, maxspeed
    }

    if (level == 2){ 
        drawHolder(0.04, 4.0); 
    }

    if (level == 3){ 
        drawHolder(0.06, 5.0); 
    }

    if (level == 4){ 
        drawHolder(0.08, 6.0); 
    }

    if (level == 5){ 
        drawHolder(0.1, 9.0); 
    }
}

function setLevel(levelNum){ // enemy configuration previously in setup

    level = levelNum;
    gameOver = false;
    win = false;
    disableButtons(); // when a level has started (when you've clicked a lvel button in html and passed a levelNum), you cannot click another button


    if (level == 1) { 
    createEnemies(12);
    }

    if (level == 2) { 
    createEnemies(12);
    }

    if (level == 3) { 
    createEnemies(12);
    }

    if (level == 4) { 
    createEnemies(12);
    }

    if (level == 5) { 
    createEnemies(15);
    }
}



function drawHolder(attraction, maxSpeed){ 
/* enemy config previously in draw (this is basically the game, 
it draws everything that happens just like built in draw function in p5)*/

/*
this is so we can pass these functions with parameters
*/

                background(0);
              

                drawSprites();

                enemies.bounce(enemies);
                enemies.bounce(walls);

                for (var i = 0; i < enemies.length; i++) {
                    enemies[i].attractionPoint(attraction, mouseX, mouseY); //attractionpoint is a funcionality for having objects move towards something
                    enemies[i].maxSpeed = 2;
                }

                player.position.x = mouseX; //mouseX and mouseY are built in p5 to find the mouse location
                player.position.y = mouseY;

                for (var i = 0; i < enemies.length; i++) {
                    if(player.overlap(enemies[i])){ //overlap is built in p5 for when something overlaps
                        if(player.width >= enemies[i].width){
                            eat.play();
                            indexOfEaten = enemies.indexOf(enemies[i]);
                            eatOrBeEaten(indexOfEaten);
                            player.width = player.width + 8;
                            player.height = player.height + 8;
                        }else{
                            crash.play();
                            numberOfEnemies = 0;
                            gameOver = true;
                            enableButtons();
                        }
                    }
                }

                function eatOrBeEaten(index){
                    enemies[index].remove();
                    numberOfEnemies--;

                    if(numberOfEnemies == 0){
                        victory.play();
                        win = true;
                        player.height = 40;
                        player.width = 40;
                        var lvlCount = level+1; //lvlCount is +1 to be able to unlock the next level, we apply this  number on the levelID to know which "next" level is, which one to unlock
                        var levelID = "lvl" + lvlCount;
                        enableButtons();
                        if (level < 5) { //if the level is less than 5 we unlock the next level when we win, after 5 we have no more levels
                            document.getElementById(levelID).setAttribute("class", "unlockedButton");
                            enableButtons();
                        }
                    }
                }

                player.draw = function(){
                    strokeWeight(player.width/8);
                    stroke(255,255,255,0.5);
                    fill(red,green,blue);
                    ellipse(0,0,player.width,player.height);
                }

                if(gameOver){

                    for (var i = 0; i < enemies.length; i++) {
                        enemies[i].remove();
                    }
                    textSize(65);
                    textAlign(CENTER);
                    fill(255, 255, 255);
                    msg = 'GAME OVER'
                    text(msg, width/2, height/2);
                    player.height = 40;
                    player.width = 40;
                }

                if(win){ 
                    textSize(60);
                    textAlign(CENTER);
                    fill(255, 255, 255);
                    msg = "LEVEL " + level + " COMPLETED"
                    text(msg, width/2, height/2);
                }
}


function createEnemies(enemyNum){

        numberOfEnemies = enemyNum;
        enemies = new Group();


        function createEnemy(x,y,size, color1, color2, color3){
            enemy = createSprite(x,y,size,size);
            enemy.setCollider("circle");
            enemies.add(enemy);

            enemy.draw = function(){ //draw is a built in function for sprites in p5 that you can customize
                strokeWeight(size/8);
                stroke(color1+30,color2+30,color3+30,0.5);
                fill(color1,color2,color3);
                ellipse(0,0,size,size);
            }
        }

    for (var i = 1; i < numberOfEnemies + 1; i++) {
        createEnemy( Math.floor(random(500))+100, Math.floor(random(500))+100, 10*i, random(245)+20, random(245)+20, random(245)+10);
    }
}

function disableButtons(){
    buttons = document.querySelectorAll("button"); // this creates a nodelist
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = true; // this is how you disable a button, could also use getelementbyid and then the var.disabled = true
    }
}

function enableButtons(){
    buttons = document.querySelectorAll(".unlockedButton"); // this creates a nodelist
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].disabled = false; // this is how you enable a button
        }

    buttons2 = document.querySelectorAll(".headerButt"); // this creates a nodelist
        for (var i = 0; i < buttons2.length; i++) {
            buttons2[i].disabled = false;
        }

}







