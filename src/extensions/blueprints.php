<?php return [ 'blocks/pwtext' => function () {

	/* -------------- Config --------------*/
	$config   = pwConfig::load('pwtext');
	$settings = $config['settings'];
	$defaults = $config['defaults'];

	/* -------------- Allowed Fields --------------*/
	$defaultTagline = !empty($settings['tagline']);
	$defaultHeading = !empty($settings['heading']);
	$defaultEditor = !empty($settings['editor']);
	$defaultButtons = !empty($settings['buttons']);

	/* -------------- Tabs --------------*/
    $tabs = [];

	/* -------------- Content Tab --------------*/
	$contentFields = [
		'headlineContent' => ['extends' => 'pagewizard/headlines/content'],
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
	/* -------------- Editor --------------*/
	if ($defaultEditor) {
		$editorConfigFile = __DIR__ . '/../config/editor.json';
		$editorConfig = file_exists($editorConfigFile)
			? json_decode(file_get_contents($editorConfigFile), true) ?? []
			: [];

		// Apply config.php overrides for editor.json options
		$rawCfg = option('kirbydesk.pagewizard.kirbyblocks.pwtext', []);
		if (!empty($rawCfg['editor']) && is_array($rawCfg['editor'])) {
			$editorConfig = array_merge($editorConfig, $rawCfg['editor']);
		}

		$contentFields['editor'] = pwEditor::contentField($defaults, $editorConfig, $settings);
	}

	/* -------------- Buttons --------------*/
	if ($defaultButtons) {
		$contentFields['buttonsAlignment'] = [
			'type' => 'pwalign',
			'default' => $defaults['buttons-alignment'] ?? 'left',
		];
		$contentFields['buttons'] = [
			'extends' => 'blocks/pwButtons',
		];
	}

	$tabs['content'] = [
		'label'  => 'pw.tab.content',
		'fields' => $contentFields,
	];

	/* -------------- Layout Tab --------------*/
	$tabs['layout'] = pwLayout::options('pwtext', $defaults);

	/* -------------- Style Tab --------------*/
	$tabs['style'] = pwStyle::options('pwtext', $defaults);

	/* -------------- Common Tabs (grid, spacing, theme) --------------*/
	pwConfig::buildTabs('pwtext', $defaults, $settings, $tabs);

	/* -------------- Settings Tab --------------*/
	$tabs['settings'] = pwSettings::options('pwtext', $defaults);

	/* -------------- Blueprint --------------*/
	return [
		'name'	=> 'kirbyblock-text.name',
		'icon'  => 'text-left',
		'tabs'	=> $tabs
	];
}
];
