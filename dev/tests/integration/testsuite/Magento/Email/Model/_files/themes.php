<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
use Magento\Framework\App\Bootstrap;
use Magento\Framework\App\Filesystem\DirectoryList;

\Magento\TestFramework\Helper\Bootstrap::getInstance()->reinitialize(
    [
        Bootstrap::INIT_PARAM_FILESYSTEM_DIR_PATHS => [
            DirectoryList::THEMES => ['path' => dirname(__DIR__) . '/_files/design'],
        ],
    ]
);
$objectManger = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
$objectManger->get('Magento\Framework\App\AreaList')
    ->getArea(\Magento\Backend\App\Area\FrontNameResolver::AREA_CODE)
    ->load(\Magento\Framework\App\Area::PART_CONFIG);

$objectManger->configure([
    'preferences' => [
        'Magento\Theme\Model\Theme' => 'Magento\Theme\Model\Theme\Data',
    ],
]);
/** @var $registration \Magento\Theme\Model\Theme\Registration */
$registration = $objectManger->create('Magento\Theme\Model\Theme\Registration');
$registration->register('*/*/theme.xml');
