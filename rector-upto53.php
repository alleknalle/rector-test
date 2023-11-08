<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\SymfonyLevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths(
        [
            __DIR__ . '/config',
            __DIR__ . '/public',
            __DIR__ . '/src',
        ]
    );

    $rectorConfig->skip(
        [
            __DIR__ . '/config/bootstrap.php',
            __DIR__ . '/config/bundles.php',
            __DIR__ . '/public/index.php',
            __DIR__ . '/src/Kernel.php',
        ]
    );

    $rectorConfig->sets(
        [
            SymfonyLevelSetList::UP_TO_SYMFONY_53,
        ]
    );

    $rectorConfig->importNames();
    $rectorConfig->removeUnusedImports();
};
