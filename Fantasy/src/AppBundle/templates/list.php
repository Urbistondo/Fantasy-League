<?php $title = 'List of players' ?>
<?php ob_start() ?>
	<h1>List of players</h1>
	<ul>
		<?php foreach ($players as $player): ?>
		<li>
			<a href="/show.php?id=<?php echo $player['id'] ?>">
				<?php echo $player['title'] ?>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>