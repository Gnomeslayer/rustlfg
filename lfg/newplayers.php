<div id="container">
<h1> 5 <u>NEWEST</u> players! <a href="viewplayers.php">(view all players)</a></h1>
	<?php 
		$latestplayers = latestplayers();
		foreach($latestplayers as $lp):
	?>
	<div id="latestplayers">
		<span id="latestplayers_name"><a href="players.php?id= <?php echo $lp['id']; ?> "> <?php echo $lp['name']; ?> </a></span><div id="rating-container">Rating of <?php echo $lp['rating']; ?> (<a href="help.php?ratings">?</a>)</div>
			<br>Kills: <?php echo $lp['kills']; ?> <br> Deaths: <?php echo $lp['deaths']; ?> <br> Ratio: <?php echo $lp['kills']/$lp['deaths'];?>
		<br>
			<a href="#" > Contact </a>
	</div> <br>
</div>
<?php endforeach; ?>
