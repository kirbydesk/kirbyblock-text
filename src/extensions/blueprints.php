<?php return [ 'blocks/pwText' => function () {

    /* -------------- Block Defaults when not set in config.php --------------*/
    $defaults = [
      'heading' 					=> true,
      'tagline' 					=> true,
			'buttons'						=> true,
      'text-mode'					=> 'textarea',
			'grid'							=> true,
			'grid-size-sm'   		=> 12,
			'grid-size-md'   		=> 12,
			'grid-size-lg'   		=> 12,
			'grid-size-xl'   		=> 12,
      'grid-offset-sm' 		=> 1,
      'grid-offset-md' 		=> 1,
      'grid-offset-lg' 		=> 1,
      'grid-offset-xl' 		=> 1,
			'spacing'						=> true,
			'margin-top'		    => false,
			'margin-bottom'			=> true,
			'padding-top'     	=> true,
			'padding-bottom'  	=> true,
			'theme'							=> true,
			'style'							=> 'default', // default, variant
    ];
		// Merge config with defaults
    $raw = option('kirbydesk.pagewizard.kirbyblocks.pwText', []);
    $cfg = array_merge($defaults, is_array($raw) ? $raw : []);

    /* -------------- Text Mode --------------*/
    $mode    = $cfg['text-mode'] ?? null;
    $mode    = is_string($mode) ? strtolower(trim($mode)) : null;
    $allowed = ['textarea', 'writer', 'markdown'];
    $type    = in_array($mode, $allowed, true) ? $mode : 'textarea';

    /* -------------- Allowed Fields --------------*/
    $defaultHeading = !empty($cfg['heading']);
    $defaultTagline = !empty($cfg['tagline']);
		$defaultButtons = !empty($cfg['buttons']);

		$defaultGrid = filter_var($cfg['grid'], FILTER_VALIDATE_BOOLEAN);
    $defaultSpacing = filter_var($cfg['spacing'], FILTER_VALIDATE_BOOLEAN);
		$defaultTheme = filter_var($cfg['theme'], FILTER_VALIDATE_BOOLEAN);

		/* -------------- Tabs --------------*/
    $tabs = [];

		$tabs['content'] = [
      'label'  => 'pw.tab.content',
      'fields' => [
				'headlineContent' => ['extends' => 'pagewizard/headlines/blockcontent'],
        'tagline' => [
          'extends' => 'pagewizard/fields/tagline',
          'when'    => ['toggleTagline' => true],
        ],
        'heading' => [
          'extends' => 'pagewizard/fields/heading',
          'when'    => ['toggleHeading' => true],
        ],
        'textTextarea' => [
          'extends' => 'pagewizard/fields/text-textarea',
          'when'    => ['textMode' => 'textarea'],
        ],
        'textWriter' => [
          'extends' => 'pagewizard/fields/text-writer',
          'when'    => ['textMode' => 'writer'],
        ],
        'textMarkdown' => [
          'extends' => 'pagewizard/fields/text-markdown',
          'when'    => ['textMode' => 'markdown'],
        ],
				'buttons' => [
					'extends' => 'blocks/pwButtons',
					'when'    => ['toggleButtons' => true]
				]
      ],
    ];

		$tabs['grid'] = pwGrid::layout('pwText', [
			'gridSizeSm'   => $defaults['grid-size-sm'],
			'gridOffsetSm' => $defaults['grid-offset-sm'],
			'gridSizeMd'   => $defaults['grid-size-md'],
			'gridOffsetMd' => $defaults['grid-offset-md'],
			'gridSizeLg'   => $defaults['grid-size-lg'],
			'gridOffsetLg' => $defaults['grid-offset-lg'],
			'gridSizeXl'   => $defaults['grid-size-xl'],
			'gridOffsetXl' => $defaults['grid-offset-xl'],
		]);

		$tabs['spacing'] = pwSpacing::options('pwText', [
			'marginTop'    => $defaults['margin-top'],
			'marginBottom' => $defaults['margin-bottom'],
			'paddingTop'   => $defaults['padding-top'],
			'paddingBottom'=> $defaults['padding-bottom'],
		]);

		$tabs['theme'] = pwTheme::options('pwText', [
			'theme' => $defaults['style'] ?? 'default',
		]);

		$tabs['properties'] = [
      'label'  => 'pw.tab.properties',
      'fields' => [
				'headlineProperties' => ['extends' => 'pagewizard/headlines/blockproperties'],
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
          'label'   => 'pw.field.toggle.tagline',
          'default' => (bool)$defaultTagline,
					'width'   => '1/3',
          'help'    => 'The default setting for Tagline is: <code>' . ($defaultTagline ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>',
        ],
        'toggleHeading' => [
          'extends' => 'pagewizard/fields/field-visibility',
          'label'   => 'pw.field.toggle.heading',
          'default' => (bool)$defaultHeading,
					'width'   => '1/3',
          'help'    => t('pw.field.toggle.heading.help') . ' <code>' . ($defaultHeading ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>'
        ],
        'toggleButtons' => [
          'extends' => 'pagewizard/fields/field-visibility',
          'label'   => 'pw.field.toggle.buttons',
          'default' => (bool)$defaultButtons,
					'width'   => '1/3',
          'help'    => t('pw.field.toggle.buttons.help') . ' <code>' . ($defaultButtons ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>'
        ],
				'headlineEditorsettings' => ['extends' => 'pagewizard/headlines/editorsettings'],
        'textMode' => [
          'extends' => 'pagewizard/fields/text-mode',
          'default' => $type,
          'help'    => t('pw.field.text-mode.help') . ' <code>' . t('pw.option.'.$mode) . '</code>'
        ],
				'headlineLayoutsettings' => ['extends' => 'pagewizard/headlines/layoutsettings'],
				'toggleGrid' => [
          'extends' => 'pagewizard/fields/field-visibility',
          'label'   => 'pw.field.toggle.grid',
          'default' => (bool)$defaultGrid,
					'width'   => '1/3',
          'help'    => t('pw.field.toggle.grid.help') . ' <code>' . ($defaultGrid ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>'
        ],
				'toggleSpacing' => [
          'extends' => 'pagewizard/fields/field-visibility',
          'label'   => 'pw.field.toggle.spacing',
          'default' => (bool)$defaultSpacing,
					'width'   => '1/3',
          'help'    => t('pw.field.toggle.spacing.help') . ' <code>' . ($defaultSpacing ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>'
        ],
				'toggleTheme' => [
          'extends' => 'pagewizard/fields/field-visibility',
          'label'   => 'pw.field.toggle.theme',
          'default' => (bool)$defaultTheme,
					'width'   => '1/3',
          'help'    => t('pw.field.toggle.theme.help') . ' <code>' . ($defaultTheme ? t('pw.option.enabled') : t('pw.option.disabled')) . '</code>'
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