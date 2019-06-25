<?php

namespace Shahnewaz\RedprintUnity\Events;

use Shahnewaz\RedprintUnity\Menu\Builder;

class BuildingMenu
{
    public $menu;

    public function __construct(Builder $menu)
    {
        $this->menu = $menu;
    }
}
