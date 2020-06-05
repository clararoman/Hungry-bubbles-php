<header>
	<div class="menu">
      <ul class="topMenu">
        <li><a class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : NULL ?>" href="index.php">Home</a></li>
        
        <li><a class="<?php echo ($current_page == 'about.php') ? 'active' : NULL ?>" href="about.php">About us</a></li>

        <li><a class="<?php echo ($current_page == 'store.php') ? 'active' : NULL ?>" href="store.php">Store</a></li>

        <li><a class="<?php echo ($current_page == 'items.php') ? 'active' : NULL ?>" href="items.php">My items</a></li>

        <li><a class="<?php echo ($current_page == 'contact.php') ? 'active' : NULL ?>" href="contact.php">Contact</a></li>

        <li><a class="<?php echo ($current_page == 'gallery.php') ? 'active' : NULL ?>" href="gallery.php">Gallery</a></li>
		  
		<li><a class="<?php echo ($current_page == 'login.php') ? 'active' : NULL ?>" href="login.php">LOG IN</a></li>

      </ul>
    </div>
    <div id="session">
  <?php
    
    if(isset($_SESSION['username'])){
      echo "Logged in as user: ".$_SESSION['username'];
      echo "<br>";
      echo "User type: ".$_SESSION['userPermission'];
    
  }else{
    session_destroy();
      session_start();
      echo "not logged in";
    }

      
  ?>
</div>
</header>
