<?php $title = $player['name'] ?>
<?php $view->extend('::layout.html.php') ?>

	<h1><?php echo $player['name'] ?></h1>

	<div class="name"><?php echo $player['name'] . $player['lastname'] ?></div>