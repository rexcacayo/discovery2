<?php

namespace Shahnewaz\RedprintUnity\Menu\Filters;

use Shahnewaz\RedprintUnity\Menu\Builder;

interface FilterInterface
{
    public function transform($item, Builder $builder);
}
