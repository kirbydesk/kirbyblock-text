<?php return [ 'blocks/pwText' => function () {

    /* -------------- Block Defaults when not set in config --------------*/
    $defaults = [
      'heading' 					=> true,
      'tagline' 					=> true,
			'buttons'						=> true,
			'layout'						=> true,
      'text-mode'					=> 'textarea',
			'grid-size-sm'   		=> 12,
			'grid-size-md'   		=> 12,
			'grid-size-lg'   		=> 12,
			'grid-size-xl'   		=> 12,
      'grid-offset-sm' 		=> 1,
      'grid-offset-md' 		=> 1,
      'grid-offset-lg' 		=> 1,
      'grid-offset-xl' 		=> 1,
    ];
		// Merge config with defaults
    $raw = option('kirbydesk.pagewizard.kirbyblock.pwText', []);
    $cfg = array_merge($defaults, is_array($raw) ? $raw : []);

    /* -------------- Text Mode --------------*/
    $mode    = $cfg['text-mode'] ?? null;
    $mode    = is_string($mode) ? strtolower(trim($mode)) : null;
    $allowed = ['textarea', 'writer', 'quote', 'markdown'];
    $type    = in_array($mode, $allowed, true) ? $mode : 'textarea';

    /* -------------- Grid settings --------------*/
		$defaultGridSizeSm    = $cfg['grid-size-sm'];
		$defaultGridOffsetSm  = $cfg['grid-offset-sm'];
		$defaultGridSizeMd		= $cfg['grid-size-md'];
		$defaultGridOffsetMd	= $cfg['grid-offset-md'];
		$defaultGridSizeLg		= $cfg['grid-size-lg'];
		$defaultGridOffsetLg	= $cfg['grid-offset-lg'];
		$defaultGridSizeXl		= $cfg['grid-size-xl'];
		$defaultGridOffsetXl	= $cfg['grid-offset-xl'];

    /* -------------- Allowed Fields --------------*/
    $defaultHeading = !empty($cfg['heading']);
    $defaultTagline = !empty($cfg['tagline']);
		$defaultButtons = !empty($cfg['buttons']);
		$defaultLayout = filter_var($cfg['layout'], FILTER_VALIDATE_BOOLEAN);

		/* -------------- Tabs --------------*/
    $tabs = [];

		$tabs['content'] = [
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
    ];

		$tabs['layout'] = [
			'label'  => 'pw.tab.layout',
			'fields' => [
				'headlineBlocksettings' => ['extends' => 'pagewizard/headlines/gridsettings'],
				'gridOffsetSm' => [
					'extends' => 'pagewizard/fields/grid-offset',
					'default' => $defaultGridOffsetSm
				],
				'gridSizeSm' => [
					'extends' => 'pagewizard/fields/grid-size',
					'default' => $defaultGridSizeSm
				],
				'gridOffsetMd' => [
					'extends' => 'pagewizard/fields/grid-offset',
					'default' => $defaultGridOffsetMd
				],
				'gridSizeMd' => [
					'extends' => 'pagewizard/fields/grid-size',
					'default' => $defaultGridSizeMd
				],
				'gridOffsetLg' => [
					'extends' => 'pagewizard/fields/grid-offset',
					'default' => $defaultGridOffsetLg
				],
				'gridSizeLg' => [
					'extends' => 'pagewizard/fields/grid-size',
					'default' => $defaultGridSizeLg
				],
				'gridOffsetXl' => [
					'extends' => 'pagewizard/fields/grid-offset',
					'default' => $defaultGridOffsetXl
				],
				'gridSizeXl' => [
					'extends' => 'pagewizard/fields/grid-size',
					'default' => $defaultGridSizeXl
				],
			]
		];

		$tabs['properties'] = [
      'label'  => 'pw.tab.properties',
      'fields' => [
        'fragment' => [
          'extends' => 'pagewizard/fields/fragment'
        ]
      ]
    ];

		$tabs['settings'] = [
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
				'toggleLayout' => [
          'extends' => 'pagewizard/fields/field-visibility',
          'label'   => 'pw.field.layout',
          'default' => $defaultLayout ? 'enabled' : 'disabled',
          'help'    => 'The default setting for Layout is: <code>' . ($defaultLayout ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>'
        ],
        'headlineEditorsettings' => ['extends' => 'pagewizard/headlines/editorsettings'],
        'textMode' => [
          'extends' => 'pagewizard/fields/text-mode',
          'default' => $type,
          'help'    => 'The default text mode in this block is: <code>' . t('pw.option.'.$mode) . '</code>'
        ]
      ]
    ];

		/* -------------- Blueprint --------------*/
		return [
			'name'	=> 'kirbyblock-text.name',
			'icon'  => 'text-left',
			'tabs'	=> $tabs
		];
	}
];