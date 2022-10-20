<?php

// contao/dca/tl_news.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_news']['fields']['addGallery'] = [
    'label' => ['Galerie', 'Bitte wählen Sie eine oder mehr Dateien aus der Dateiübersicht.'],
    'inputType' => 'fileTree',
    'eval' => [
        'isGallery' => true,
        'multiple' => true,
        'fieldType' => 'checkbox',
        'files' => true,
        'orderField'=>'addOrderSRC',
        'extensions' => '%contao.image.valid_extensions%',
        ],
    'sql' => ['type' => 'blob', 'notnull' => false],
];
$GLOBALS['TL_DCA']['tl_news']['fields']['addOrderSRC'] = [
    'label' => &$GLOBALS['TL_LANG']['MSC']['sortOrder'],
    'sql' => ['type' => 'blob', 'notnull' => false],
];
$GLOBALS['TL_DCA']['tl_news']['fields']['addSortBy'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['sortBy'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'custom',
        'name_asc',
        'name_desc',
        'date_asc',
        'date_desc',
        'random'
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => [
        'tl_class' => 'clr w50',
    ],
    'sql' => "varchar(32) COLLATE ascii_bin NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_news']['fields']['addSize'] = [
    'label' => &$GLOBALS['TL_LANG']['MSC']['imgSize'],
    'exclude' => true,
    'inputType' => 'imageSize',
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval' => [
        'tl_class'=>'clr w50',
        'rgxp'=>'natural', 
        'includeBlankOption'=>true, 
        'nospace'=>true, 
        'helpwizard'=>true,
    ],
    'options_callback' => ['contao.listener.image_size_options', '__invoke'],  
    'sql' => "varchar(128) COLLATE ascii_bin NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_news']['fields']['addFullSize'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['fullsize'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'w50 m12',
    ],
    'sql' => "char(1) COLLATE ascii_bin NOT NULL default ''",
];

PaletteManipulator::create()
    ->addLegend('media_legend','enclosure_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField('addGallery', 'media_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('addSortBy', 'media_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('addSize', 'media_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('addFullSize', 'media_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_news')
    ->applyToPalette('internal', 'tl_news')
    ->applyToPalette('article', 'tl_news')
    ->applyToPalette('external', 'tl_news')
; 
