<?php return [ 'blocks/pwText' => function () {

    /* -------------- Block Defaults when not set in config --------------*/
    $defaults = [
      'heading' 					=> true,
      'tagline' 					=> true,
			'buttons'						=> true,
      'text'    					=> 'textarea', // textarea, writer, quote, markdown
      'block-width'     	=> 12, // 6 - 12
      'block-offset'    	=> 'left', // left, right
      'block-alignment' 	=> 'center', // center, offset
      'block-offsetvalue' => 0, // 0 - 6
    ];
		// Merge config with defaults
    $raw = option('kirbydesk.pagewizard.kirbyblock.pwText', []);
    $cfg = array_merge($defaults, is_array($raw) ? $raw : []);


    /* -------------- Text Mode --------------*/
    $mode    = $cfg['text'] ?? null;
    $mode    = is_string($mode) ? strtolower(trim($mode)) : null;
    $allowed = ['textarea', 'writer', 'quote', 'markdown'];
    $type    = in_array($mode, $allowed, true) ? $mode : 'textarea';


    /* -------------- Block settings --------------*/
    $defaultBlockWidth      = $cfg['block-width'];
    $defaultBlockOffset     = $cfg['block-offset'];
    $defaultBlockAlignment  = $cfg['block-alignment'];
    $defaultBlockOffsetvalue= $cfg['block-offsetvalue'];


    /* -------------- Heading & Tagline --------------*/
    $defaultHeading = !empty($cfg['heading']);
    $defaultTagline = !empty($cfg['tagline']);
		$defaultButtons = !empty($cfg['buttons']);


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
						'buttons' => [
							'extends' => 'blocks/pwButtons',
							'when'    => ['toggleButtons' => 'enabled']
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
						'headlineFieldsettings' => ['extends' => 'pagewizard/headlines/fieldsettings'],
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
							'help'    => 'The default setting for Heading is: <code>' . ($defaultHeading ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>'
						],
						'toggleButtons' => [
							'extends' => 'pagewizard/fields/field-visibility',
							'label'   => 'pw.field.buttons',
							'default' => $defaultButtons ? 'enabled' : 'disabled',
							'help'    => 'The default setting for Buttons is: <code>' . ($defaultButtons ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>'
						],
						'headlineEditorsettings' => ['extends' => 'pagewizard/headlines/editorsettings'],
						'textMode' => [
							'extends' => 'pagewizard/fields/text-mode',
							'default' => $type,
							'help'    => 'The default text mode in thie block is: <code>' . t('pw.option.'.$mode) . '</code>'
						],
						'headlineBlocksettings' => ['extends' => 'pagewizard/headlines/blocksettings'],
						'blockWidth' => [
							'extends' => 'pagewizard/fields/block-width',
							'default' => $defaultBlockWidth
						],
						'blockAlignment' => [
							'extends' => 'pagewizard/fields/block-alignment',
							'default' => $defaultBlockAlignment
						],
						'blockOffset' => [
							'extends' => 'pagewizard/fields/block-offset',
							'default' => $defaultBlockOffset,
							'when'    => ['blockAlignment' => 'offset']
						],
						'blockOffsetvalue' => [
							'extends' => 'pagewizard/fields/block-offsetvalue',
							'default' => $defaultBlockOffsetvalue,
							'when'    => ['blockAlignment' => 'offset']
						]
					]
				]
			]
		];
	},
];