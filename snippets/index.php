<?php

// Config
$config   = pwConfig::load('pwtext');
$settings = $config['content'];

// Custom Background (no-op unless theme === custom)
pwSnippet::customCss($block);

// Section + Grid open
echo pwSnippet::sectionOpen('text', $block, $settings);
echo pwSnippet::gridOpen($block);

// Tagline
if (!empty($settings['tagline'])):
	snippet('tagline', ['content' => $block]);
endif;

// Heading
if (!empty($settings['heading'])):
	snippet('heading', ['content' => $block]);
endif;

// Editor
if (!empty($settings['editor'])):
	snippet('editor', ['content' => $block]);
endif;

// Buttons
if (!empty($settings['buttons'])):
	snippet('buttons', ['content' => $block]);
endif;

// Close
echo pwSnippet::gridClose();
echo pwSnippet::sectionClose();
