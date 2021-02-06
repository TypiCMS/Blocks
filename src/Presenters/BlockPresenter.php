<?php

namespace TypiCMS\Modules\Blocks\Presenters;

use TypiCMS\Modules\Core\Presenters\Presenter;

class BlockPresenter extends Presenter
{
    /**
     * Get title.
     */
    public function title(): string
    {
        return $this->entity->name;
    }
}
