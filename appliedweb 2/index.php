
 <?php 
  session_start();
  ini_set("display_errors", 1);

  error_reporting(E_ALL);

 include("config.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0>
    <script src="p5/p5.min.js"></script>
    <script src="p5/addons/p5.dom.min.js"></script>
    <script src="p5/addons/p5.sound.min.js"></script>
    <script src="p5/p5.play.js" type="text/javascript"></script>

    <script src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="styling/style.css">
  </head>
   
    <?php include("header.php");?>
  <body>
  <div class="headerImg page-1">
    <img src="styling/Img/hblogo.png" id="logo">
  </div>
    <div id="pageContainer">
     <div id="gameHeader">
        <button class="headerButt" onclick="popup()">How to play?</button>
        <button class="headerButt" onclick="popup2()">Customize your bubble</button>
        <!-- Modal, tips from https://www.w3schools.com/howto/howto_css_modals.asp-->
        <div id="myPopup" class="popup">
          <div class="popup-content">
            <span id="close" onclick="closePopup()">&times;</span>
          
             <p>
              <br><br><br>
              Eat or be eaten. You are a small innocent bubble, but if you wish to survive, you better learn the secrets of cannibalism fast. <br> <br> Use your mouse to move your bubble. Avoid bigger bubbles and eat smaller by running into them and grow in size, until you are ready to take on bigger enemies. Become the biggest bubble to beat the level.<br><br>
              <br>
             </p>
         </div> 
      </div>
        <div id="customizePopup2" class="popup2"> 
          <div class="popup-content2"> 
            <span id="close" onclick="closePopup2()">&times;</span>
            <br>
            <div class="picker">
              <div id="customBall"></div>
              Red <input type="range" min="0" max="255" step="1" id="red" value="255">
              Green <input type="range" min="0" max="255" step="1" id="green" value="255">
              Blue <input type="range" min="0" max="255" step="1" id="blue" value="255">
            </div>

         </div> 
      </div>
    </div>
    
      <div id="skeleton">
        <div class="buttonDiv">
          <button class="play unlockedButton" onclick="setLevel(1)" id="lvl1" ></button>
          <p>Level 1</p>
        </div>
        <div class="buttonDiv">
          <button class="play lockedButton" id="lvl2" onclick="setLevel(2)" disabled></button>
          <p>Level 2</p>
        </div>
        <div class="buttonDiv">
          <button class="play lockedButton" id="lvl3" onclick="setLevel(3)" disabled></button>
          <p>Level 3</p>
        </div>
        <div class="buttonDiv">
          <button class="play lockedButton" id="lvl4" onclick="setLevel(4)" disabled></button>
          <p>Level 4</p>
        </div>
        <div class="buttonDiv">
          <button class="play lockedButton" id="lvl5" onclick="setLevel(5)" disabled></button>
          <p>Level 5</p>
        </div>

    </div>
    <div id="sketchDiv">
    </div>
  </div>
  
  </body>
 <?php include("footer.php");?>
</html>
