<?php

namespace Shahnewaz\RedprintUnity\Http\ViewComposers;

use Illuminate\View\View;
use Shahnewaz\RedprintUnity\RedprintUnity;

class RedprintUnityComposer
{
    /**
     * @var RedprintUnity
     */
    private $redprintUnity;

    public function __construct(
        RedprintUnity $redprintUnity
    ) {
        $this->redprintUnity = $redprintUnity;
    }

    public function compose(View $view)
    {
        $view->with('redprintUnity', $this->redprintUnity);
    }
}
