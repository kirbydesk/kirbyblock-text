<?php return [ 'blocks/pwtext' => function () {

	/* -------------- Config --------------*/
	$config      = pwConfig::load('pwtext');
	$settings    = $config['settings'];
	$tabSettings = $config['tabs'];
	$defaults    = $config['defaults'];
	$fields      = $config['fields'];
	$editor      = $config['editor'];

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
			'align'   => $fields['align-tagline']
		];
	}
	/* -------------- Heading --------------*/
	if ($defaultHeading) {
		$contentFields['heading'] = [
			'extends' => 'pagewizard/fields/heading',
			'align'   => $fields['align-heading']
		];
	}
	/* -------------- Editor --------------*/
	if ($defaultEditor) {
		$contentFields['editor'] = pwEditor::contentField($defaults, $editor, $settings, $fields);
	}
	/* -------------- Buttons --------------*/
	if ($defaultButtons) {
		$contentFields['buttonsAlignment'] = [
			'type'    => 'pwalign',
			'align'   => $fields['align-buttons'],
			'default' => $fields['align-buttons'],
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
	pwConfig::addTab($tabs, 'layout', $tabSettings['layout'] ?? true, pwLayout::options('pwtext', $defaults));

	/* -------------- Style Tab --------------*/
	pwConfig::addTab($tabs, 'style', $tabSettings['style'] ?? true, pwStyle::options('pwtext', $defaults));

	/* -------------- Grid Tab --------------*/
	pwConfig::addTab($tabs, 'grid', $tabSettings['grid'] ?? false, pwGrid::layout('pwtext', $defaults));

	/* -------------- Settings Tab --------------*/
	pwConfig::addTab($tabs, 'settings', $tabSettings['settings'] ?? true, pwSettings::options('pwtext', $defaults));

	/* -------------- Blueprint --------------*/
	return [
		'name'	=> 'kirbyblock-text.name',
		'icon'  => 'text-left',
		'tabs'	=> $tabs
	];
}
];
