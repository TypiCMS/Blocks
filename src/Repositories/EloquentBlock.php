<?php

namespace TypiCMS\Modules\Blocks\Repositories;

use TypiCMS\Modules\Blocks\Models\Block;
use TypiCMS\Modules\Core\Repositories\EloquentRepository;

class EloquentBlock extends EloquentRepository
{
    protected $repositoryId = 'blocks';

    protected $model = Block::class;

    /**
     * Get the content of a block.
     *
     * @param string $name unique name of the block
     *
     * @return string html
     */
    public function render($name = null)
    {
        $args = func_get_args();
        $args[] = config('app.locale');

        return $this->executeCallback(get_called_class(), __FUNCTION__, $args, function () use ($name) {
            $block = $this->prepareQuery($this->createModel())
                ->where('name', $name)
                ->published()
                ->first();

            return $block ? $block->present()->body : '';
        });
    }
}
