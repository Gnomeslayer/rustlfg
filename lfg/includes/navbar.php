<!--    Made by Erik Terwan    -->
<!--   24th of November 2015   -->
<!--        MIT License        -->
<nav role="navigation">
  <div id="menuToggle">
    <!--
    A fake / hidden checkbox is used as click reciever,
    so you can use the :checked selector on it.
    -->
    <input type="checkbox" />
    
    <!--
    Some spans to act as a hamburger.
    
    They are acting like a real hamburger,
    not that McDonalds stuff.
    -->
    <span></span>
    <span></span>
    <span></span>
    
    <!--
    Too bad the menu has to be inside of the button
    but hey, it's pure CSS magic.
    -->
    <ul id="menu">
      <a href="index.php"><li>Home</li></a>
      <a href="searchclan.php"><li>Find a clan</li></a>
      <a href="searchplayer.php"><li>Find a player</li></a>
		<?php if(empty($_SESSION['steamid'])): ?>
			<a href="?login"><li>Login</li></a>
		<?php endif; ?>
		
		<?php if(!empty($_SESSION['steamid'])): ?>
			<a href="registerclan.php"><li>Register a clan</li></a>
			<a href="registerplayer.php"><li>Register yourself</li></a>
			
			<a href="notifications.php"><li>(<?php echo notifications($steamprofile['steamid']); ?>) Notifications</li></a>
			
		<?php endif; ?>
    </ul>
  </div>
</nav>