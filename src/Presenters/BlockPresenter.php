<?php
namespace TypiCMS\Modules\Blocks\Presenters;

use Laracasts\Presenter\Presenter;

class BlockPresenter extends Presenter
{

    /**
     * Get title
     *
     * @return string
     */
    public function title()
    {
        return $this->entity->name;
    }
}
