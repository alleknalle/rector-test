<?php

declare (strict_types=1);

namespace App;

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\SymfonyLevelSetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([SymfonyLevelSetList::UP_TO_SYMFONY_52, SymfonySetList::SYMFONY_53]);
};
