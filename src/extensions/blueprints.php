<?php return [ 'blocks/pwtext' => function () {

    /* -------------- Config --------------*/
    $config   = pwConfig::load('pwtext', __DIR__ . '/../config');
    $settings = $config['settings'];
    $defaults = $config['defaults'];

    /* -------------- Text Mode --------------*/
    $mode    = $defaults['text-mode'] ?? null;
    $mode    = is_string($mode) ? strtolower(trim($mode)) : null;
    $allowed = ['textarea', 'writer', 'markdown'];
    $type    = in_array($mode, $allowed, true) ? $mode : 'textarea';

    /* -------------- Allowed Fields --------------*/
    $defaultHeading = !empty($settings['heading']);
    $defaultTagline = !empty($settings['tagline']);
		$defaultButtons = !empty($settings['buttons']);

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

		/* -------------- Common Tabs (grid, spacing, theme) --------------*/
		pwConfig::buildTabs('pwtext', $defaults, $settings, $tabs);

		/* -------------- Properties Tab --------------*/
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
