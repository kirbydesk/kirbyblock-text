<?php

pwConfig::register('pwtext', __DIR__ . '/src/config');

Kirby::plugin('kirbydesk/kirbyblock-text', [
	/* -------------- Extensions --------------*/
	'blueprints' => require_once 'src/extensions/blueprints.php',
	'snippets' => require_once 'src/extensions/snippets.php',
	'translations' => require_once 'src/extensions/translations.php'
]);