<?php

namespace Flynt\Components\GridDownloadPortrait;

use Flynt\Features\Components\Component;

add_filter('Flynt/addComponentData?name=GridDownloadPortrait', function ($data) {
    add_action('wp_enqueue_scripts', function () {
        Component::enqueueAssets('GridDownloadPortrait');
    });

    if (!empty($data['items'])) {
        $data['items'] = array_map(function ($item) {
            if ($item['itemType'] === 'itemFile') {
                $fileSize = filesize(get_attached_file($item['file']['id']));
                $item['file']['fileSize'] = size_format($fileSize, 2);
            }
            return $item;
        }, $data['items']);
    }

    return $data;
});