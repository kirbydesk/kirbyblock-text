<?php return [
	'blocks/pwtext' => pwBlueprint::main('pwtext', fn($cfg) => [
		'name'          => 'kirbyblock-text.name',
		'icon'          => 'text-left',
		'contentFields' => pwBlueprint::stdContent($cfg, ['tagline', 'heading', 'editor', 'buttons']),
	]),
];
