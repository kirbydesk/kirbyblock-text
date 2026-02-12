<?php return [ 'blocks/pwtext' => function () {

    /* -------------- Block Defaults when not set in config.php --------------*/
    $defaultsFile = __DIR__ . '/../config/defaults.json';
    $defaults = file_exists($defaultsFile)
      ? json_decode(file_get_contents($defaultsFile), true)
      : [];
		// Merge config with defaults
    $raw = option('kirbydesk.pagewizard.kirbyblocks.pwtext', []);
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

		$defaultGrid = !empty($cfg['tab-grid']);
    $defaultSpacing = !empty($cfg['tab-spacing']);
		$defaultTheme = !empty($cfg['tab-theme']);

		/* -------------- Tabs --------------*/
    $tabs = [];

		/* -------------- Content Tab --------------*/
		$contentFields = [
			'headlineContent' => ['extends' => 'pagewizard/headlines/blockcontent'],
		];

		/* -------------- Tagline --------------*/
		if ($defaultTagline) {
			$contentFields['tagline'] = [
				'extends' => 'pagewizard/fields/tagline',
			];
		}
		/* -------------- Heading --------------*/
		if ($defaultHeading) {
			$contentFields['heading'] = [
				'extends' => 'pagewizard/fields/heading',
			];
		}
		/* -------------- Texts --------------*/
		$contentFields['textTextarea'] = [
			'extends' => 'pagewizard/fields/text-textarea',
			'when'    => ['textMode' => 'textarea'],
		];
		$contentFields['textWriter'] = [
			'extends' => 'pagewizard/fields/text-writer',
			'when'    => ['textMode' => 'writer'],
		];
		$contentFields['textMarkdown'] = [
			'extends' => 'pagewizard/fields/text-markdown',
			'when'    => ['textMode' => 'markdown'],
		];

		/* -------------- Buttons --------------*/
		if ($defaultButtons) {
			$contentFields['buttons'] = [
				'extends' => 'blocks/pwButtons',
			];
		}

		$tabs['content'] = [
			'label'  => 'pw.tab.content',
			'fields' => $contentFields,
		];

		/* -------------- Grid Tab --------------*/
		if ($defaultGrid) {
			$tabs['grid'] = pwGrid::layout('pwtext', [
				'gridSizeSm'   => $defaults['grid-size-sm'],
				'gridOffsetSm' => $defaults['grid-offset-sm'],
				'gridSizeMd'   => $defaults['grid-size-md'],
				'gridOffsetMd' => $defaults['grid-offset-md'],
				'gridSizeLg'   => $defaults['grid-size-lg'],
				'gridOffsetLg' => $defaults['grid-offset-lg'],
				'gridSizeXl'   => $defaults['grid-size-xl'],
				'gridOffsetXl' => $defaults['grid-offset-xl'],
			]);
		}

		/* -------------- Spacing Tab --------------*/
		if ($defaultSpacing) {
			$tabs['spacing'] = pwSpacing::options('pwtext', [
				'marginTop'    => $defaults['margin-top'],
				'marginBottom' => $defaults['margin-bottom'],
				'paddingTop'   => $defaults['padding-top'],
				'paddingBottom'=> $defaults['padding-bottom'],
			]);
		}

		/* -------------- Theme Tab --------------*/
		if ($defaultTheme) {
			$tabs['theme'] = pwTheme::options('pwtext', [
				'style' => $defaults['style'] ?? 'default',
			]);
		}

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
				'headlineEditorsettings' => ['extends' => 'pagewizard/headlines/editorsettings'],
        'textMode' => [
          'extends' => 'pagewizard/fields/text-mode',
          'default' => $type,
          'help'    => t('pw.field.text-mode.help') . ' <code>' . t('pw.option.'.$mode) . '</code>'
        ],
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
