<div id="container">
<h1> 5 <u>NEWEST</u> clans! <a href="viewclans.php">(view all clans)</a></h1>
	<?php 
		$latestclans = latestclans();
		foreach($latestclans as $lc):
	?>
	<div id="latestplayers">
		<span id="latestplayers_name"><a href="clans.php?id= <?php echo $lc['id']; ?> "> <?php echo $lc['name']; ?> </a></span><div id="rating-container">Rating of <?php echo $lc['rating']; ?> (<a href="helc.php?ratings">?</a>)</div>
			Kills: <?php $lc['kills']; ?> <br> Deaths: <?php echo $lc['deaths']; ?> <br> Ratio: <?php echo $lc['kills']/$lc['deaths']; ?>
		<br>
			<a href="#" > Contact </a>
	</div> <br>
</div>
<?php endforeach; ?>