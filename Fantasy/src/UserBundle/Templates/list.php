<?php $title = 'List of players' ?>
<?php $view->extend('::layout.html.php') ?>

<?php $view['slots']->set('title', 'List of players') ?>

<h1>List of players</h1>
<ul>
	<?php foreach ($players as $player): ?>
	<li>
		<!--<a href="<?php echo $view['router']->generate('blogger_blog_show', array('id' => $post->getId())) ?>">-->
			<?php echo $player->getName() ?>
		<!--</a>-->
	</li>
	<?php endforeach; ?>
</ul>