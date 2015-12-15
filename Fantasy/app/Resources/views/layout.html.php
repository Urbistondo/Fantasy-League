<!doctype html>
<html>
	<head>
		<title><?php $view['slots']->output('title', 'Default title') ?></title>
	</head>
	<body>
		<?php $view['slots']->output('_content') ?>
	</body>
</html>