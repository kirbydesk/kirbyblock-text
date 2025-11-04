<?php return [ 'blocks/pwText' => function () {

		/* -------------- Block Defaults when not set in config --------------*/
		$raw = option('kirbydesk.pagewizard.kirbyblock.pwText', [
			'heading' => false,
			'tagline' => false,
			'text'    => 'textarea', // default mode
		]);


		/* -------------- Text Mode --------------*/
		$cfg 			= is_array($raw) ? $raw : ['text' => $raw];
		$mode 		= $cfg['text'] ?? null;
		$mode			= is_string($mode) ? strtolower(trim($mode)) : null;
		$allowed 	= ['textarea', 'writer', 'markdown', 'code'];
		$type 		= in_array($mode, $allowed, true) ? $mode : 'textarea';


		/* -------------- Heading & Tagline --------------*/
		$defaultHeading = !empty($cfg['heading']);
		$defaultTagline = !empty($cfg['tagline']);


		/* -------------- Blueprint --------------*/
		return [
			'name'    => 'kirbyblock-text.name',
			'icon'    => 'text-left',
			'tabs' => [
				'content' => [
					'label'  => 'pw.tab.content',
					'fields' => [
						'tagline' => [
							'extends' => 'pagewizard/fields/tagline',
							'when'    => ['toggleTagline' => 'enabled'],
						],
						'heading' => [
							'extends' => 'pagewizard/fields/heading',
							'when'    => ['toggleHeading' => 'enabled'],
						],
						'level' => [
							'extends' => 'pagewizard/fields/level',
							'when'    => ['toggleHeading' => 'enabled'],
						],
						'textTextarea' => [
							'extends' => 'pagewizard/fields/text-textarea',
							'when'    => ['textMode' => 'textarea'],
						],
						'textWriter' => [
							'extends' => 'pagewizard/fields/text-writer',
							'when'    => ['textMode' => 'writer'],
						],
						'textQuote' => [
							'extends' => 'pagewizard/fields/text-quote',
							'when'    => ['textMode' => 'quote'],
						],
						'author' => [
							'extends' => 'pagewizard/fields/author',
							'when'    => ['textMode' => 'quote'],
						],
						'textMarkdown' => [
							'extends' => 'pagewizard/fields/text-markdown',
							'when'    => ['textMode' => 'markdown'],
						],
						'textCode' => [
							'extends' => 'pagewizard/fields/text-code',
							'when'    => ['textMode' => 'code'],
						]
					],
				],
				'properties' => [
					'label'  => 'pw.tab.properties',
					'fields' => [
						'fragment' => [
							'extends' => 'pagewizard/fields/fragment'
						]
					]
				],
				'settings' => [
					'label'  => 'pw.tab.settings',
					'fields' => [
						'headlineBlocksettings' => ['extends' => 'pagewizard/headlines/blocksettings'],

						'toggleTagline' => [
							'extends' => 'pagewizard/fields/field-visibility',
							'label'   => 'pw.field.tagline',
							'default' => $defaultTagline ? 'enabled' : 'disabled',
							'help'    => 'The default setting for Tagline is: <code>' . ($defaultTagline ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>',
						],
						'toggleHeading' => [
							'extends' => 'pagewizard/fields/field-visibility',
							'label'   => 'pw.field.heading',
							'default' => $defaultHeading ? 'enabled' : 'disabled',
							'help'    => 'The default setting for Heading is: <code>' . ($defaultHeading ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>',
						],
						'textMode' => [
							'extends' => 'pagewizard/fields/text-mode',
							'default' => $type,
							'help'    => 'The default text mode in thie block is: <code>' . t('pw.option.'.$mode) . '</code>',
						]
					]
				]
			]
		];
	},
];