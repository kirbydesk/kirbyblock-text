<?php return [ 'blocks/pwtext' => function () {

	/* -------------- Config --------------*/
	$config       = pwConfig::load('pwtext');
	$settings     = $config['content'];
	$tabSettings  = $config['tabs'];
	$defaults     = $config['defaults'];
	$fields       = $config['fields'];
	$editor       = $config['editor'];
	$fieldOptions = $config['field-options'];


	/* -------------- Tabs --------------*/
	$tabs = [];

	/* -------------- Content Tab --------------*/
	$contentFields = [
		'headlineContent' => ['extends' => 'pagewizard/headlines/content'],
	];

	/* -------------- Tagline --------------*/
	if (!empty($settings['tagline'])) {
		$contentFields['tagline'] = [
			'extends'      => 'pagewizard/fields/tagline',
			'align'        => $fields['align-tagline'],
			'alignOptions' => $fieldOptions['tagline']['align'] ?? null,
		];
	}
	/* -------------- Heading --------------*/
	if (!empty($settings['heading'])) {
		$contentFields['heading'] = [
			'extends'      => 'pagewizard/fields/heading',
			'align'        => $fields['align-heading'],
			'level'        => $fields['level-heading'] ?? null,
			'size'         => $fields['size-heading'] ?? null,
			'sizeOptions'  => $fieldOptions['heading']['sizes'] ?? null,
			'alignOptions' => $fieldOptions['heading']['align'] ?? null,
			'levelOptions' => $fieldOptions['heading']['level'] ?? null,
			'textbackground'        => $fields['textbackground-heading'] ?? null,
			'textbackgroundOptions' => $fieldOptions['heading']['textbackground'] ?? null,
		];
	}
	/* -------------- Editor --------------*/
	if (!empty($settings['editor'])) {
		$contentFields['editor'] = pwEditor::contentField($editor, $settings);
		$contentFields['editor']['align']        = $fields['align-editor'] ?? null;
		$contentFields['editor']['size']         = $fields['size-editor'] ?? null;
		$contentFields['editor']['alignOptions'] = $fieldOptions['editor']['align'] ?? null;
		$contentFields['editor']['sizeOptions']  = $fieldOptions['editor']['sizes'] ?? null;
			$contentFields['editor']['defaultMode']           = $fields['mode-editor'] ?? null;
	}
	/* -------------- Buttons --------------*/
	if (!empty($settings['buttons'])) {
		$contentFields['buttonsAlignment'] = [
			'type'         => 'pwalign',
			'align'        => $fields['align-buttons'],
			'default'      => $fields['align-buttons'],
			'alignOptions' => $fieldOptions['buttons']['align'] ?? null,
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
	pwConfig::addTab($tabs, 'layout', $tabSettings['layout'] ?? true, pwLayout::options('pwtext', $defaults, [], $config['layout'] ?? []));

	/* -------------- Style Tab --------------*/
	pwConfig::addTab($tabs, 'style', $tabSettings['style'] ?? true, pwStyle::options('pwtext', $defaults, [], $config['style'] ?? []));

	/* -------------- Grid Tab --------------*/
	pwConfig::addTab($tabs, 'grid', $tabSettings['grid'] ?? false, pwGrid::layout('pwtext', $defaults));

	/* -------------- Settings Tab --------------*/
	pwConfig::addTab($tabs, 'settings', $tabSettings['settings'] ?? true, pwSettings::options('pwtext', $defaults, [], $config['settings'] ?? []));

	/* -------------- Blueprint --------------*/
	return [
		'name'	=> 'kirbyblock-text.name',
		'icon'  => 'text-left',
		'tabs'	=> $tabs
	];
}
];
